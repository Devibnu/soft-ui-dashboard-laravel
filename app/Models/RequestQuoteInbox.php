<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestQuoteInbox extends Model
{
    protected $table = 'request_quote_inbox';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'email',
        'nomor_telepon',
        'service_slug',
        'pesan',
        'status'
    ];

    /**
     * Get the service associated with this inbox message
     */
    public function service()
    {
        return $this->belongsTo(RequestQuoteService::class, 'service_slug', 'slug');
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return [
            'baru' => 'danger',
            'dibaca' => 'warning',
            'selesai' => 'success'
        ][$this->status] ?? 'secondary';
    }
}
