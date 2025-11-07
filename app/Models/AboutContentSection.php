<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContentSection extends Model
{
    protected $fillable = [
        'title',
        'left_paragraph',
        'right_title',
        'right_paragraph',
        'right_image_path',
        'cta_text',
        'cta_link',
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
