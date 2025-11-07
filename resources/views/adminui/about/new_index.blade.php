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
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <ul class="nav nav-tabs" id="aboutTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button" role="tab" aria-controls="hero" aria-selected="true">
                                <i class="ni ni-chart-bar-32 me-2"></i>Hero Section
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content" type="button" role="tab" aria-controls="content" aria-selected="false">
                                <i class="ni ni-collection me-2"></i>About Content
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="testimonials-tab" data-bs-toggle="tab" data-bs-target="#testimonials" type="button" role="tab" aria-controls="testimonials" aria-selected="false">
                                <i class="ni ni-chat-round me-2"></i>Client Testimonials
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="aboutTabsContent">
                        <!-- Hero Section Tab -->
                        <div class="tab-pane fade show active" id="hero" role="tabpanel" aria-labelledby="hero-tab">
                            @include('adminui.about.hero.form')
                        </div>
                        
                        <!-- About Content Tab -->
                        <div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="content-tab">
                            @include('adminui.about.content.form')
                        </div>
                        
                        <!-- Testimonials Tab -->
                        <div class="tab-pane fade" id="testimonials" role="tabpanel" aria-labelledby="testimonials-tab">
                            @include('adminui.about.testimonials.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
// Initialize Bootstrap tabs
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all CKEditor instances
    initializeCKEditors();
    
    // Handle tab change events
    document.querySelectorAll('#aboutTabs button').forEach(button => {
        button.addEventListener('click', function (event) {
            // Reinitialize CKEditor when switching tabs
            setTimeout(function() {
                initializeCKEditors();
            }, 100);
        });
    });
});

function initializeCKEditors() {
    // Destroy existing instances
    if (window.leftParagraphEditor) {
        window.leftParagraphEditor.destroy();
    }
    if (window.rightParagraphEditor) {
        window.rightParagraphEditor.destroy();
    }
    
    // Initialize for content tab
    if (document.querySelector('#left_paragraph')) {
        ClassicEditor
            .create(document.querySelector('#left_paragraph'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'bulletedList', 'numberedList', '|',
                        'imageUpload', 'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ]
                }
            })
            .then(editor => {
                window.leftParagraphEditor = editor;
            })
            .catch(error => {
                console.error('Error initializing left paragraph editor:', error);
            });
    }
    
    if (document.querySelector('#right_paragraph')) {
        ClassicEditor
            .create(document.querySelector('#right_paragraph'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'bulletedList', 'numberedList', '|',
                        'imageUpload', 'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ]
                }
            })
            .then(editor => {
                window.rightParagraphEditor = editor;
            })
            .catch(error => {
                console.error('Error initializing right paragraph editor:', error);
            });
    }
}

// Success/Error notification function
function showNotification(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-${type === 'success' ? 'check-bold' : 'fat-remove'}"></i></span>
            <span class="alert-text">${message}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    // Find the active tab and prepend notification
    const activeTab = document.querySelector('.tab-pane.active');
    if (activeTab) {
        activeTab.insertAdjacentHTML('afterbegin', alertHtml);
        
        // Auto-hide after 5 seconds
        setTimeout(function() {
            const alert = activeTab.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }
}
</script>
@endpush
@endsection