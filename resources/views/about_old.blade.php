<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us - {{ config('app.name', 'JasaIbnu') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <style>
        body {
            font-family: "Nunito Sans", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.8;
            color: #999999;
        }
        
        .bg-top {
            background: #007bff;
            padding: 10px 0;
        }
        
        .topper {
            color: white;
        }
        
        .topper .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255,255,255,.1);
        }
        
        .navbar-brand {
            color: #007bff;
            font-weight: 900;
            font-size: 1.8rem;
        }
        
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,.8);
            padding: 1rem 1.5rem;
        }
        
        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #007bff;
        }
        
        .hero-wrap {
            width: 100%;
            height: 100vh;
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
        
        .hero-wrap .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            opacity: .3;
            background: #000000;
        }
        
        .hero-wrap.hero-wrap-2 {
            height: 60vh;
        }
        
        .hero-wrap .slider-text {
            height: 100vh;
        }
        
        .hero-wrap.hero-wrap-2 .slider-text {
            height: 60vh;
        }
        
        .slider-text {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            position: relative;
            z-index: 3;
        }
        
        .bread {
            font-size: 4rem;
            font-weight: 900;
            color: #ffffff;
        }
        
        .breadcrumbs {
            color: rgba(255,255,255,.8);
        }
        
        .ftco-section {
            padding: 7em 0;
        }
        
        .ftco-intro {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            position: relative;
            padding: 4em 0;
        }
        
        .ftco-intro .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            opacity: .8;
            background: #007bff;
        }
        
        .heading-section-white h2 {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 600;
        }
        
        .ftco-counter {
            background: #007bff;
            padding: 4em 0;
        }
        
        .counter-wrap .block-18 {
            text-align: center;
        }
        
        .counter-wrap .block-18 .icon {
            font-size: 3rem;
            color: #ffffff;
            margin-bottom: 1rem;
        }
        
        .counter-wrap .block-18 .text .number {
            display: block;
            font-size: 3rem;
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
        }
        
        .counter-wrap .block-18 .text span:last-child {
            color: rgba(255,255,255,.7);
            font-size: .9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .testimony-section {
            padding: 7em 0;
            background: #f8f9fa;
        }
        
        .heading-section h2 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #000000;
        }
        
        .carousel-testimony .item {
            padding: 0 15px;
        }
        
        .testimony-wrap {
            background: #ffffff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,.1);
        }
        
        .testimony-wrap .user-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
        
        .testimony-wrap .quote {
            width: 30px;
            height: 30px;
            background: #007bff;
            color: #ffffff;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
        
        .testimony-wrap .text p:first-child {
            color: #666666;
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .testimony-wrap .text .name {
            font-weight: 600;
            color: #000000;
            margin-bottom: 0;
        }
        
        .testimony-wrap .text .position {
            color: #007bff;
            font-size: .9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        }
        
        .stats-section {
            background: #f8f9fa;
            padding: 80px 0;
        }
        
        .stat-card {
            background: white;
            padding: 40px 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            display: block;
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .testimonials-section {
            padding: 80px 0;
        }
        
        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
        
        .testimonial-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #0056b3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2rem;
        }
        
        .testimonial-message {
            font-style: italic;
            margin-bottom: 20px;
            color: #6c757d;
            line-height: 1.6;
        }
        
        .testimonial-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .testimonial-role {
            color: #007bff;
            font-size: 0.9rem;
        }
        
        .content-section {
            padding: 80px 0;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="bg-top navbar-light">
        <div class="container">
            <div class="row no-gutters d-flex align-items-center align-items-stretch">
                <div class="col-md-4 d-flex align-items-center py-4">
                    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'JasaIbnu') }}</a>
                </div>
                <div class="col-lg-8 d-block">
                    <div class="row d-flex">
                        <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                            <div class="icon d-flex justify-content-center align-items-center"><span class="fas fa-envelope"></span></div>
                            <div class="text">
                                <span>Email</span>
                                <span>info@jasaibnu.id</span>
                            </div>
                        </div>
                        <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                            <div class="icon d-flex justify-content-center align-items-center"><span class="fas fa-phone"></span></div>
                            <div class="text">
                                <span>Call</span>
                                <span>Call Us: +62 123 456 789</span>
                            </div>
                        </div>
                        <div class="col-md topper d-flex align-items-center justify-content-end">
                            <p class="mb-0">
                                <a href="#" class="btn py-2 px-3 btn-primary d-flex align-items-center justify-content-center">
                                    <span>Free Consulting</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex align-items-center px-4">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link pl-0">Home</a></li>
                    <li class="nav-item active"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ route('project') ?? '#' }}" class="nav-link">Projects</a></li>
                    <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="{{ route('blog') ?? '#' }}" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 text-center">
                    <h1 class="mb-2 bread">About Us</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="fas fa-chevron-right"></i></a></span> <span>About us <i class="fas fa-chevron-right"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about align-items-stretch">
                    <div class="wrap-about-border">
                        <div class="img" style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'); border"></div>
                        <div class="text">
                            <h3>Read Our Success Story for Inspiration</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            <p><a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4">Contact us</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 wrap-about pr-md-4">
                    <h2 class="mb-4">Welcome to {{ config('app.name', 'JasaIbnu') }}</h2>
                    @if($aboutSection && $aboutSection->hero_subtitle)
                        <p>{{ $aboutSection->hero_subtitle }}</p>
                    @else
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word.</p>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="ftco-section ftco-counter">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2 d-flex">
                <div class="col-md-6 align-items-stretch d-flex">
                    <div class="img img-video d-flex align-items-center" style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
                        <div class="video justify-content-center">
                            <a href="https://vimeo.com/45830194" class="icon-video d-flex justify-content-center align-items-center">
                                <span class="fas fa-play"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 heading-section pt-md-0 pt-5">
                    <h2 class="mb-4">We Are the Best Consulting Agency</h2>
                    <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                </div>
            </div>	
        </div>
    </section>

    <!-- Hero Tagline Section -->
    <section class="ftco-intro ftco-no-pb img" style="background-image: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-10 text-center heading-section heading-section-white">
                    @if($aboutSection && $aboutSection->tagline)
                        <h2 class="mb-0">{{ $aboutSection->tagline }}</h2>
                    @else
                        <h2 class="mb-0">You Always Get the Best Guidance</h2>
                    @endif
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
                        <div class="col-md d-flex justify-content-center counter-wrap">
                            <div class="block-18">
                                <div class="icon"><span class="fas fa-project-diagram"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->projects_completed ?? 705 }}">0</strong>
                                    <span>Projects Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap">
                            <div class="block-18">
                                <div class="icon"><span class="fas fa-users"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->satisfied_customers ?? 809 }}">0</strong>
                                    <span>Satisfied Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap">
                            <div class="block-18">
                                <div class="icon"><span class="fas fa-trophy"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->awards_received ?? 335 }}">0</strong>
                                    <span>Awards Received</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap">
                            <div class="block-18">
                                <div class="icon"><span class="fas fa-calendar-alt"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{ $aboutSection->years_experience ?? 35 }}">0</strong>
                                    <span>Years of Experienced</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section">
                    <h2 class="mb-4">Our Clients Says</h2>
                    <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        @forelse($testimonials as $testimonial)
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img" style="background-image: url('{{ $testimonial->image ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}')">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fas fa-quote-left"></i>
                                    </span>
                                    <p>{{ $testimonial->message }}</p>
                                    <p class="name">{{ $testimonial->name }}</p>
                                    <span class="position">{{ $testimonial->role }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <!-- Default testimonials if none exist -->
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img" style="background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80')">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fas fa-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Racky Henderson</p>
                                    <span class="position">Father</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img" style="background-image: url('https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80')">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fas fa-quote-left"></i>
                                    </span>
                                    <p>Outstanding service! The team delivered exactly what we needed on time and within budget.</p>
                                    <p class="name">Henry Dee</p>
                                    <span class="position">CEO & Founder</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img" style="background-image: url('https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80')">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fas fa-quote-left"></i>
                                    </span>
                                    <p>Professional, reliable, and innovative. They exceeded our expectations in every way.</p>
                                    <p class="name">Mark Huff</p>
                                    <span class="position">Business Owner</span>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
                    <div class="stat-card">
                        <span class="stat-number" data-target="{{ $aboutSection->satisfied_customers }}">0</span>
                        <div class="stat-label">Satisfied Customers</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <span class="stat-number" data-target="{{ $aboutSection->awards_received }}">0</span>
                        <div class="stat-label">Awards Received</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card">
                        <span class="stat-number" data-target="{{ $aboutSection->years_experience }}">0</span>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        $(document).ready(function(){
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Initialize Owl Carousel for testimonials
            $('.carousel-testimony').owlCarousel({
                center: true,
                loop: true,
                items: 1,
                margin: 30,
                stagePadding: 0,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items: 1
                    },
                    600:{
                        items: 2
                    },
                    1000:{
                        items: 3
                    }
                }
            });

            // Counter Animation
            function animateNumber(element) {
                const target = parseInt(element.attr('data-number'));
                const duration = 2000; // 2 seconds
                
                $({countNum: 0}).animate({
                    countNum: target
                }, {
                    duration: duration,
                    easing: 'linear',
                    step: function() {
                        element.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        element.text(target);
                    }
                });
            }

            // Trigger counter animation when in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $('.number[data-number]').each(function() {
                            animateNumber($(this));
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const counterSection = document.querySelector('#section-counter');
            if (counterSection) {
                observer.observe(counterSection);
            }
        });
    </script>
</body>
</html>