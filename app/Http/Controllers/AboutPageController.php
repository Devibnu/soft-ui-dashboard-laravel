<?php

namespace App\Http\Controllers;

use App\Models\AboutHeroSection;
use App\Models\AboutContentSection;
use App\Models\AboutTestimonialSection;
use App\Models\HeroPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $heroSection = AboutHeroSection::first();
        $contents = AboutContentSection::active()->get();
        $testimonials = AboutTestimonialSection::active()->get();
        $heroPage = HeroPage::first();



        return view('frontend.about', compact('heroSection', 'contents', 'testimonials', 'heroPage'));
    }
}
