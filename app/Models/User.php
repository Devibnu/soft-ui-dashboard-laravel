<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
        'photo',
        'phone',
        'location',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'array',
    ];

    /**
     * Check if user is Super Admin
     */
    public function isSuperAdmin()
    {
        return isset($this->role) && strtolower($this->role) === 'super admin';
    }

    /**
     * Check if user has permission to a menu/module
     */
    public function hasPermission(string $menu)
    {
        // Super Admin bypass only when permissions is null (legacy full-access marker)
        if ($this->isSuperAdmin() && is_null($this->permissions)) {
            return true;
        }
        if (is_array($this->permissions)) {
            return in_array($menu, $this->permissions);
        }
        return false;
    }
    
}
