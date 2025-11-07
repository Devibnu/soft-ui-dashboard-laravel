<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Tambahkan folder website sebagai lokasi view
        $customPath = base_path('website');
        View::addLocation($customPath);
        
        // Register View Composer untuk Header Info
        // Agar headerInfo tersedia di semua view yang menggunakan layout frontend
        View::composer('frontend.layouts.app', \App\View\Composers\HeaderInfoComposer::class);
    }
}
