<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiturUtama extends Model
{
    protected $fillable = [
        'judul_fitur',
        'deskripsi_fitur',
        'ikon_fitur',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];
}
