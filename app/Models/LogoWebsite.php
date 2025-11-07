<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LogoWebsite extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'logo_website';

    /**
     * Field yang dapat diisi
     */
    protected $fillable = [
        'gambar',
        'status',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Boot method untuk observer
     * Memastikan hanya 1 logo yang aktif
     */
    protected static function boot()
    {
        parent::boot();

        // Sebelum menyimpan
        static::saving(function ($logo) {
            // Jika status true, nonaktifkan semua logo lain
            if ($logo->status) {
                static::where('id', '!=', $logo->id)->update(['status' => false]);
            }
        });

        // Sebelum menghapus, hapus file fisik
        static::deleting(function ($logo) {
            if ($logo->gambar && Storage::exists('public/' . $logo->gambar)) {
                Storage::delete('public/' . $logo->gambar);
            }
        });
    }

    /**
     * Scope untuk get logo aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get full URL gambar
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }
}
