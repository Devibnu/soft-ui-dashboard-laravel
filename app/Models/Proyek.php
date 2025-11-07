<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';

    protected $fillable = [
        'judul',
        'slug',
        'kategori_id',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'gambar_utama',
        'galeri',
        'klien',
        'lokasi',
        'tanggal_proyek',
        'status'
    ];

    protected $casts = [
        'galeri' => 'array',
        'status' => 'boolean',
        'tanggal_proyek' => 'date'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($proyek) {
            if (empty($proyek->slug)) {
                $proyek->slug = Str::slug($proyek->judul);
                
                // Ensure unique slug
                $count = 1;
                $originalSlug = $proyek->slug;
                while (static::where('slug', $proyek->slug)->exists()) {
                    $proyek->slug = $originalSlug . '-' . $count++;
                }
            }
        });

        static::updating(function ($proyek) {
            if ($proyek->isDirty('judul') && empty($proyek->slug)) {
                $proyek->slug = Str::slug($proyek->judul);
                
                // Ensure unique slug
                $count = 1;
                $originalSlug = $proyek->slug;
                while (static::where('slug', $proyek->slug)->where('id', '!=', $proyek->id)->exists()) {
                    $proyek->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Get the category that owns the project
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriProject::class, 'kategori_id');
    }

    /**
     * Scope for active projects
     */
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for specific category
     */
    public function scopeKategoriId($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }
}