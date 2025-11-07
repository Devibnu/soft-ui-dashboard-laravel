<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit About Page - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .admin-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 2rem 0;
        }
        
        .form-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .section-title {
            color: #333;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #007bff;
            display: inline-block;
        }
        
        .auto-save-indicator {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 10px 20px;
            border-radius: 25px;
            color: white;
            font-weight: 500;
            display: none;
            transition: all 0.3s ease;
        }
        
        .auto-save-indicator.saving {
            background: #ffc107;
            display: block;
        }
        
        .auto-save-indicator.saved {
            background: #28a745;
            display: block;
        }
        
        .auto-save-indicator.error {
            background: #dc3545;
            display: block;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
        }
        
        .preview-btn {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 20px;
        }
        
        .preview-btn:hover {
            background: linear-gradient(135deg, #1e7e34, #155724);
            color: white;
        }
        
        .ck-editor__editable {
            min-height: 300px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .stat-input-group {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .stat-input-group:focus-within {
            border-color: #007bff;
            background: white;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .stat-input {
            border: none;
            background: transparent;
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
        }
        
        .stat-input:focus {
            border: none;
            outline: none;
            box-shadow: none;
        }
    </style>
</head>
<body style="background: #f8f9fa;">
    
    <!-- Auto-save Indicator -->
    <div id="autoSaveIndicator" class="auto-save-indicator">
        <i class="fas fa-save"></i> <span id="saveMessage">Auto-saving...</span>
    </div>

    <!-- Header -->
    <header class="admin-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-0">
                        <i class="fas fa-edit"></i> Edit About Page
                    </h1>
                    <p class="mb-0 opacity-75">Manage your website's about page content</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('about') }}" target="_blank" class="btn preview-btn">
                        <i class="fas fa-eye"></i> Preview Page
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container my-5">
        <form id="aboutForm">
            @csrf
            
            <!-- Hero Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-star"></i> Hero Section
                </h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tagline" class="form-label">Tagline</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="tagline" 
                                   name="tagline" 
                                   value="{{ $aboutSection->tagline ?? '' }}"
                                   placeholder="You Always Get the Best Guidance">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hero_title" class="form-label">Hero Title</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="hero_title" 
                                   name="hero_title" 
                                   value="{{ $aboutSection->hero_title ?? '' }}"
                                   placeholder="Our Journey Towards Excellence">
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="hero_subtitle" class="form-label">Hero Subtitle (Rich Text)</label>
                    <textarea id="hero_subtitle" name="hero_subtitle" class="form-control">{{ $aboutSection->hero_subtitle ?? '' }}</textarea>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-chart-bar"></i> Statistics
                </h3>
                
                <div class="stats-grid">
                    <div class="stat-input-group">
                        <div class="stat-label">Projects Completed</div>
                        <input type="number" 
                               class="form-control stat-input" 
                               name="projects_completed" 
                               value="{{ $aboutSection->projects_completed ?? 705 }}"
                               min="0">
                    </div>
                    
                    <div class="stat-input-group">
                        <div class="stat-label">Satisfied Customers</div>
                        <input type="number" 
                               class="form-control stat-input" 
                               name="satisfied_customers" 
                               value="{{ $aboutSection->satisfied_customers ?? 809 }}"
                               min="0">
                    </div>
                    
                    <div class="stat-input-group">
                        <div class="stat-label">Awards Received</div>
                        <input type="number" 
                               class="form-control stat-input" 
                               name="awards_received" 
                               value="{{ $aboutSection->awards_received ?? 335 }}"
                               min="0">
                    </div>
                    
                    <div class="stat-input-group">
                        <div class="stat-label">Years Experience</div>
                        <input type="number" 
                               class="form-control stat-input" 
                               name="years_experience" 
                               value="{{ $aboutSection->years_experience ?? 35 }}"
                               min="0">
                    </div>
                </div>
            </div>

            <!-- Testimonials Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-comments"></i> Testimonials Management
                </h3>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Current testimonials:</strong> To manage testimonials, you can add database seeder or create a separate management interface.
                </div>
                
                @if($testimonials && count($testimonials) > 0)
                <div class="row">
                    @foreach($testimonials as $testimonial)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">{{ $testimonial->name }}</h6>
                                <p class="text-muted small">{{ $testimonial->role }}</p>
                                <p class="card-text small">"{{ Str::limit($testimonial->message, 100) }}"</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Save Button -->
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-lg" onclick="manualSave()">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- CKEditor 5 Full Build CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    
    <script>
        let editor;
        let timeout;
        let isEditorReady = false;

        // Initialize CKEditor with full configuration
        ClassicEditor
            .create(document.querySelector('#hero_subtitle'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
                        'numberedList', 'bulletedList', '|',
                        'outdent', 'indent', '|',
                        'link', 'imageUpload', 'insertTable', 'blockQuote', '|',
                        'undo', 'redo', '|',
                        'sourceEditing'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
                fontSize: {
                    options: [ 9, 11, 13, 'default', 17, 19, 21 ]
                },
                fontColor: {
                    colors: [
                        { color: 'hsl(0, 0%, 0%)', label: 'Black' },
                        { color: 'hsl(0, 0%, 30%)', label: 'Dim grey' },
                        { color: 'hsl(0, 0%, 60%)', label: 'Grey' },
                        { color: 'hsl(0, 0%, 90%)', label: 'Light grey' },
                        { color: 'hsl(0, 0%, 100%)', label: 'White', hasBorder: true },
                        { color: 'hsl(0, 75%, 60%)', label: 'Red' },
                        { color: 'hsl(30, 75%, 60%)', label: 'Orange' },
                        { color: 'hsl(60, 75%, 60%)', label: 'Yellow' },
                        { color: 'hsl(90, 75%, 60%)', label: 'Light green' },
                        { color: 'hsl(120, 75%, 60%)', label: 'Green' },
                        { color: 'hsl(150, 75%, 60%)', label: 'Aquamarine' },
                        { color: 'hsl(180, 75%, 60%)', label: 'Turquoise' },
                        { color: 'hsl(210, 75%, 60%)', label: 'Light blue' },
                        { color: 'hsl(240, 75%, 60%)', label: 'Blue' },
                        { color: 'hsl(270, 75%, 60%)', label: 'Purple' }
                    ]
                },
                fontBackgroundColor: {
                    colors: [
                        { color: 'hsl(0, 75%, 60%)', label: 'Red' },
                        { color: 'hsl(30, 75%, 60%)', label: 'Orange' },
                        { color: 'hsl(60, 75%, 60%)', label: 'Yellow' },
                        { color: 'hsl(90, 75%, 60%)', label: 'Light green' },
                        { color: 'hsl(120, 75%, 60%)', label: 'Green' },
                        { color: 'hsl(150, 75%, 60%)', label: 'Aquamarine' },
                        { color: 'hsl(180, 75%, 60%)', label: 'Turquoise' },
                        { color: 'hsl(210, 75%, 60%)', label: 'Light blue' },
                        { color: 'hsl(240, 75%, 60%)', label: 'Blue' },
                        { color: 'hsl(270, 75%, 60%)', label: 'Purple' }
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                simpleUpload: {
                    uploadUrl: '{{ route("admin.about.upload") }}',
                    withCredentials: true,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            })
            .then(newEditor => {
                editor = newEditor;
                isEditorReady = true;

                // Listen to content changes in CKEditor
                editor.model.document.on('change:data', () => {
                    autoSave();
                });

                // Listen to blur event on CKEditor
                editor.ui.focusTracker.on('change:isFocused', (evt, name, isFocused) => {
                    if (!isFocused) {
                        autoSave();
                    }
                });
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });

        // Auto-save function
        function autoSave() {
            if (!isEditorReady) return;

            clearTimeout(timeout);
            
            // Show saving indicator
            showSaveIndicator('saving', 'Auto-saving...');
            
            timeout = setTimeout(() => {
                const formData = {
                    tagline: document.querySelector('input[name="tagline"]').value,
                    hero_title: document.querySelector('input[name="hero_title"]').value,
                    hero_subtitle: editor.getData(),
                    projects_completed: document.querySelector('input[name="projects_completed"]').value,
                    satisfied_customers: document.querySelector('input[name="satisfied_customers"]').value,
                    awards_received: document.querySelector('input[name="awards_received"]').value,
                    years_experience: document.querySelector('input[name="years_experience"]').value
                };

                fetch('{{ route("admin.about.autosave") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSaveIndicator('saved', `Auto-saved at ${data.timestamp}`);
                        console.log('Auto-saved at ' + new Date().toLocaleTimeString());
                    } else {
                        showSaveIndicator('error', 'Auto-save failed');
                        console.error('Auto-save failed:', data.message);
                    }
                })
                .catch(error => {
                    showSaveIndicator('error', 'Auto-save error');
                    console.error('Auto-save error:', error);
                });
            }, 5000); // 5 seconds delay
        }

        // Manual save function
        function manualSave() {
            if (!isEditorReady) {
                alert('Editor is not ready yet. Please wait a moment.');
                return;
            }

            showSaveIndicator('saving', 'Saving...');

            const formData = {
                tagline: document.querySelector('input[name="tagline"]').value,
                hero_title: document.querySelector('input[name="hero_title"]').value,
                hero_subtitle: editor.getData(),
                projects_completed: document.querySelector('input[name="projects_completed"]').value,
                satisfied_customers: document.querySelector('input[name="satisfied_customers"]').value,
                awards_received: document.querySelector('input[name="awards_received"]').value,
                years_experience: document.querySelector('input[name="years_experience"]').value
            };

            fetch('{{ route("admin.about.autosave") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSaveIndicator('saved', 'Changes saved successfully!');
                    setTimeout(() => {
                        hideSaveIndicator();
                    }, 3000);
                } else {
                    showSaveIndicator('error', 'Save failed: ' + data.message);
                }
            })
            .catch(error => {
                showSaveIndicator('error', 'Save error occurred');
                console.error('Save error:', error);
            });
        }

        // Show save indicator
        function showSaveIndicator(type, message) {
            const indicator = document.getElementById('autoSaveIndicator');
            const messageElement = document.getElementById('saveMessage');
            
            indicator.className = `auto-save-indicator ${type}`;
            messageElement.textContent = message;
        }

        // Hide save indicator
        function hideSaveIndicator() {
            const indicator = document.getElementById('autoSaveIndicator');
            indicator.className = 'auto-save-indicator';
        }

        // Add event listeners to all form inputs for auto-save
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"], input[type="number"]');
            
            inputs.forEach(input => {
                input.addEventListener('input', autoSave);
                input.addEventListener('blur', autoSave);
            });
        });

        // Auto-hide success indicators
        let hideTimeout;
        function autoHideIndicator() {
            clearTimeout(hideTimeout);
            hideTimeout = setTimeout(() => {
                const indicator = document.getElementById('autoSaveIndicator');
                if (indicator.classList.contains('saved')) {
                    hideSaveIndicator();
                }
            }, 3000);
        }

        // Override showSaveIndicator to include auto-hide for success
        const originalShowSaveIndicator = showSaveIndicator;
        showSaveIndicator = function(type, message) {
            originalShowSaveIndicator(type, message);
            if (type === 'saved') {
                autoHideIndicator();
            }
        };
    </script>
</body>
</html>