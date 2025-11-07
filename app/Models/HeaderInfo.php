<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderInfo extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model ini
     */
    protected $table = 'header_info';

    /**
     * Field yang dapat diisi secara mass assignment
     */
    protected $fillable = [
        'nama_website',
        'email',
        'telepon',
        'cta_text',
        'cta_link',
        'status',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Boot method untuk menambahkan observer
     * Memastikan hanya 1 record yang berstatus aktif
     */
    protected static function boot()
    {
        parent::boot();

        // Sebelum menyimpan data baru atau update
        static::saving(function ($headerInfo) {
            // Jika status diset true, nonaktifkan semua record lain
            if ($headerInfo->status) {
                static::where('id', '!=', $headerInfo->id)
                    ->update(['status' => false]);
            }
        });
    }

    /**
     * Scope untuk mendapatkan header info yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
