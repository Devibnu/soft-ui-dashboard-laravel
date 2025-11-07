<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUIController extends Controller
{
    /**
     * Main adminui route - redirect to login or dashboard
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('adminui.dashboard');
        }
        return redirect()->route('adminui.login');
    }

    /**
     * Show the admin login form
     */
    public function login()
    {
        // Redirect if already authenticated
        if (Auth::check()) {
            return redirect()->route('adminui.dashboard');
        }
        
        return view('adminui.login');
    }

    /**
     * Authenticate admin user
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('adminui.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('adminui.login');
        }

        // Get dashboard statistics from database
        $totalUsers = \App\Models\User::count();
        $totalProjects = \App\Models\Proyek::count();
        $totalPosts = \App\Models\Artikel::count();
        $totalTestimonials = \App\Models\Testimonial::count();
        $totalMessages = \App\Models\KontakPerusahaan::count();

        // Get recent data for charts (last 7 days)
        $recentUsers = \App\Models\User::where('created_at', '>=', now()->subDays(7))->count();
        $recentProjects = \App\Models\Proyek::where('created_at', '>=', now()->subDays(7))->count();
        $recentPosts = \App\Models\Artikel::where('created_at', '>=', now()->subDays(7))->count();

        return view('adminui.dashboard', compact(
            'totalUsers',
            'totalProjects',
            'totalPosts',
            'totalTestimonials',
            'totalMessages',
            'recentUsers',
            'recentProjects',
            'recentPosts'
        ));
    }

    /**
     * Show the admin profile page
     */
    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('adminui.login');
        }

        return view('adminui.profile');
    }

    /**
     * Show the admin virtual reality page
     */
    public function virtualReality()
    {
        if (!Auth::check()) {
            return redirect()->route('adminui.login');
        }

        return view('adminui.virtual-reality');
    }

    /**
     * Show the admin RTL page
     */
    public function rtl()
    {
        if (!Auth::check()) {
            return redirect()->route('adminui.login');
        }

        return view('adminui.rtl');
    }

    /**
     * Logout admin user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('adminui.login');
    }
}