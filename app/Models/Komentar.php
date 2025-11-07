<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = [
        'artikel_id',
        'nama',
        'email',
        'isi',
        'status',
        'parent_id',
        'tanggal_dibuat'
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime'
    ];

    // Relationship dengan artikel
    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }

    // Relationship untuk balasan komentar (parent-child)
    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id');
    }

    public function balasan()
    {
        return $this->hasMany(Komentar::class, 'parent_id');
    }

    // Scope untuk komentar yang disetujui
    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui');
    }

    // Scope untuk komentar utama (bukan balasan)
    public function scopeUtama($query)
    {
        return $query->whereNull('parent_id');
    }
}