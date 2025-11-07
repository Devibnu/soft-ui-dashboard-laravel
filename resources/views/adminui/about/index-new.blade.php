@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="page-header min-height-300 border-radius-xl mt-4" 
                 style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
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
                            <h5 class="mb-1">Complete About Page Management</h5>
                            <p class="mb-0 font-weight-bold text-sm">Kelola Hero Section, Konten, dan Testimoni</p>
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="{{ route('about') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="ni ni-world me-1"></i>Lihat Halaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content with Tabs -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <ul class="nav nav-tabs" id="aboutTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero-content" type="button" role="tab" aria-controls="hero-content" aria-selected="true">
                                <i class="ni ni-chart-bar-32 me-2"></i>Hero Section
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content-content" type="button" role="tab" aria-controls="content-content" aria-selected="false">
                                <i class="ni ni-collection me-2"></i>About Content
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="testimonials-tab" data-bs-toggle="tab" data-bs-target="#testimonials-content" type="button" role="tab" aria-controls="testimonials-content" aria-selected="false">
                                <i class="ni ni-chat-round me-2"></i>Client Testimonials
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Notification Area -->
                    <div id="notification-area"></div>
                    
                    <div class="tab-content" id="aboutTabsContent">
                        <!-- TAB 1: Hero Section -->
                        <div class="tab-pane fade show active" id="hero-content" role="tabpanel" aria-labelledby="hero-tab">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">
                                        <i class="ni ni-chart-bar-32 me-2"></i>Hero Section - Statistik Perusahaan
                                    </h6>
                                </div>
                            </div>

                            <form id="heroForm" method="POST">
                                @csrf
                                <!-- Tagline -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Tagline <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="tagline" 
                                                   value="{{ $heroSection->tagline ?? '' }}" 
                                                   placeholder="Professional Consulting Services" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Statistics -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Projects Completed <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="projects_completed" 
                                                   value="{{ $heroSection->projects_completed ?? 705 }}" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Satisfied Customers <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="satisfied_customers" 
                                                   value="{{ $heroSection->satisfied_customers ?? 809 }}" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Awards Received <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="awards_received" 
                                                   value="{{ $heroSection->awards_received ?? 335 }}" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Years of Experience <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="years_experience" 
                                                   value="{{ $heroSection->years_experience ?? 35 }}" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ni ni-send me-2"></i>Simpan Hero Section
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: About Content -->
                        <div class="tab-pane fade" id="content-content" role="tabpanel" aria-labelledby="content-tab">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">
                                        <i class="ni ni-collection me-2"></i>About Content Section
                                    </h6>
                                </div>
                            </div>

                            <!-- Content Form -->
                            <form id="contentForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Judul Halaman <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title" 
                                                   placeholder="Welcome to Consolution" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Judul Box Kanan <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="right_title" 
                                                   placeholder="Read Our Success Story for Inspiration" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Isi Paragraf Kiri <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="left_paragraph" rows="6" 
                                                      placeholder="Deskripsi utama tentang perusahaan..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Isi Box Kanan <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="right_paragraph" rows="6" 
                                                      placeholder="Deskripsi singkat untuk box kanan..." required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Upload Gambar Kanan (Max 2MB)</label>
                                            <input class="form-control" type="file" name="right_image" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">CTA Button Text</label>
                                            <input class="form-control" type="text" name="cta_text" 
                                                   placeholder="Contact Us">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">CTA Button Link</label>
                                            <input class="form-control" type="url" name="cta_link" 
                                                   placeholder="https://jasaibnu.id/contact">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ni ni-send me-2"></i>Simpan Content
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Existing Content List -->
                            @if($contents->count() > 0)
                            <hr class="my-4">
                            <h6 class="text-secondary mb-3">Content yang Sudah Ada</h6>
                            <div class="row">
                                @foreach($contents as $content)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body p-3">
                                            <h6>{{ $content->title }}</h6>
                                            <p class="text-sm text-muted mb-2">{{ Str::limit($content->left_paragraph, 100) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-{{ $content->is_active ? 'success' : 'secondary' }}">
                                                    {{ $content->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                        onclick="deleteContent({{ $content->id }})">
                                                    <i class="ni ni-fat-remove"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- TAB 3: Client Testimonials -->
                        <div class="tab-pane fade" id="testimonials-content" role="tabpanel" aria-labelledby="testimonials-tab">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">
                                        <i class="ni ni-chat-round me-2"></i>Client Testimonials
                                    </h6>
                                </div>
                            </div>

                            <!-- Testimonial Form -->
                            <form id="testimonialForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Judul Section <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="section_title" 
                                                   placeholder="Our Clients Say" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Subteks <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="section_subtext" rows="3" 
                                                      placeholder="Separated they live in. A small river named Duden flows..." required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Nama Klien <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" 
                                                   placeholder="John Doe" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Jabatan <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="position" 
                                                   placeholder="CEO, Company ABC" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Upload Foto (Max 2MB)</label>
                                            <input class="form-control" type="file" name="photo" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Isi Testimoni <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="message" rows="4" 
                                                      placeholder="Far far away, behind the word mountains..." required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ni ni-send me-2"></i>Simpan Testimonial
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Existing Testimonials List -->
                            @if($testimonials->count() > 0)
                            <hr class="my-4">
                            <h6 class="text-secondary mb-3">Testimonials yang Sudah Ada</h6>
                            <div class="row">
                                @foreach($testimonials as $testimonial)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center mb-2">
                                                @if($testimonial->photo_path)
                                                    <img src="{{ asset('storage/' . $testimonial->photo_path) }}" 
                                                         class="avatar avatar-sm me-2" alt="{{ $testimonial->name }}">
                                                @else
                                                    <div class="avatar avatar-sm me-2 bg-gradient-secondary">
                                                        {{ substr($testimonial->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $testimonial->name }}</h6>
                                                    <small class="text-muted">{{ $testimonial->position }}</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-2">{{ Str::limit($testimonial->message, 80) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-{{ $testimonial->is_active ? 'success' : 'secondary' }}">
                                                    {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                        onclick="deleteTestimonial({{ $testimonial->id }})">
                                                    <i class="ni ni-fat-remove"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Form Handler
    document.getElementById('heroForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm(this, '{{ route('adminui.about.hero') }}', 'Hero section updated successfully!');
    });

    // Content Form Handler
    document.getElementById('contentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm(this, '{{ route('adminui.about.content') }}', 'Content saved successfully!');
    });

    // Testimonial Form Handler
    document.getElementById('testimonialForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm(this, '{{ route('adminui.about.testimonial') }}', 'Testimonial saved successfully!');
    });
});

function submitForm(form, url, successMessage) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="ni ni-settings-gear-65 me-2"></i>Processing...';
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', data.message || successMessage);
            if (data.redirect) {
                setTimeout(() => location.reload(), 1500);
            }
            form.reset();
        } else {
            let errorMessage = 'An error occurred.';
            if (data.errors) {
                errorMessage = Object.values(data.errors).flat().join('<br>');
            } else if (data.message) {
                errorMessage = data.message;
            }
            showNotification('danger', errorMessage);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('danger', 'Network error. Please try again.');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

function showNotification(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <span class="alert-icon">
                <i class="ni ni-${type === 'success' ? 'check-bold' : 'fat-remove'}"></i>
            </span>
            <span class="alert-text">${message}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    const notificationArea = document.getElementById('notification-area');
    notificationArea.innerHTML = alertHtml;
    
    setTimeout(() => {
        const alert = notificationArea.querySelector('.alert');
        if (alert) alert.remove();
    }, 5000);
}

function deleteContent(id) {
    if (confirm('Are you sure you want to delete this content?')) {
        fetch(`{{ route('adminui.about.content.delete', '') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('success', data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification('danger', data.message || 'Failed to delete content.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('danger', 'Network error. Please try again.');
        });
    }
}

function deleteTestimonial(id) {
    if (confirm('Are you sure you want to delete this testimonial?')) {
        fetch(`{{ route('adminui.about.testimonial.delete', '') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('success', data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification('danger', data.message || 'Failed to delete testimonial.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('danger', 'Network error. Please try again.');
        });
    }
}
</script>
@endpush
@endsection