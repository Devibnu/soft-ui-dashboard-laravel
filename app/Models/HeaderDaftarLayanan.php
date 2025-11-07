<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderDaftarLayanan extends Model
{
    use HasFactory;

    protected $table = 'header_daftar_layanan';

    protected $fillable = [
        'judul_section',
        'deskripsi_section',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
