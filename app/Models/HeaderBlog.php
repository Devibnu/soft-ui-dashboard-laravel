<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderBlog extends Model
{
    protected $table = 'header_blog';

    protected $fillable = [
        'judul_section',
        'deskripsi_section',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
