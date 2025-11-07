<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/test-hero-submit',
        '/adminui/about/hero',
        '/adminui/about/content', 
        '/adminui/about/testimonial',
        '/adminui/request-quote/inbox/*/reply-email',  // Temporary for testing
        '/test-email/*',  // Test route
        '/direct-test-email/*'  // Direct test without middleware
    ];
}
