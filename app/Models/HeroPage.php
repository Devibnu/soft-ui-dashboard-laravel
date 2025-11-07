<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_background',
        'breadcrumb_text',
        'is_active'
    ];
}
