<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestQuoteSetting extends Model
{
    protected $table = 'request_quote_settings';

    protected $fillable = [
        'title',
        'subtitle',
        'bg_image',
        'overlay_color',
        'button_text',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
