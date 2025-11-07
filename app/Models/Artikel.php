<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'gambar',
        'status',
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
        'tanggal_diperbarui' => 'datetime'
    ];

    // Automatically generate slug when creating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
        });
    }

    // Relationship dengan komentar
    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

    // Relationship dengan kategori (Many-to-Many)
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'artikel_kategori');
    }

    // Scope untuk artikel aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}