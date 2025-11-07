<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi_singkat',
        'isi_konten',
        'gambar',
        'header_image',
        'custom_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
