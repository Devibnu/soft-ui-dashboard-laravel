<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutHeroSection extends Model
{
    protected $fillable = [
        'tagline',
        'hero_image',
        'projects_completed',
        'satisfied_customers',
        'awards_received',
        'years_experience'
    ];

    protected $casts = [
        'projects_completed' => 'integer',
        'satisfied_customers' => 'integer',
        'awards_received' => 'integer',
        'years_experience' => 'integer'
    ];
}
