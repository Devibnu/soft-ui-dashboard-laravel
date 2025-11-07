<?php

namespace App\Http\Controllers;

use App\Models\HomeHero;
use App\Models\AboutContent;
use App\Models\AboutHeroSection;
use App\Models\HeaderInfo;
use App\Models\HeaderFiturUtama;
use App\Models\HeaderDaftarLayanan;
use App\Models\HeaderProjects;
use App\Models\HeaderBlog;
use App\Models\RequestQuoteSetting;
use App\Models\RequestQuoteService;
use App\Models\FiturUtama;
use App\Models\DaftarLayanan;
use App\Models\Proyek;
use App\Models\Artikel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with dynamic content
     */
    public function index()
    {
        // Get 1 active hero (latest)
        $hero = HomeHero::where('status', true)
            ->orderBy('created_at', 'desc')
            ->first();

        // Get 1 latest about content (active & published)
        $about = AboutContent::where('is_active', true)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->first();

        // Get Header Fitur Utama (for "Our Main Features" section header and CTA box)
        $headerFiturUtama = HeaderFiturUtama::where('status_aktif', true)
            ->orderBy('created_at', 'desc')
            ->first();

        // Get 4 latest active features (Fitur Utama) for "Our Main Features"
        $features = FiturUtama::where('status_aktif', true)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        // Get header for services section
        $headerDaftarLayanan = HeaderDaftarLayanan::where('status_aktif', true)->first();

        // Get 6 latest active services (Daftar Layanan) for "Our Best Services"
        $services = DaftarLayanan::where('status_aktif', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get header for projects section
        $headerProjects = HeaderProjects::where('status_aktif', true)->first();

        // Get 3 latest active projects
        $projects = Proyek::where('status', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get counter/statistics from About Hero Section
        $aboutSection = AboutHeroSection::first();

        // Get active header info for top bar
        $headerInfo = HeaderInfo::where('status', true)->first();

        // Get header for blog section
        $headerBlog = HeaderBlog::where('status_aktif', true)->first();

        // Get 3 latest published blog posts
        $posts = Artikel::where('status', 'aktif')
            ->orderBy('tanggal_dibuat', 'desc')
            ->limit(3)
            ->get();

        // Get 3 latest testimonials (if table exists)
        $testimonials = [];
        if (\Schema::hasTable('testimonials')) {
            $testimonials = \DB::table('testimonials')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        }

        // Get Request Quote settings
        $requestQuoteSetting = RequestQuoteSetting::where('status', true)->first();

        // Get active Request Quote services for dropdown
        $requestQuoteServices = RequestQuoteService::where('status', true)
            ->orderBy('nama_service', 'asc')
            ->get();

        return view('home', [
            'hero' => $hero,
            'about' => $about,
            'aboutSection' => $aboutSection,
            'headerInfo' => $headerInfo,
            'headerFiturUtama' => $headerFiturUtama,
            'headerDaftarLayanan' => $headerDaftarLayanan,
            'headerProjects' => $headerProjects,
            'headerBlog' => $headerBlog,
            'requestQuoteSetting' => $requestQuoteSetting,
            'requestQuoteServices' => $requestQuoteServices,
            'features' => $features,
            'services' => $services,
            'projects' => $projects,
            'posts' => $posts,
            'testimonials' => $testimonials
        ]);
    }

    /**
     * Redirect to dashboard (for backward compatibility)
     */
    public function home()
    {
        return redirect('dashboard');
    }
}
