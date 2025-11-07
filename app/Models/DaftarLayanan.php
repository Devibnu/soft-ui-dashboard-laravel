<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarLayanan extends Model
{
    protected $fillable = [
        'nama_layanan',
        'deskripsi_layanan',
        'harga_layanan',
        'gambar_layanan',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];
}
