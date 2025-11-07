<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamat',
        'telepon',
        'email',
        'placeholder_subscribe',
        'tombol_subscribe_text',
        'tombol_subscribe_link',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'linkedin_link',
        'youtube_link',
        'copyright_text'
    ];
}