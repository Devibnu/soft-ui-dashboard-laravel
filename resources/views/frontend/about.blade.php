@extends('frontend.layouts.app')

@section('title', 'About Us - JasaIbnu')

@section('content')
    <!-- Hero Section -->
    @php
        $heroImageUrl = asset('website/images/bg_1.jpg'); // default
        if($heroSection && $heroSection->hero_image) {
            // Add cache busting with database timestamp
            $heroImageUrl = asset('storage/' . $heroSection->hero_image) . '?v=' . strtotime($heroSection->updated_at);
        } elseif($heroPage && $heroPage->hero_background) {
            $heroImageUrl = asset('storage/' . $heroPage->hero_background) . '?v=' . strtotime($heroPage->updated_at);
        }
    @endphp
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ $heroImageUrl }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    @if($heroPage && $heroPage->hero_title)
                        <h1 class="mb-2 bread">{{ $heroPage->hero_title }}</h1>
                    @else
                        <h1 class="mb-2 bread">About Us</h1>
                    @endif
                    @if($heroPage && $heroPage->breadcrumb_text)
                        <p class="breadcrumbs" style="color: #fff !important;"><span style="color: #fff !important;">{!! str_replace('>', ' <i class="ion-ios-arrow-forward"></i> ', $heroPage->breadcrumb_text) !!} <i class="ion-ios-arrow-forward"></i></span></p>
                    @else
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}" style="color: #fff !important;">Home <i class="ion-ios-arrow-forward"></i></a></span> <span style="color: #fff !important;">About us <i class="ion-ios-arrow-forward"></i></span></p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    @forelse($contents as $index => $content)
    @if($content->is_active)
        @if($index == 0)
            {{-- First Section: Text Left, Box Right --}}
            <section class="ftco-section">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col-md-5 order-md-last wrap-about align-items-stretch">
                            <div class="wrap-about-border">
                                <div class="img" style="background-image: url({{ $content->right_image_path ? asset('storage/' . $content->right_image_path) : asset('website/images/about.jpg') }}); border"></div>
                                <div class="text">
                                    <h3>{{ $content->right_title }}</h3>
                                    <p>{{ $content->right_paragraph }}</p>
                                    @if($content->cta_text && $content->cta_link)
                                        <p><a href="{{ $content->cta_link }}" class="btn btn-primary py-3 px-4">{{ $content->cta_text }}</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 wrap-about pr-md-4 ftco-animate">
                            <h2 class="mb-4">{{ $content->title }}</h2>
                            <div class="content-paragraph">
                                {!! $content->left_paragraph !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            {{-- Second Section and beyond: Image Left, Text Right --}}
            <section class="ftco-section">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-5 ftco-animate">
                            <div class="img" style="background-image: url({{ $content->right_image_path ? asset('storage/' . $content->right_image_path) : asset('website/images/about.jpg') }}); width: 100%; height: 300px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        </div>
                        <div class="col-md-7 ftco-animate pl-md-5">
                            <h2 class="mb-4">{{ $content->title }}</h2>
                            <div class="content-paragraph">
                                {!! $content->left_paragraph !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
    @empty
    <!-- Default content if no database content exists -->
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about align-items-stretch">
                    <div class="wrap-about-border">
                        <div class="img" style="background-image: url({{ asset('website/images/about.jpg') }}); border"></div>
                        <div class="text">
                            <h3>Read Our Success Story for Inspiration</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            <p><a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4">Contact us</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 wrap-about pr-md-4 ftco-animate">
                    <h2 class="mb-4">Welcome to {{ config('app.name', 'JasaIbnu') }}</h2>
                    <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word.</p>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                </div>
            </div>
        </div>
    </section>
    @endforelse

    <!-- Blue Banner Section -->
    @if($heroSection)
    @php
        $bannerBg = asset('website/images/bg_3.jpg'); // default
        if($heroSection && $heroSection->hero_image) {
            $bannerBg = asset('storage/' . $heroSection->hero_image) . '?v=' . strtotime($heroSection->updated_at);
        }
    @endphp
    <section class="ftco-intro ftco-no-pb img" style="background-image: url('{{ $bannerBg }}');">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-10 text-center heading-section heading-section-white ftco-animate">
                    <h2 class="mb-0">{{ $heroSection->tagline ?? 'You Always Get the Best Guidance' }}</h2>
                </div>
            </div>	
        </div>
    </section>

    <!-- Statistics Counter Section -->
    <section class="ftco-counter" id="section-counter">
        <div class="container">
            <div class="row d-md-flex align-items-center justify-content-center">
                <div class="wrapper">
                    <div class="row d-md-flex align-items-center">
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $heroSection->projects_completed }}">0</strong>
                                    <span>Projects Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $heroSection->satisfied_customers }}">0</strong>
                                    <span>Satisfied Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $heroSection->awards_received }}">0</strong>
                                    <span>Awards Received</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $heroSection->years_experience }}">0</strong>
                                    <span>Years of Experience</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    
    <!-- Testimonials Section -->
    @if($testimonials->where('is_active', true)->count() > 0)
        @php $firstTestimonial = $testimonials->where('is_active', true)->first(); @endphp
        <section class="ftco-section testimony-section">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 text-center heading-section ftco-animate">
                        <h2 class="mb-4">{{ $firstTestimonial->section_title ?? 'Our Clients Says' }}</h2>
                        <p>{{ $firstTestimonial->section_subtext ?? 'Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country' }}</p>
                    </div>
                </div>
                <div class="row ftco-animate justify-content-center">
                    <div class="col-md-12">
                        <div class="carousel-testimony owl-carousel">
                            @foreach($testimonials->where('is_active', true) as $testimonial)
                            <div class="item">
                                <div class="testimony-wrap d-flex">
                                    <div class="user-img" style="background-image: url({{ $testimonial->photo_path ? asset('storage/' . $testimonial->photo_path) : asset('website/images/person_1.jpg') }})">
                                    </div>
                                    <div class="text pl-4">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="icon-quote-left"></i>
                                        </span>
                                        <p>{{ $testimonial->message }}</p>
                                        <p class="name">{{ $testimonial->name }}</p>
                                        <span class="position">{{ $testimonial->position }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">Our Clients Says</h2>
                    <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country</p>
                </div>
            </div>
            <div class="row ftco-animate justify-content-center">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img" style="background-image: url({{ asset('website/images/person_1.jpg') }})">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Racky Henderson</p>
                                    <span class="position">Father</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection