<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'baru' => 'danger',
            'dibaca' => 'warning',
            'selesai' => 'success',
            default => 'secondary'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'baru' => 'Baru',
            'dibaca' => 'Dibaca',
            'selesai' => 'Selesai',
            default => 'Unknown'
        };
    }

    public function markAsRead()
    {
        if ($this->status === 'baru') {
            $this->update([
                'status' => 'dibaca',
                'read_at' => now()
            ]);
        }
    }
}