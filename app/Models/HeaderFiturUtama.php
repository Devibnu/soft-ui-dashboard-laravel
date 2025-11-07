<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderFiturUtama extends Model
{
    use HasFactory;

    protected $table = 'header_fitur_utama';

    protected $fillable = [
        'judul_section',
        'deskripsi_section',
        'gambar_cta',
        'judul_cta',
        'deskripsi_cta',
        'button_text',
        'button_url',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
