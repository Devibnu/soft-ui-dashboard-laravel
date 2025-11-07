<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'tagline',
        'hero_title',
        'projects_completed',
        'satisfied_customers',
        'awards_received',
        'years_experience',
        'email',
        'phone',
        'address',
        'success_title',
        'success_description',
        'welcome_title',
        'welcome_paragraph1',
        'welcome_paragraph2',
        'welcome_paragraph3',
        'consultation_title',
        'consultation_paragraph1',
        'consultation_paragraph2',
        'guidance_title',
        'video_url'
    ];

    protected $casts = [
        'projects_completed' => 'integer',
        'satisfied_customers' => 'integer',
        'awards_received' => 'integer',
        'years_experience' => 'integer'
    ];
}
