<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Jasa Ibnu') }} - Your Digital Solution Partner</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    @php
        $activeFavicon = \App\Models\FaviconWebsite::where('status', 1)->first();
        $activeLogo = \App\Models\LogoWebsite::where('status', 1)->first();
    @endphp
    @if($activeFavicon && $activeFavicon->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $activeFavicon->favicon) }}?v={{ $activeFavicon->updated_at->timestamp }}">
    @elseif($activeLogo && $activeLogo->gambar)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $activeLogo->gambar) }}?v={{ $activeLogo->updated_at->timestamp }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    @endif
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
</head>
<body>
    @php
        // Get active header info and logo from database - force fresh query
        \Illuminate\Support\Facades\DB::connection()->disableQueryLog();
        $headerInfo = \App\Models\HeaderInfo::where('status', true)->orderBy('updated_at', 'desc')->first();
        $logoWebsite = \App\Models\LogoWebsite::where('status', true)->orderBy('updated_at', 'desc')->first();
    @endphp
    
    <!-- Top Bar & Navigation -->
    <div class="bg-top navbar-light">
        <div class="container">
            <div class="row no-gutters d-flex align-items-center align-items-stretch">
                <div class="col-md-4 d-flex align-items-center py-4">
                    <a class="navbar-brand" href="{{ route('home') }}" style="display: flex; align-items: center;">
                        @if($logoWebsite && $logoWebsite->gambar)
                            <img src="{{ asset('storage/' . $logoWebsite->gambar) }}?v={{ $logoWebsite->updated_at->timestamp }}&t={{ time() }}" alt="Logo" style="max-height: 50px; margin-right: 10px; object-fit: contain;">
                        @endif
                        <span>{{ $headerInfo ? $headerInfo->nama_website : config('app.name', 'Jasa Ibnu') }}</span>
                    </a>
                </div>
                <div class="col-lg-8 d-block">
                    <div class="row d-flex">
                        <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                            <div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <div class="text">
                                <span>Email</span>
                                <span>{{ $headerInfo ? $headerInfo->email : 'info@jasaibnu.id' }}</span>
                            </div>
                        </div>
                        <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                            <div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <div class="text">
                                <span>Call</span>
                                <span>Call Us: {{ $headerInfo ? $headerInfo->telepon : '+62 xxx xxxx' }}</span>
                            </div>
                        </div>
                        <div class="col-md topper d-flex align-items-center justify-content-end">
                            <p class="mb-0 d-block">
                                @if($headerInfo)
                                    <a href="{{ $headerInfo->cta_link }}" class="btn py-2 px-3 btn-primary">
                                        <span>{{ $headerInfo->cta_text }}</span>
                                    </a>
                                @else
                                    <a href="{{ route('contact') }}" class="btn py-2 px-3 btn-primary">
                                        <span>Free Consulting</span>
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <form action="#" class="searchform order-lg-last">
                <div class="form-group d-flex">
                    <input type="text" class="form-control pl-3" placeholder="Search">
                    <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
                </div>
            </form>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link pl-0">Home</a></li>
                    <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ url('/projects') }}" class="nav-link">Projects</a></li>
                    <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
    
    <!-- Hero Slider Section -->
    <section class="home-slider owl-carousel">
        @if($hero)
            <div class="slider-item" style="background-image:url({{ asset('storage/' . $hero->gambar_background) }});">
                <div class="overlay" style="background: {{ $hero->warna_overlay ?? 'rgba(0, 0, 0, 0.5)' }};"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                        <div class="col-md-7 ftco-animate">
                            @if($hero->subjudul)
                                <span class="subheading">{{ $hero->subjudul }}</span>
                            @endif
                            <h1 class="mb-4">{{ $hero->judul }}</h1>
                            @if($hero->deskripsi)
                                <div class="hero-description">{!! $hero->deskripsi !!}</div>
                            @endif
                            @if($hero->tombol_text && $hero->tombol_link)
                                @php
                                    // Detect external links (with http/https OR domain patterns)
                                    $link = $hero->tombol_link;
                                    $hasProtocol = str_starts_with($link, 'http://') || str_starts_with($link, 'https://');
                                    $isDomain = !str_starts_with($link, '/') && (str_contains($link, '.com') || str_contains($link, '.id') || str_contains($link, '.co') || str_contains($link, '.net') || str_contains($link, '.org'));
                                    $isExternal = $hasProtocol || $isDomain;
                                    
                                    // Add https:// if it's a domain without protocol
                                    if ($isDomain && !$hasProtocol) {
                                        $link = 'https://' . $link;
                                    }
                                @endphp
                                <p>
                                    <a href="{{ $link }}" 
                                       class="btn btn-primary px-4 py-3 mt-3"
                                       @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>
                                        {{ $hero->tombol_text }}
                                        @if($isExternal) <i class="fas fa-external-link-alt ms-1"></i> @endif
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Default Hero if no data -->
            <div class="slider-item" style="background-image:url({{ asset('website/images/bg_1.jpg') }});">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                        <div class="col-md-7 ftco-animate">
                            <span class="subheading">Welcome to {{ config('app.name') }}</span>
                            <h1 class="mb-4">We Are The Best Digital Solution Partner</h1>
                            <p><a href="{{ route('services') }}" class="btn btn-primary px-4 py-3 mt-3">Our Services</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- About Section with Main Features -->
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about align-items-stretch">
                    <div class="wrap-about-border ftco-animate">
                        @if($headerFiturUtama && $headerFiturUtama->gambar_cta)
                            <div class="img" style="background-image: url({{ str_replace(' ', '%20', asset('storage/' . $headerFiturUtama->gambar_cta)) }}); border"></div>
                        @else
                            <div class="img" style="background-image: url({{ asset('website/images/about.jpg') }}); border"></div>
                        @endif
                        <div class="text">
                            @if($headerFiturUtama)
                                <h3>{{ $headerFiturUtama->judul_cta }}</h3>
                                <p>{{ $headerFiturUtama->deskripsi_cta }}</p>
                                @if($headerFiturUtama->button_text && $headerFiturUtama->button_url)
                                    <p><a href="{{ $headerFiturUtama->button_url }}" class="btn btn-primary py-3 px-4">{{ $headerFiturUtama->button_text }}</a></p>
                                @else
                                    <p><a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4">Contact us</a></p>
                                @endif
                            @else
                                <h3>Read Our Success Story for Inspiration</h3>
                                <p>We are dedicated to providing the best digital solutions for your business needs.</p>
                                <p><a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4">Contact us</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-7 wrap-about pr-md-4 ftco-animate">
                    <h2 class="mb-4">{{ $headerFiturUtama ? $headerFiturUtama->judul_section : 'Our Main Features' }}</h2>
                    @if($headerFiturUtama)
                        <p>{{ $headerFiturUtama->deskripsi_section }}</p>
                    @else
                        <p>We provide comprehensive solutions to help your business grow and succeed in the digital world.</p>
                    @endif
                    
                    <div class="row mt-5">
                        @if($features->count() > 0)
                            @foreach($features->take(4) as $index => $feature)
                            <div class="col-lg-6">
                                <div class="services {{ $index == 0 ? 'active' : '' }} text-center">
                                    <div class="icon mt-2 d-flex justify-content-center align-items-center">
                                        @if($feature->ikon_fitur)
                                            <img src="{{ asset('storage/' . $feature->ikon_fitur) }}" alt="{{ $feature->judul_fitur }}" style="width: 50px; height: 50px; object-fit: contain;">
                                        @else
                                            <span class="flaticon-{{ ['collaboration', 'analysis', 'search-engine', 'handshake'][$index % 4] }}"></span>
                                        @endif
                                    </div>
                                    <div class="text media-body">
                                        <h3>{{ $feature->judul_fitur }}</h3>
                                        <p>{{ Str::limit($feature->deskripsi_fitur, 80) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-lg-6">
                                <div class="services active text-center">
                                    <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-collaboration"></span></div>
                                    <div class="text media-body">
                                        <h3>Organization</h3>
                                        <p>Professional organization and management solutions.</p>
                                    </div>
                                </div>
                                <div class="services text-center">
                                    <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
                                    <div class="text media-body">
                                        <h3>Analysis</h3>
                                        <p>In-depth business and market analysis.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="services text-center">
                                    <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
                                    <div class="text media-body">
                                        <h3>Strategy</h3>
                                        <p>Strategic planning and consulting services.</p>
                                    </div>
                                </div>
                                <div class="services text-center">
                                    <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-handshake"></span></div>
                                    <div class="text media-body">
                                        <h3>Partnership</h3>
                                        <p>Building strong business partnerships.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner 1 (uses AboutHeroSection if available) -->
    @php
        // Use aboutSection (passed from controller) if available
        $aboutHeroBg = isset($aboutSection) && !empty($aboutSection->hero_image) ? asset('storage/' . $aboutSection->hero_image) : asset('website/images/bg_3.jpg');
        $aboutHeroTagline = isset($aboutSection) && !empty($aboutSection->tagline) ? $aboutSection->tagline : 'You Always Get the Best Guidance';
    @endphp
    <section class="ftco-intro ftco-no-pb img" style="background-image: url({{ $aboutHeroBg }});">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-10 text-center heading-section heading-section-white ftco-animate">
                    <h2 class="mb-0">{{ $aboutHeroTagline }}</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Counter Section -->
    <section class="ftco-counter" id="section-counter">
        <div class="container">
            <div class="row d-md-flex align-items-center justify-content-center">
                <div class="wrapper">
                    <div class="row d-md-flex align-items-center">
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->projects_completed ?? 1 }}">0</strong>
                                    <span>Projects Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->satisfied_customers ?? 809 }}">0</strong>
                                    <span>Satisfied Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->awards_received ?? 335 }}">0</strong>
                                    <span>Awards Received</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->years_experience ?? 5 }}">0</strong>
                                    <span>Years of Experience</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">{{ $headerDaftarLayanan->judul_section ?? 'Our Best Services' }}</h2>
                    <p>{{ $headerDaftarLayanan->deskripsi_section ?? 'Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country' }}</p>
                </div>
            </div>
            <div class="row no-gutters">
                @php
                    $allServices = $services->count() > 0 ? $services : collect([
                        (object)['nama_layanan' => 'Business Analysis', 'deskripsi_layanan' => 'Far far away, behind the word mountains, far from the countries Vokalia.', 'gambar_layanan' => null],
                        (object)['nama_layanan' => 'Business Consulting', 'deskripsi_layanan' => 'Far far away, behind the word mountains, far from the countries Vokalia.', 'gambar_layanan' => null],
                        (object)['nama_layanan' => 'Business Insurance', 'deskripsi_layanan' => 'Far far away, behind the word mountains, far from the countries Vokalia.', 'gambar_layanan' => null],
                        (object)['nama_layanan' => 'Global Investigation', 'deskripsi_layanan' => 'Far far away, behind the word mountains, far from the countries Vokalia.', 'gambar_layanan' => null],
                        (object)['nama_layanan' => 'Audit & Evaluation', 'deskripsi_layanan' => 'Far far away, behind the word mountains, far from the countries Vokalia.', 'gambar_layanan' => null],
                        (object)['nama_layanan' => 'Marketing Strategy', 'deskripsi_layanan' => 'Far far away, behind the word mountains, far from the countries Vokalia.', 'gambar_layanan' => null],
                    ]);
                @endphp
                @foreach($allServices->take(6) as $index => $service)
                <div class="col-lg-4 d-flex">
                    <div class="services-2 {{ $index == 0 ? 'noborder-left' : '' }} {{ $index >= 3 ? 'noborder-bottom' : '' }} text-center ftco-animate">
                        @if($service->gambar_layanan)
                            <div class="icon mt-2 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/' . $service->gambar_layanan) }}" alt="{{ $service->nama_layanan }}" style="width: 60px; height: 60px; object-fit: contain;">
                            </div>
                        @else
                            <div class="icon mt-2 d-flex justify-content-center align-items-center">
                                <span class="flaticon-{{ ['analysis', 'business', 'insurance', 'money', 'rating', 'search-engine'][$index % 6] }}"></span>
                            </div>
                        @endif
                        <div class="text media-body">
                            <h3>{{ $service->nama_layanan }}</h3>
                            <p>{{ Str::limit($service->deskripsi_layanan, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="ftco-intro ftco-no-pb img" style="background-image: url({{ asset('website/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
                    <h2 class="mb-3 mb-md-0">You Always Get the Best Guidance</h2>
                </div>
                <div class="col-lg-3 col-md-4 ftco-animate">
                    <p class="mb-0"><a href="{{ route('contact') }}" class="btn btn-white py-3 px-4">Request Quote</a></p>
                </div>
            </div>	
        </div>
    </section>

    <!-- Projects Section -->
    <section class="ftco-section ftco-no-pb">
        <div class="container-fluid px-0">
            <div class="row no-gutters justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-4">{{ $headerProjects->judul_section ?? 'Our Recent Projects' }}</h2>
                    <p>{{ $headerProjects->deskripsi_section ?? 'Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country' }}</p>
                    <p></p>
                </div>
            </div>
            <div class="row no-gutters">
                @if($projects->count() > 0)
                    @foreach($projects as $project)
                    <div class="col-md-3">
                        <div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url({{ $project->gambar_utama ? asset('storage/' . $project->gambar_utama) : asset('website/images/project-1.jpg') }});">
                            <div class="overlay"></div>
                            <a href="{{ url('/projects/' . $project->slug) }}" class="btn-site d-flex align-items-center justify-content-center"><span class="icon-subdirectory_arrow_right"></span></a>
                            <div class="text text-center p-4">
                                <h3><a href="{{ url('/projects/' . $project->slug) }}">{{ $project->judul }}</a></h3>
                                <span>{{ $project->deskripsi_singkat ? Str::limit($project->deskripsi_singkat, 50) : 'Project' }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach(range(1, 4) as $i)
                    <div class="col-md-3">
                        <div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url({{ asset('website/images/project-' . $i . '.jpg') }});">
                            <div class="overlay"></div>
                            <a href="#" class="btn-site d-flex align-items-center justify-content-center"><span class="icon-subdirectory_arrow_right"></span></a>
                            <div class="text text-center p-4">
                                <h3><a href="#">Sample Project {{ $i }}</a></h3>
                                <span>Web Design</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Request A Quote Section -->
    @php
        \DB::connection()->disableQueryLog();
        $reqQuote = \DB::table('request_quote_settings')->where('status', 1)->orderBy('updated_at', 'desc')->first();
        // Fallback to AboutHeroSection image if request-quote background not provided
        $aboutHero = \App\Models\AboutHeroSection::first();
        // Determine background image: prefer request quote setting, otherwise about hero, otherwise default
        $rqBg = null;
        if ($reqQuote && !empty($reqQuote->bg_image)) {
            $rqBg = asset('storage/' . $reqQuote->bg_image);
        } elseif ($aboutHero && !empty($aboutHero->hero_image)) {
            $rqBg = asset('storage/' . $aboutHero->hero_image);
        } else {
            $rqBg = asset('website/images/bg_5.jpg');
        }
        // Determine overlay color: prefer request quote setting, otherwise about hero (if present), otherwise default
        $rqOverlay = ($reqQuote && !empty($reqQuote->overlay_color)) ? $reqQuote->overlay_color : (isset($aboutHero->overlay_color) && !empty($aboutHero->overlay_color) ? $aboutHero->overlay_color : 'rgba(0, 0, 0, 0.5)');
    @endphp
    @if($reqQuote || $aboutHero)
    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb" style="background-image: url('{{ $rqBg }}');" data-stellar-background-ratio="0.5">
        <div class="overlay" style="background: {{ $rqOverlay }} !important; opacity: 1 !important;"></div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 py-5 px-md-5">
                    <div class="py-md-5">
                        <div class="heading-section heading-section-white ftco-animate mb-5">
                            <h2 class="mb-4">{{ $reqQuote->title }}</h2>
                            <p>{{ $reqQuote->subtitle }}</p>
                        </div>
                        <form id="requestQuoteForm" class="appointment-form ftco-animate">
                            <div class="d-md-flex">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                </div>
                                <div class="form-group ml-md-4">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="d-md-flex">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group ml-md-4">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                                </div>
                            </div>
                            <div class="d-md-flex">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="service" class="form-control" required>
                                                <option value="">Select Service</option>
                                                @foreach($requestQuoteServices as $service)
                                                    <option value="{{ $service->slug }}">{{ $service->nama_service }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ml-md-4">
                                    <textarea name="message" cols="30" rows="2" class="form-control" placeholder="Message" required></textarea>
                                </div>
                            </div>
                            <div class="d-md-flex">
                                <div class="form-group ml-auto">
                                    <input type="submit" value="{{ $reqQuote->button_text }}" class="btn btn-white py-3 px-4">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Blog Section -->
    @if($posts->count() > 0)
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    @php
                        // If controller didn't provide headerBlog, try a direct DB fallback to avoid missing header text
                        if (!isset($headerBlog) || !$headerBlog) {
                            try {
                                $hb = \DB::table('header_blog')->orderBy('updated_at', 'desc')->first();
                            } catch (\Throwable $e) {
                                $hb = null;
                            }
                        } else {
                            $hb = $headerBlog;
                        }
                    @endphp
                    <h2 class="mb-4">{{ $hb && isset($hb->judul_section) ? $hb->judul_section : 'Recent Blog' }}</h2>
                    <p>{{ $hb && isset($hb->deskripsi_section) ? $hb->deskripsi_section : 'Stay updated with our latest insights, tips, and industry news.' }}</p>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-6 col-lg-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="{{ url('/blog/' . $post->slug) }}" class="block-20 d-flex align-items-end" style="background-image: url('{{ $post->gambar ? asset('storage/' . $post->gambar) : asset('website/images/image_1.jpg') }}');">
                            <div class="meta-date text-center p-2">
                                <span class="day">{{ $post->tanggal_dibuat->format('d') }}</span>
                                <span class="mos">{{ $post->tanggal_dibuat->format('M') }}</span>
                                <span class="yr">{{ $post->tanggal_dibuat->format('Y') }}</span>
                            </div>
                        </a>
                        <div class="text bg-white p-4">
                            <h3 class="heading"><a href="{{ url('/blog/' . $post->slug) }}">{{ $post->judul }}</a></h3>
                            <p>{{ $post->ringkasan ? Str::limit($post->ringkasan, 120) : Str::limit(strip_tags($post->isi), 120) }}</p>
                            <div class="d-flex align-items-center mt-4">
                                <p class="mb-0"><a href="{{ url('/blog/' . $post->slug) }}" class="btn btn-primary">Read More <span class="ion-ios-arrow-round-forward"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <a href="{{ url('/blog') }}" class="btn btn-primary py-3 px-5">View All Posts</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Section -->
    @if(count($testimonials) > 0)
    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">Our Clients Says</h2>
                    <p>See what our satisfied clients have to say about working with us.</p>
                </div>
            </div>
            <div class="row ftco-animate justify-content-center">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img" style="background-image: url({{ isset($testimonial->image) ? asset('storage/' . $testimonial->image) : asset('website/images/person_1.jpg') }})">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>{{ $testimonial->message ?? '' }}</p>
                                    <p class="name">{{ $testimonial->name ?? 'Client' }}</p>
                                    <span class="position">{{ $testimonial->role ?? 'Customer' }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Request A Quote Section (moved) -->

    <!-- Footer -->
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">{{ config('app.name', 'Jasa Ibnu') }}</h2>
                        <p>Your trusted partner for digital solutions and business consulting services.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Quick Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="py-2 d-block">Home</a></li>
                            <li><a href="{{ route('about') }}" class="py-2 d-block">About</a></li>
                            <li><a href="{{ route('services') }}" class="py-2 d-block">Services</a></li>
                            <li><a href="{{ url('/projects') }}" class="py-2 d-block">Projects</a></li>
                            <li><a href="{{ url('/blog') }}" class="py-2 d-block">Blog</a></li>
                            <li><a href="{{ route('contact') }}" class="py-2 d-block">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Contact Information</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Indonesia</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+62 xxx xxxx</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@jasaibnu.id</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Copyright &copy; {{ date('Y') }} All rights reserved | {{ config('app.name', 'Jasa Ibnu') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

    <!-- Scripts -->
    <script src="{{ asset('website/js/jquery.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('website/js/popper.min.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('website/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('website/js/aos.js') }}"></script>
    <script src="{{ asset('website/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('website/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Request Quote Form Handler -->
    <script>
    $(document).ready(function() {
        $('#requestQuoteForm').on('submit', function(e) {
            e.preventDefault();

            // collect form values (support select for service)
            var formData = {
                first_name: $('input[name="first_name"]').val(),
                last_name: $('input[name="last_name"]').val(),
                email: $('input[name="email"]').val(),
                service: $('select[name="service"]').val() || $('input[name="service"]').val(),
                phone: $('input[name="phone"]').val(),
                message: $('textarea[name="message"]').val(),
                _token: '{{ csrf_token() }}'
            };

            // Find submit control (input or button)
            var submitBtn = $(this).find('input[type="submit"], button[type="submit"]');
            var isInput = submitBtn.is('input');
            // store original label
            var origLabel = isInput ? submitBtn.val() : submitBtn.html();
            submitBtn.data('orig-label', origLabel);

            // Disable and show loading
            submitBtn.prop('disabled', true);
            if (isInput) {
                submitBtn.val('Sending...');
            } else {
                submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span>Sending...');
            }

            $.ajax({
                url: '{{ route("request-quote.send") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message || 'Permintaan penawaran Anda telah berhasil dikirim. Kami akan menghubungi Anda segera!',
                        confirmButtonColor: '#4e73df'
                    });
                    // Reset form
                    $('#requestQuoteForm')[0].reset();
                },
                error: function(xhr) {
                    var errorMsg = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        errorMsg = Object.values(errors).flat().join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMsg,
                        confirmButtonColor: '#4e73df'
                    });
                },
                complete: function() {
                    // Re-enable submit control and restore label
                    submitBtn.prop('disabled', false);
                    var restore = submitBtn.data('orig-label') || 'Send Message';
                    if (isInput) {
                        submitBtn.val(restore);
                    } else {
                        submitBtn.html(restore);
                    }
                }
            });
        });
    });
    </script>
</body>
</html>
