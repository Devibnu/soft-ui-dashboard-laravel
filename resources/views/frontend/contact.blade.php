@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('website/images/bg_1.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">{{ $kontak->judul_halaman ?? 'Contact Us' }}</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
                        <span>Contact <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="ftco-section contact-section">
        <div class="container">
            @if($kontak && $kontak->status_aktif)
                <div class="row d-flex mb-5 contact-info justify-content-center">
                    <div class="col-md-8">
                        <div class="row mb-5">
                            <div class="col-md-4 text-center py-4">
                                <div class="icon">
                                    <span class="icon-map-o"></span>
                                </div>
                                <p><span>Address:</span> {{ $kontak->alamat }}</p>
                            </div>
                            <div class="col-md-4 text-center border-height py-4">
                                <div class="icon">
                                    <span class="icon-mobile-phone"></span>
                                </div>
                                <p><span>Phone:</span> <a href="tel:{{ $kontak->telepon }}">{{ $kontak->telepon }}</a></p>
                            </div>
                            <div class="col-md-4 text-center py-4">
                                <div class="icon">
                                    <span class="icon-envelope-o"></span>
                                </div>
                                <p><span>Email:</span> <a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="row block-9 justify-content-center mb-5">
                <div class="col-md-8 mb-md-5">
                    @if($kontak && $kontak->subjudul)
                        <h2 class="text-center">{{ $kontak->subjudul }}</h2>
                    @endif
                    
                    @if($kontak && $kontak->deskripsi_pesan)
                        <p class="text-center">{{ $kontak->deskripsi_pesan }}</p>
                    @endif
                    
                    <form action="#" class="bg-light p-5 contact-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>
    </section>

    <!-- Maps Section - Full Width Edge to Edge -->
    @if($kontak && $kontak->map_embed)
        <section class="full-width-map">
            <h4 class="text-center mb-4">Lokasi Kami</h4>
            <div class="map-full-container">
                {!! $kontak->map_embed !!}
                <!-- Fallback for Maps error -->
                <div class="map-fallback text-center mt-3" style="display: none;">
                    <div class="alert alert-info">
                        <i class="fas fa-map-marker-alt mb-2" style="font-size: 1.5rem; color: #007bff;"></i>
                        <h6><strong>Lokasi Kami</strong></h6>
                        <p class="mb-1 small">{{ $kontak->alamat ?? 'Alamat akan diupdate segera' }}</p>
                        <small class="text-muted">Peta tidak dapat dimuat saat ini.</small>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- WhatsApp Floating Button -->
    @if($kontak && $kontak->nomor_whatsapp)
        <div class="whatsapp-float">
            <a href="https://wa.me/{{ $kontak->nomor_whatsapp }}" target="_blank" rel="noopener">
                @if($kontak->logo_whatsapp)
                    <img src="{{ Storage::url($kontak->logo_whatsapp) }}" alt="WhatsApp" style="width: 60px; height: 60px;">
                @else
                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i>
                @endif
            </a>
        </div>
    @endif

<style>
/* WhatsApp Floating Button Styles */
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 20px;
    right: 20px;
    background-color: #25D366;
    color: white;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 3px #999;
    z-index: 100;
    transition: all 0.3s ease;
}

.whatsapp-float:hover {
    background-color: #20BA5A;
    transform: scale(1.1);
}

.whatsapp-float a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.whatsapp-float img {
    border-radius: 50%;
}

/* Contact Info Styling */
.contact-info .icon {
    width: 60px;
    height: 60px;
    background: rgba(52, 144, 220, 0.1);
    border-radius: 50%;
    margin: 0 auto 20px auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-info .icon span {
    font-size: 24px;
    color: #3490dc;
}

.contact-info p span {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

/* Full Width Map Section */
.full-width-map {
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    margin-top: 50px;
    margin-bottom: 5px;
}

.full-width-map h4 {
    padding: 15px 0;
    background: #f8f9fa;
    margin-bottom: 0;
}

.map-full-container {
    width: 100%;
    height: 450px;
    position: relative;
}

.map-full-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
    display: block;
}

/* Fallback styles */
.map-fallback {
    display: none;
}

.map-fallback.show {
    display: block !important;
}

/* Mobile responsiveness for full width maps */
@media (max-width: 768px) {
    .map-full-container {
        height: 350px;
    }
    
    .full-width-map h4 {
        padding: 15px 0;
        font-size: 1.2rem;
    }
}

@media (max-width: 576px) {
    .map-full-container {
        height: 300px;
    }
}

.embed-responsive-16by9 {
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

#map iframe, 
.map-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100% !important;
    height: 100% !important;
    border: 0;
    border-radius: 8px;
}

/* Contact form improvements */
.contact-form {
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.contact-form .form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 12px 15px;
    font-size: 14px;
}

.contact-form .btn-primary {
    background-color: #3490dc;
    border-color: #3490dc;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.contact-form .btn-primary:hover {
    background-color: #2779bd;
    border-color: #2779bd;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 15px;
        right: 15px;
    }
    
    .whatsapp-float img {
        width: 50px !important;
        height: 50px !important;
    }
    
    .contact-info .col-md-4 {
        margin-bottom: 30px;
    }
    
    #map iframe {
        height: 300px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Google Maps loading and errors
    const iframe = document.querySelector('.map-container iframe');
    const fallback = document.querySelector('.map-fallback');
    
    if (iframe && fallback) {
        let mapLoaded = false;
        
        // Set a timeout to check if map loads
        const checkMapTimeout = setTimeout(function() {
            if (!mapLoaded) {
                console.log('Google Maps loading timeout, showing fallback');
                showFallback();
            }
        }, 5000); // 5 second timeout
        
        // Listen for load event
        iframe.addEventListener('load', function() {
            console.log('Google Maps iframe loaded');
            mapLoaded = true;
            clearTimeout(checkMapTimeout);
            
            // Additional check for actual content
            try {
                // Try to access iframe content to detect "Oops!" errors
                setTimeout(function() {
                    if (iframe.contentWindow) {
                        const iframeDoc = iframe.contentWindow.document;
                        if (iframeDoc && iframeDoc.body) {
                            const bodyText = iframeDoc.body.innerText || iframeDoc.body.textContent;
                            if (bodyText.toLowerCase().includes('oops') || bodyText.toLowerCase().includes('something went wrong')) {
                                console.log('Google Maps error detected in content');
                                showFallback();
                            }
                        }
                    }
                }, 2000);
            } catch (e) {
                // Cross-origin restrictions prevent access, which is normal
                console.log('Maps iframe loaded (cross-origin restrictions apply)');
            }
        });
        
        // Listen for error event
        iframe.addEventListener('error', function() {
            console.log('Google Maps iframe error');
            showFallback();
        });
        
        // Function to show fallback
        function showFallback() {
            if (iframe.parentElement) {
                iframe.parentElement.style.display = 'none';
            }
            fallback.classList.add('show');
        }
    }
});

// Global callback for Google Maps API errors
window.gm_authFailure = function() {
    console.log('Google Maps API authentication failed');
    const fallback = document.querySelector('.map-fallback');
    if (fallback) {
        fallback.classList.add('show');
    }
};
</script>
@endsection