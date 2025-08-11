<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $email = (string) $this->string('email');
        $remember = $this->boolean('remember');

        // Diagnostics: trace incoming email and remember flag
        Log::info('Auth: login attempt received', [
            'email' => $email,
            'remember' => $remember,
            'ip' => $this->ip(),
        ]);

        // Diagnostics: check if user exists and if password hash matches
        $user = \App\Models\User::where('email', $email)->first();
        Log::info('Auth: user lookup', [
            'found' => (bool) $user,
            'user_id' => $user->id ?? null,
        ]);

        if ($user) {
            $hashOk = Hash::check((string) $this->string('password'), $user->password);
            Log::info('Auth: password hash check', [
                'hash_ok' => $hashOk,
                'hash_prefix' => substr($user->password, 0, 4), // typically "$2y$" for bcrypt
            ]);
        }

        Log::info('Auth: attempting authentication with Auth facade');

        $attemptResult = Auth::attempt($this->only('email', 'password'), $remember);

        Log::info('Auth: authentication attempt result', [
            'result' => $attemptResult,
            'email' => $email,
        ]);

        if (! $attemptResult) {
            RateLimiter::hit($this->throttleKey());

            Log::warning('Auth: attempt failed', [
                'email' => $email,
            ]);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
