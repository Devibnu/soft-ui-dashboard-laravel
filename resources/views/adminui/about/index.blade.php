@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
            <span class="text-sm"><strong>Success!</strong> {{ session('success') }}</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
            <span class="text-sm"><strong>Error!</strong> {{ session('error') }}</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
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

    <!-- Main Content -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="text-primary mb-0">
                        <i class="ni ni-chart-bar-32 me-2"></i>Hero Section - Statistik Perusahaan
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Notification Area -->
                    <div id="notification-area"></div>
                    
                    <form id="heroForm" method="POST" action="{{ route('adminui.about.hero') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="debug_form" value="hero">
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

                                <!-- Hero Background Image -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Hero Background Image</label>
                                            <input class="form-control" type="file" name="hero_image" id="heroImageInput" accept="image/*">
                                            <small class="form-text text-muted">Upload gambar background untuk hero section (JPG, PNG, GIF)</small>
                                            
                                            <!-- Preview Area -->
                                            <div class="mt-2">
                                                <img src="@if($heroSection && $heroSection->hero_image){{ asset('storage/' . $heroSection->hero_image) }}@endif" 
                                                     alt="Preview" class="img-thumbnail" id="heroImagePreview" 
                                                     style="max-height: 150px; @if(!$heroSection || !$heroSection->hero_image)display: none;@endif">
                                                @if($heroSection && $heroSection->hero_image)
                                                    <p class="small text-muted mt-1" id="currentImageText">Gambar saat ini: {{ $heroSection->hero_image }}</p>
                                                @endif
                                            </div>
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
                                        <button type="submit" class="btn bg-gradient-primary">
                                            <i class="ni ni-send me-2"></i>Save Hero Section
                                        </button>
                                    </div>
                                </div>
                            </form>


                            
                            <!-- Current Hero Section Data -->
                            @if($heroSection)
                            <hr class="my-4">
                            <h6 class="text-secondary mb-3">Data Hero Section Saat Ini</h6>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Tagline:</strong> {{ $heroSection->tagline }}</p>
                                            <p><strong>Projects Completed:</strong> {{ number_format($heroSection->projects_completed) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Satisfied Customers:</strong> {{ number_format($heroSection->satisfied_customers) }}</p>
                                            <p><strong>Awards Received:</strong> {{ number_format($heroSection->awards_received) }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Years Experience:</strong> {{ number_format($heroSection->years_experience) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Last Updated:</strong> {{ $heroSection->updated_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <hr class="my-4">
                            <div class="alert alert-info">
                                <i class="ni ni-bell-55 me-2"></i>Belum ada data Hero Section. Silakan isi form di atas untuk menambahkan data.
                            </div>
                            @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.debug-section {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    margin: 1rem 0;
}

.content-card, .testimonial-card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
    transition: box-shadow 0.15s ease-in-out;
}

.content-card:hover, .testimonial-card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>
@endpush

@push('js')
<script>
// Page initialization
document.addEventListener('DOMContentLoaded', function() {
    console.log('About page JavaScript loaded');
    console.log('Testing deleteContent function exists:', typeof deleteContent);
    console.log('Testing deleteTestimonial function exists:', typeof deleteTestimonial);
});

// Notification function
function showNotification(type, message) {
    console.log('Showing notification:', type, message);
}

// Test function
function testDelete() {
    console.log('Test function called!');
    alert('Test function works!');
}

// Global functions for delete operations
function deleteContent(id) {
    console.log('Delete content called with ID:', id);
    if (confirm('Are you sure you want to delete this content?')) {
        // Create a form with proper CSRF token
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/adminui/about/content/${id}`;
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Add method override for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        // Submit form
        document.body.appendChild(form);
        form.submit();
    }
}

function deleteTestimonial(id) {
    console.log('Delete testimonial called with ID:', id);
    if (confirm('Are you sure you want to delete this testimonial?')) {
        // Create a form with proper CSRF token
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/adminui/about/testimonial/${id}`;
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Add method override for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        // Submit form
        document.body.appendChild(form);
        form.submit();
    }
}

// Delete Content Function
function deleteContent(id) {
    Swal.fire({
        title: 'Hapus Content?',
        text: "Content ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/adminui/about/content/${id}`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Delete Testimonial Function
function deleteTestimonial(id) {
    Swal.fire({
        title: 'Hapus Testimonial?',
        text: "Testimonial ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/adminui/about/testimonial/${id}`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Handle hash from URL (when coming from sidebar submenu)
document.addEventListener('DOMContentLoaded', function() {
    var hash = window.location.hash;
    if (hash) {
        var tabId = hash.substring(1); // Remove the #
        var tabElement = document.getElementById(tabId);
        if (tabElement) {
            // Use Bootstrap Tab API to show the tab
            var tab = new bootstrap.Tab(tabElement);
            tab.show();
            // Scroll to top
            setTimeout(function() {
                window.scrollTo(0, 0);
            }, 100);
        }
    }
});

// Preview Hero Image on file select
document.getElementById('heroImageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('heroImagePreview');
    const currentText = document.getElementById('currentImageText');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (currentText) {
                currentText.textContent = 'Preview: ' + file.name;
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush

@endsection