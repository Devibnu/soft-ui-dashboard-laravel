<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'content',
        'image_path',
        'cta_link',
        'cta_text',
        'is_active',
        'is_published'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_published' => 'boolean'
    ];

    // Scope untuk mendapatkan konten yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mendapatkan konten yang aktif terurut
    public function scopeActiveOrdered($query)
    {
        return $query->where('is_active', true)->orderBy('created_at', 'asc');
    }

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    // Accessor untuk deskripsi singkat yang dipotong
    public function getShortDescriptionLimitedAttribute()
    {
        return strlen($this->short_description) > 150 ? 
            substr($this->short_description, 0, 150) . '...' : 
            $this->short_description;
    }
}