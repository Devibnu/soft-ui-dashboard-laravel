<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHero extends Model
{
    use HasFactory;

    protected $table = 'home_hero';

    protected $fillable = [
        'judul',
        'subjudul',
        'deskripsi',
        'tombol_text',
        'tombol_link',
        'gambar_background',
        'warna_overlay',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Scope for active heroes
     */
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }
}
