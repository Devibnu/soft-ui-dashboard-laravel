<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FaviconWebsite extends Model
{
    protected $table = 'favicon_website';
    
    protected $fillable = [
        'favicon',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * Boot method - auto deactivate other favicons when one is activated
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($favicon) {
            if ($favicon->status) {
                // Deactivate all other favicons
                self::where('id', '!=', $favicon->id)->update(['status' => false]);
            }
        });

        static::deleting(function ($favicon) {
            // Delete favicon file from storage when record is deleted
            if ($favicon->favicon && Storage::disk('public')->exists($favicon->favicon)) {
                Storage::disk('public')->delete($favicon->favicon);
            }
        });
    }

    /**
     * Scope for active favicon
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get favicon URL
     */
    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? asset('storage/' . $this->favicon) : null;
    }
}
