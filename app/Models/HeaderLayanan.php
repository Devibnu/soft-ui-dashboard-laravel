<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderLayanan extends Model
{
    protected $fillable = [
        'judul_utama',
        'subjudul', 
        'deskripsi',
        'gambar_latar',
        'judul_main_features',
        'deskripsi_main_features',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];
}
