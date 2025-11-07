<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPostSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the POST data exceeds the allowed size
        if (
            $request->isMethod('post') && 
            empty($_POST) && 
            empty($_FILES) && 
            $_SERVER['CONTENT_LENGTH'] > 0
        ) {
            $maxSize = ini_get('post_max_size');
            $uploadMaxSize = ini_get('upload_max_filesize');
            
            return redirect()->back()->withInput()->with('error', 
                "File yang diupload terlalu besar! Server mengizinkan maksimal {$maxSize} untuk POST data dan {$uploadMaxSize} untuk file upload. Silakan compress gambar Anda terlebih dahulu."
            );
        }

        return $next($request);
    }
}