@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="page-header min-height-300 border-radius-xl mt-4" 
                 style="background-image: url('{{ asset('soft-ui/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <i class="fas fa-info-circle bg-gradient-primary text-white border-radius-md p-3 text-lg"></i>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">About Management Dashboard</h5>
                            <p class="mb-0 font-weight-bold text-sm">Kelola header slideshow dan konten halaman About</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" href="{{ route('adminui.about.headers') }}" role="tab">
                                        <i class="ni ni-image"></i>
                                        <span class="ms-1">Headers</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" href="{{ route('adminui.about.contents') }}" role="tab">
                                        <i class="ni ni-collection"></i>
                                        <span class="ms-1">Contents</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Headers</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $activeHeaders }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-image text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Headers</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalHeaders }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="ni ni-album-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Contents</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $activeContents }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-collection text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Contents</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalContents }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Recent Headers</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">{{ count($recentHeaders) }}</span> headers terbaru
                    </p>
                </div>
                <div class="card-body p-3">
                    @forelse($recentHeaders as $header)
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-image text-{{ $header->is_active ? 'success' : 'secondary' }}"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    Header #{{ $header->id }}
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    {{ $header->created_at->diffForHumans() }}
                                    @if($header->is_active)
                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-3">
                        <p class="text-muted">Belum ada header yang dibuat</p>
                        <a href="{{ route('adminui.about.headers.create') }}" class="btn btn-sm bg-gradient-primary">Buat Header</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Recent Contents</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">{{ count($recentContents) }}</span> konten terbaru
                    </p>
                </div>
                <div class="card-body p-3">
                    @forelse($recentContents as $content)
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-collection text-{{ $content->is_active ? 'success' : 'secondary' }}"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    {{ Str::limit($content->title, 30) }}
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    {{ $content->created_at->diffForHumans() }}
                                    @if($content->is_active)
                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-3">
                        <p class="text-muted">Belum ada konten yang dibuat</p>
                        <a href="{{ route('adminui.about.contents.create') }}" class="btn btn-sm bg-gradient-primary">Buat Konten</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Quick Actions</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                            <i class="ni ni-image text-lg text-white opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <p class="text-gradient text-dark mb-2 text-sm">Header Management</p>
                                    <a href="{{ route('adminui.about.headers') }}">
                                        <h5>Kelola Header Slideshow</h5>
                                    </a>
                                    <p class="mb-4 text-sm">Upload dan kelola gambar header untuk slideshow halaman About.</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('adminui.about.headers') }}" class="btn btn-outline-primary btn-sm mb-0">View Headers</a>
                                        <a href="{{ route('adminui.about.headers.create') }}" class="btn btn-primary btn-sm mb-0">Add Header</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                            <i class="ni ni-collection text-lg text-white opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <p class="text-gradient text-dark mb-2 text-sm">Content Management</p>
                                    <a href="{{ route('adminui.about.contents') }}">
                                        <h5>Kelola Konten About</h5>
                                    </a>
                                    <p class="mb-4 text-sm">Buat dan kelola konten artikel untuk halaman About.</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('adminui.about.contents') }}" class="btn btn-outline-primary btn-sm mb-0">View Contents</a>
                                        <a href="{{ route('adminui.about.contents.create') }}" class="btn btn-primary btn-sm mb-0">Add Content</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                            <i class="ni ni-world text-lg text-white opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <p class="text-gradient text-dark mb-2 text-sm">Frontend Preview</p>
                                    <a href="{{ route('about') }}" target="_blank">
                                        <h5>Lihat Halaman About</h5>
                                    </a>
                                    <p class="mb-4 text-sm">Preview halaman About yang dilihat pengunjung website.</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('about') }}" target="_blank" class="btn btn-outline-primary btn-sm mb-0">View Page</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                            <i class="ni ni-settings text-lg text-white opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <p class="text-gradient text-dark mb-2 text-sm">Settings</p>
                                    <a href="javascript:;">
                                        <h5>Pengaturan Lanjutan</h5>
                                    </a>
                                    <p class="mb-4 text-sm">Konfigurasi pengaturan lanjutan untuk sistem About.</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="javascript:;" class="btn btn-outline-primary btn-sm mb-0">Coming Soon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section Management -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3 bg-gradient-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-white">
                            <i class="fas fa-star text-sm me-2"></i>
                            Hero Section Management
                        </h6>
                        <button type="button" class="btn btn-outline-white btn-sm" onclick="saveHeroSection()">
                            <i class="fas fa-save text-sm me-1"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="heroSectionForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Tagline</label>
                                    <input type="text" name="tagline" id="tagline"
                                           class="form-control border px-3" 
                                           placeholder="You Always Get the Best Guidance"
                                           value="{{ $aboutSection->tagline ?? '' }}">
                                    <small class="text-muted">Main tagline for the hero section</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Hero Title</label>
                                    <input type="text" name="hero_title" id="hero_title"
                                           class="form-control border px-3" 
                                           placeholder="Welcome to JasaIbnu"
                                           value="{{ $aboutSection->hero_title ?? '' }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Hero Subtitle</label>
                                    <textarea name="hero_subtitle" id="hero_subtitle"
                                              class="form-control border px-3" 
                                              rows="3"
                                              placeholder="Your comprehensive solution for...">{{ $aboutSection->hero_subtitle ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Projects Completed</label>
                                    <input type="number" name="projects_completed" id="projects_completed"
                                           class="form-control border px-3" 
                                           placeholder="705" min="0"
                                           value="{{ $aboutSection->projects_completed ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Satisfied Customers</label>
                                    <input type="number" name="satisfied_customers" id="satisfied_customers"
                                           class="form-control border px-3" 
                                           placeholder="809" min="0"
                                           value="{{ $aboutSection->satisfied_customers ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Awards Received</label>
                                    <input type="number" name="awards_received" id="awards_received"
                                           class="form-control border px-3" 
                                           placeholder="335" min="0"
                                           value="{{ $aboutSection->awards_received ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Years Experience</label>
                                    <input type="number" name="years_experience" id="years_experience"
                                           class="form-control border px-3" 
                                           placeholder="35" min="0"
                                           value="{{ $aboutSection->years_experience ?? 0 }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Management -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3 bg-gradient-success">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-white">
                            <i class="fas fa-comments text-sm me-2"></i>
                            Client Testimonials Management
                        </h6>
                        <div>
                            <button type="button" class="btn btn-outline-white btn-sm me-2" onclick="addTestimonial()">
                                <i class="fas fa-plus text-sm me-1"></i>
                                Add Testimonial
                            </button>
                            <button type="button" class="btn btn-outline-white btn-sm" onclick="saveTestimonials()">
                                <i class="fas fa-save text-sm me-1"></i>
                                Save All
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="testimonialsForm">
                        @csrf
                        <div id="testimonials-container">
                            @forelse($testimonials as $index => $testimonial)
                            <div class="testimonial-item card border mb-3" id="testimonial-{{ $index }}">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Testimonial #{{ $index + 1 }}</h6>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeTestimonial({{ $index }})">
                                        <i class="fas fa-times text-sm me-1"></i>
                                        Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="testimonials[{{ $index }}][name]" 
                                                       class="form-control border px-3" 
                                                       placeholder="John Doe"
                                                       value="{{ $testimonial->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <input type="text" name="testimonials[{{ $index }}][role]" 
                                                       class="form-control border px-3" 
                                                       placeholder="CEO & Founder"
                                                       value="{{ $testimonial->role }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Image URL</label>
                                                <input type="url" name="testimonials[{{ $index }}][image]" 
                                                       class="form-control border px-3" 
                                                       placeholder="https://example.com/image.jpg"
                                                       value="{{ $testimonial->image }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Message</label>
                                                <textarea name="testimonials[{{ $index }}][message]" 
                                                          class="form-control border px-3" 
                                                          rows="3" 
                                                          placeholder="Outstanding service! The team delivered exactly what we needed...">{{ $testimonial->message }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="testimonial-item card border mb-3" id="testimonial-0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Testimonial #1</h6>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeTestimonial(0)" disabled>
                                        <i class="fas fa-times text-sm me-1"></i>
                                        Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="testimonials[0][name]" 
                                                       class="form-control border px-3" 
                                                       placeholder="John Doe">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <input type="text" name="testimonials[0][role]" 
                                                       class="form-control border px-3" 
                                                       placeholder="CEO & Founder">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Image URL</label>
                                                <input type="url" name="testimonials[0][image]" 
                                                       class="form-control border px-3" 
                                                       placeholder="https://example.com/image.jpg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Message</label>
                                                <textarea name="testimonials[0][message]" 
                                                          class="form-control border px-3" 
                                                          rows="3" 
                                                          placeholder="Outstanding service! The team delivered exactly what we needed..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Messages -->
    <div id="status-message" class="position-fixed" style="bottom: 20px; right: 20px; z-index: 1050; display: none;">
        <div class="alert alert-success mb-0">
            <i class="fas fa-check-circle me-2"></i>
            <span id="status-text">Saved successfully</span>
        </div>
    </div>
</div>

<script>
let testimonialIndex = {{ count($testimonials) > 0 ? count($testimonials) : 1 }};

// Auto-save functionality
let autoSaveTimeout;

// Add event listeners for auto-save
document.addEventListener('DOMContentLoaded', function() {
    const formInputs = document.querySelectorAll('#heroSectionForm input, #heroSectionForm textarea');
    formInputs.forEach(input => {
        input.addEventListener('blur', () => {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(saveHeroSection, 2000);
        });
    });
});

// Add testimonial
function addTestimonial() {
    const container = document.getElementById('testimonials-container');
    const testimonialHtml = `
        <div class="testimonial-item card border mb-3" id="testimonial-${testimonialIndex}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Testimonial #${testimonialIndex + 1}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeTestimonial(${testimonialIndex})">
                    <i class="fas fa-times text-sm me-1"></i>
                    Remove
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="testimonials[${testimonialIndex}][name]" 
                                   class="form-control border px-3" 
                                   placeholder="John Doe">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="testimonials[${testimonialIndex}][role]" 
                                   class="form-control border px-3" 
                                   placeholder="CEO & Founder">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Image URL</label>
                            <input type="url" name="testimonials[${testimonialIndex}][image]" 
                                   class="form-control border px-3" 
                                   placeholder="https://example.com/image.jpg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="testimonials[${testimonialIndex}][message]" 
                                      class="form-control border px-3" 
                                      rows="3" 
                                      placeholder="Outstanding service! The team delivered exactly what we needed..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', testimonialHtml);
    testimonialIndex++;
}

// Remove testimonial
function removeTestimonial(index) {
    const testimonialElement = document.getElementById(`testimonial-${index}`);
    const remainingTestimonials = document.querySelectorAll('.testimonial-item').length;
    
    if (remainingTestimonials > 1) {
        testimonialElement.remove();
    } else {
        alert('At least one testimonial is required.');
    }
}

// Save hero section
function saveHeroSection() {
    const formData = new FormData(document.getElementById('heroSectionForm'));
    
    fetch('{{ route("adminui.about.hero.update") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        showStatus(data.success ? 'Hero section saved successfully!' : 'Failed to save hero section', data.success ? 'success' : 'danger');
    })
    .catch(error => {
        console.error('Error:', error);
        showStatus('Error saving hero section', 'danger');
    });
}

// Save testimonials
function saveTestimonials() {
    const testimonials = [];
    
    document.querySelectorAll('.testimonial-item').forEach((item, index) => {
        const name = item.querySelector('input[name*="[name]"]').value;
        const role = item.querySelector('input[name*="[role]"]').value;
        const image = item.querySelector('input[name*="[image]"]').value;
        const message = item.querySelector('textarea[name*="[message]"]').value;
        
        if (name && role && message) {
            testimonials.push({ name, role, message, image });
        }
    });
    
    if (testimonials.length === 0) {
        showStatus('Please fill in at least one complete testimonial', 'warning');
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    testimonials.forEach((testimonial, index) => {
        formData.append(`testimonials[${index}][name]`, testimonial.name);
        formData.append(`testimonials[${index}][role]`, testimonial.role);
        formData.append(`testimonials[${index}][message]`, testimonial.message);
        formData.append(`testimonials[${index}][image]`, testimonial.image);
    });
    
    fetch('{{ route("adminui.about.testimonials.update") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        showStatus(data.success ? 'Testimonials saved successfully!' : 'Failed to save testimonials', data.success ? 'success' : 'danger');
        if (data.success) {
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showStatus('Error saving testimonials', 'danger');
    });
}

// Show status message
function showStatus(message, type) {
    const statusElement = document.getElementById('status-message');
    const textElement = document.getElementById('status-text');
    const alertElement = statusElement.querySelector('.alert');
    
    textElement.textContent = message;
    alertElement.className = `alert alert-${type} mb-0`;
    
    statusElement.style.display = 'block';
    
    setTimeout(() => {
        statusElement.style.display = 'none';
    }, 3000);
}
</script>

@endsection