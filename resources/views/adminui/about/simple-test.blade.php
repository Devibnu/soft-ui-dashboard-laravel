<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Management Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>About Management - Simple Test</h2>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Hero Section</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/test-hero-submit">
                        <div class="mb-3">
                            <label class="form-label">Tagline</label>
                            <input type="text" class="form-control" name="tagline" 
                                   value="{{ $heroSection->tagline ?? '' }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Projects Completed</label>
                                <input type="number" class="form-control" name="projects_completed" 
                                       value="{{ $heroSection->projects_completed ?? 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Satisfied Customers</label>
                                <input type="number" class="form-control" name="satisfied_customers" 
                                       value="{{ $heroSection->satisfied_customers ?? 0 }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Awards Received</label>
                                <input type="number" class="form-control" name="awards_received" 
                                       value="{{ $heroSection->awards_received ?? 0 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Years Experience</label>
                                <input type="number" class="form-control" name="years_experience" 
                                       value="{{ $heroSection->years_experience ?? 0 }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Hero Section</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Current Data</h5>
                </div>
                <div class="card-body">
                    @if($heroSection)
                        <p><strong>Tagline:</strong> {{ $heroSection->tagline }}</p>
                        <p><strong>Projects:</strong> {{ $heroSection->projects_completed }}</p>
                        <p><strong>Customers:</strong> {{ $heroSection->satisfied_customers }}</p>
                        <p><strong>Awards:</strong> {{ $heroSection->awards_received }}</p>
                        <p><strong>Years:</strong> {{ $heroSection->years_experience }}</p>
                        <p><strong>Last Updated:</strong> {{ $heroSection->updated_at }}</p>
                    @else
                        <p>No hero section data found.</p>
                    @endif
                </div>
            </div>
            
            <div class="mt-3">
                <a href="{{ route('adminui.about.index') }}" class="btn btn-secondary">Back to Main Admin</a>
                <a href="/about" target="_blank" class="btn btn-info">View Frontend</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>