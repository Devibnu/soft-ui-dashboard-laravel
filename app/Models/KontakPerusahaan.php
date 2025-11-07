<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakPerusahaan extends Model
{
    protected $table = 'kontak_perusahaan';
    
    protected $fillable = [
        'judul_halaman',
        'subjudul',
        'alamat',
        'telepon',
        'email',
        'deskripsi_pesan',
        'map_embed',
        'logo_whatsapp',
        'nomor_whatsapp',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];
}
