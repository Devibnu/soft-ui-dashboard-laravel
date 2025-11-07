<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriProject extends Model
{
    use HasFactory;

    protected $table = 'kategori_project';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'warna',
        'urutan',
        'status'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama);
                
                // Ensure unique slug
                $count = 1;
                $originalSlug = $kategori->slug;
                while (static::where('slug', $kategori->slug)->exists()) {
                    $kategori->slug = $originalSlug . '-' . $count++;
                }
            }
        });

        static::updating(function ($kategori) {
            if ($kategori->isDirty('nama') && !$kategori->isDirty('slug')) {
                $kategori->slug = Str::slug($kategori->nama);
                
                // Ensure unique slug (exclude current record)
                $count = 1;
                $originalSlug = $kategori->slug;
                while (static::where('slug', $kategori->slug)->where('id', '!=', $kategori->id)->exists()) {
                    $kategori->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Get the projects for the category
     */
    public function projects()
    {
        return $this->hasMany(Proyek::class, 'kategori_id');
    }
}