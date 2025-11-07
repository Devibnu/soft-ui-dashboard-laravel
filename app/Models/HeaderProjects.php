<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderProjects extends Model
{
    protected $table = 'header_projects';

    protected $fillable = [
        'judul_section',
        'deskripsi_section',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
