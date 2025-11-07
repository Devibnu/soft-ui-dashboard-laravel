@extends('frontend.layouts.app')

@section('title', 'Services')

@section('content')
<!-- Hero Section - Same as template -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ $headerLayanan && $headerLayanan->gambar_latar ? Storage::url($headerLayanan->gambar_latar) : asset('website/images/bg_1.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">{{ $headerLayanan->judul_utama ?? 'Services' }}</h1>
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a>
                    </span> 
                    <span>Services <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Main Features Section - Template Style -->
<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-5 order-md-last wrap-about align-items-stretch">
                <div class="wrap-about-border ftco-animate">
                    <div class="img" style="background-image: url('{{ $headerFiturUtama && $headerFiturUtama->gambar_cta ? Storage::url($headerFiturUtama->gambar_cta) : asset('website/images/about.jpg') }}'); border"></div>
                    <div class="text">
                        <h3>{{ $headerFiturUtama->judul_cta ?? 'Read Our Success Story for Inspiration' }}</h3>
                        <p>{{ $headerFiturUtama->deskripsi_cta ?? 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.' }}</p>
                        <p><a href="{{ $headerFiturUtama->button_url ?? route('contact') }}" class="btn btn-primary py-3 px-4">{{ $headerFiturUtama->button_text ?? 'Contact us' }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 wrap-about pr-md-4 ftco-animate">
                <h2 class="mb-4">{{ $headerFiturUtama->judul_section ?? 'Our Main Features' }}</h2>
                <p>{{ $headerFiturUtama->deskripsi_section ?? 'Kami menyediakan berbagai layanan berkualitas tinggi dengan teknologi terdepan dan tim berpengalaman untuk membantu mengembangkan bisnis Anda.' }}</p>
                <div class="row mt-5">
                    @if($fiturUtamas->count() > 0)
                        @foreach($fiturUtamas->take(4) as $index => $fitur)
                            <div class="col-lg-6">
                                <div class="services {{ $index == 0 ? 'active' : '' }} text-center">
                                    <div class="icon mt-2 d-flex justify-content-center align-items-center">
                                        @if($fitur->ikon_fitur)
                                            <img src="{{ Storage::url($fitur->ikon_fitur) }}" alt="{{ $fitur->judul_fitur }}" style="width: 50px; height: 50px;">
                                        @else
                                            <span class="flaticon-collaboration"></span>
                                        @endif
                                    </div>
                                    <div class="text media-body">
                                        <h3>{{ $fitur->judul_fitur }}</h3>
                                        <p>{{ Str::limit($fitur->deskripsi_fitur, 80) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Default features if no data -->
                        <div class="col-lg-6">
                            <div class="services active text-center">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-collaboration"></span></div>
                                <div class="text media-body">
                                    <h3>Organization</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                            <div class="services text-center">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
                                <div class="text media-body">
                                    <h3>Risk Analysis</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services text-center">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
                                <div class="text media-body">
                                    <h3>Marketing Strategy</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                            <div class="services text-center">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-handshake"></span></div>
                                <div class="text media-body">
                                    <h3>Capital Market</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Best Services Section - Template Style -->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-8 text-center heading-section ftco-animate">
                <h2 class="mb-4">{{ $headerDaftarLayanan->judul_section ?? 'Our Best Services' }}</h2>
                <p>{{ $headerDaftarLayanan->deskripsi_section ?? 'Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country' }}</p>
            </div>
        </div>
        <div class="row no-gutters">
            @if($daftarLayanans->count() > 0)
                @foreach($daftarLayanans->take(6) as $index => $layanan)
                    <div class="col-lg-4 d-flex">
                        <div class="services-2 {{ $index == 0 ? 'noborder-left' : '' }} {{ $index >= 3 ? 'noborder-bottom' : '' }} text-center ftco-animate">
                            <div class="icon mt-2 d-flex justify-content-center align-items-center">
                                @if($layanan->gambar_layanan)
                                    <img src="{{ Storage::url($layanan->gambar_layanan) }}" alt="{{ $layanan->nama_layanan }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <span class="flaticon-analysis"></span>
                                @endif
                            </div>
                            <div class="text media-body">
                                <h3>{{ $layanan->nama_layanan }}</h3>
                                <p>{{ Str::limit($layanan->deskripsi_layanan, 80) }}</p>
                                @if($layanan->harga_layanan)
                                    <p class="font-weight-bold text-primary">{{ $layanan->harga_layanan }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Default services if no data -->
                <div class="col-lg-4 d-flex">
                    <div class="services-2 noborder-left text-center ftco-animate">
                        <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
                        <div class="text media-body">
                            <h3>Business Analysis</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="services-2 text-center ftco-animate">
                        <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-business"></span></div>
                        <div class="text media-body">
                            <h3>Business Consulting</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="services-2 text-center ftco-animate">
                        <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-insurance"></span></div>
                        <div class="text media-body">
                            <h3>Business Insurance</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="services-2 noborder-left noborder-bottom text-center ftco-animate">
                        <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-money"></span></div>
                        <div class="text media-body">
                            <h3>Global Investigation</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="services-2 text-center noborder-bottom ftco-animate">
                        <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-rating"></span></div>
                        <div class="text media-body">
                            <h3>Audit &amp; Evaluation</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="services-2 text-center noborder-bottom ftco-animate">
                        <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
                        <div class="text media-body">
                            <h3>Marketing Strategy</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>


@endsection