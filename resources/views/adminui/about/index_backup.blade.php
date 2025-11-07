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
                            <h5 class="mb-1">About Section Management</h5>
                            <p class="mb-0 font-weight-bold text-sm">Manage all about page content and settings</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section Form -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>About Section Settings</h6>
                    <p class="text-sm mb-0">Update your about page content and information</p>
                </div>
                <div class="card-body">
                    <form id="aboutSectionForm" method="POST" action="{{ route('adminui.about.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary">Contact Information</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input class="form-control" type="email" id="email" name="email" 
                                           value="{{ $aboutSection->email ?? '' }}" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="phone">Phone</label>
                                    <input class="form-control" type="text" id="phone" name="phone" 
                                           value="{{ $aboutSection->phone ?? '' }}" placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="address">Address</label>
                                    <input class="form-control" type="text" id="address" name="address" 
                                           value="{{ $aboutSection->address ?? '' }}" placeholder="Enter address">
                                </div>
                            </div>
                        </div>

                        <!-- Hero Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary">Hero Section</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="hero_title">Hero Title</label>
                                    <input class="form-control" type="text" id="hero_title" name="hero_title" 
                                           value="{{ $aboutSection->hero_title ?? '' }}" placeholder="Enter hero title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="tagline">Tagline</label>
                                    <input class="form-control" type="text" id="tagline" name="tagline" 
                                           value="{{ $aboutSection->tagline ?? '' }}" placeholder="Enter tagline">
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary">Statistics Counter</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="projects_completed">Projects Completed</label>
                                    <input class="form-control" type="number" id="projects_completed" name="projects_completed" 
                                           value="{{ $aboutSection->projects_completed ?? 705 }}" placeholder="705">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="satisfied_customers">Satisfied Customers</label>
                                    <input class="form-control" type="number" id="satisfied_customers" name="satisfied_customers" 
                                           value="{{ $aboutSection->satisfied_customers ?? 809 }}" placeholder="809">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="awards_received">Awards Received</label>
                                    <input class="form-control" type="number" id="awards_received" name="awards_received" 
                                           value="{{ $aboutSection->awards_received ?? 335 }}" placeholder="335">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="years_experience">Years of Experience</label>
                                    <input class="form-control" type="number" id="years_experience" name="years_experience" 
                                           value="{{ $aboutSection->years_experience ?? 35 }}" placeholder="35">
                                </div>
                            </div>
                        </div>

                        <!-- Success Story Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary">Success Story Section</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="success_title">Success Story Title</label>
                                    <input class="form-control" type="text" id="success_title" name="success_title" 
                                           value="{{ $aboutSection->success_title ?? '' }}" 
                                           placeholder="Read Our Success Story for Inspiration">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="success_description">Success Story Description</label>
                                    <textarea class="form-control" id="success_description" name="success_description" rows="4" 
                                              placeholder="Enter success story description">{{ $aboutSection->success_description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Welcome Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary">Welcome Section</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="welcome_title">Welcome Title</label>
                                    <input class="form-control" type="text" id="welcome_title" name="welcome_title" 
                                           value="{{ $aboutSection->welcome_title ?? '' }}" 
                                           placeholder="Welcome to JasaIbnu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="welcome_paragraph1">Welcome Paragraph 1</label>
                                    <textarea class="form-control" id="welcome_paragraph1" name="welcome_paragraph1" rows="3" 
                                              placeholder="Enter first paragraph">{{ $aboutSection->welcome_paragraph1 ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="welcome_paragraph2">Welcome Paragraph 2</label>
                                    <textarea class="form-control" id="welcome_paragraph2" name="welcome_paragraph2" rows="3" 
                                              placeholder="Enter second paragraph">{{ $aboutSection->welcome_paragraph2 ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="welcome_paragraph3">Welcome Paragraph 3</label>
                                    <textarea class="form-control" id="welcome_paragraph3" name="welcome_paragraph3" rows="3" 
                                              placeholder="Enter third paragraph">{{ $aboutSection->welcome_paragraph3 ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Consultation Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary">Consultation Section</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="consultation_title">Consultation Title</label>
                                    <input class="form-control" type="text" id="consultation_title" name="consultation_title" 
                                           value="{{ $aboutSection->consultation_title ?? '' }}" 
                                           placeholder="We Are the Best Consulting Agency">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="video_url">Video URL</label>
                                    <input class="form-control" type="url" id="video_url" name="video_url" 
                                           value="{{ $aboutSection->video_url ?? '' }}" 
                                           placeholder="https://vimeo.com/45830194">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="consultation_paragraph1">Consultation Paragraph 1</label>
                                    <textarea class="form-control" id="consultation_paragraph1" name="consultation_paragraph1" rows="4" 
                                              placeholder="Enter first consultation paragraph">{{ $aboutSection->consultation_paragraph1 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="consultation_paragraph2">Consultation Paragraph 2</label>
                                    <textarea class="form-control" id="consultation_paragraph2" name="consultation_paragraph2" rows="4" 
                                              placeholder="Enter second consultation paragraph">{{ $aboutSection->consultation_paragraph2 ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Guidance Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary">Guidance Section</h6>
                                <hr class="horizontal gray-light">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="guidance_title">Guidance Title</label>
                                    <input class="form-control" type="text" id="guidance_title" name="guidance_title" 
                                           value="{{ $aboutSection->guidance_title ?? '' }}" 
                                           placeholder="You Always Get the Best Guidance">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Update About Section
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Testimonials Management</h6>
                        <p class="text-sm mb-0">Manage customer testimonials for the about page</p>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" onclick="addTestimonialForm()">
                        <i class="fas fa-plus me-1"></i>Add Testimonial
                    </button>
                </div>
                <div class="card-body">
                    <div id="testimonialsContainer">
                        @forelse($testimonials as $index => $testimonial)
                        <div class="testimonial-item mb-4 p-3 border rounded" id="testimonial-{{ $index }}">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Testimonial {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeTestimonial({{ $index }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" class="form-control" name="testimonials[{{ $index }}][name]" 
                                               value="{{ $testimonial->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Role</label>
                                        <input type="text" class="form-control" name="testimonials[{{ $index }}][role]" 
                                               value="{{ $testimonial->role }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image URL (optional)</label>
                                        <input type="text" class="form-control" name="testimonials[{{ $index }}][image]" 
                                               value="{{ $testimonial->image }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Message</label>
                                        <textarea class="form-control" name="testimonials[{{ $index }}][message]" rows="3" required>{{ $testimonial->message }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <p class="text-muted">No testimonials found. Click "Add Testimonial" to create one.</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <div class="text-end mt-3">
                        <button type="button" class="btn btn-success" onclick="saveTestimonials()">
                            <i class="fas fa-save me-2"></i>Save Testimonials
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let testimonialIndex = {{ $testimonials->count() }};

function addTestimonialForm() {
    const container = document.getElementById('testimonialsContainer');
    const testimonialHTML = `
        <div class="testimonial-item mb-4 p-3 border rounded" id="testimonial-${testimonialIndex}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Testimonial ${testimonialIndex + 1}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeTestimonial(${testimonialIndex})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" class="form-control" name="testimonials[${testimonialIndex}][name]" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Role</label>
                        <input type="text" class="form-control" name="testimonials[${testimonialIndex}][role]" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Image URL (optional)</label>
                        <input type="text" class="form-control" name="testimonials[${testimonialIndex}][image]">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-control-label">Message</label>
                        <textarea class="form-control" name="testimonials[${testimonialIndex}][message]" rows="3" required></textarea>
                    </div>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', testimonialHTML);
    testimonialIndex++;
}

function removeTestimonial(index) {
    const testimonial = document.getElementById(`testimonial-${index}`);
    if (testimonial) {
        testimonial.remove();
    }
}

function saveTestimonials() {
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Collect all testimonial data
    const testimonials = [];
    document.querySelectorAll('.testimonial-item').forEach((item, index) => {
        const name = item.querySelector('input[name*="[name]"]').value;
        const role = item.querySelector('input[name*="[role]"]').value;
        const image = item.querySelector('input[name*="[image]"]').value;
        const message = item.querySelector('textarea[name*="[message]"]').value;
        
        if (name && role && message) {
            testimonials.push({ name, role, image, message });
        }
    });
    
    formData.append('testimonials', JSON.stringify(testimonials));
    
    fetch('{{ route("adminui.about.testimonials.update") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Testimonials updated successfully!');
            location.reload();
        } else {
            alert('Error updating testimonials: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating testimonials');
    });
}

// Auto-save functionality for the main form
document.getElementById('aboutSectionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('About section updated successfully!');
        } else {
            alert('Error updating about section: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating about section');
    });
});
</script>
@endpush
@endsection