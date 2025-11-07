<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestQuoteMessage extends Model
{
    protected $table = 'request_quote_messages';

    protected $fillable = [
        'first_name',
        'last_name',
        'service',
        'phone',
        'message'
    ];
}
