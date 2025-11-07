<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutTestimonialSection extends Model
{
    protected $fillable = [
        'section_title',
        'section_subtext',
        'name',
        'position',
        'message',
        'photo_path',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
