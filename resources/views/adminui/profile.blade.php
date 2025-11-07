@extends('adminui.layouts.auth')

@section('title', 'Profile')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-8 mb-4">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-transparent pb-0">
                    <h5 class="mb-0 font-weight-bold">Edit Profile</h5>
                </div>
                <div class="card-body px-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                            <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                            <span class="alert-text">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                            <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                            <span class="alert-text">
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('adminui.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="photo" class="form-label">Profile Photo</label>
                                <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6" id="imagePreview" style="display: {{ old('photo') || $user->photo ? 'block' : 'none' }};">
                                <label class="form-label">Preview Photo</label>
                                <div class="mb-2">
                                    <img id="previewImg" src="{{ $user->photo ? asset($user->photo) : '' }}" alt="Preview" class="img-fluid border-radius-lg shadow" style="max-height: 120px;">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow border-0">
                <div class="card-header bg-transparent pb-0">
                    <h5 class="mb-0 font-weight-bold">Change Password</h5>
                </div>
                <div class="card-body px-4">
                    <form action="{{ route('adminui.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password" required>
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">New Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required>
                                <small class="text-muted">Minimal 8 karakter</small>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-dark px-4 py-2">
                                <i class="fas fa-key me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4 mb-4">
            <div class="card card-profile shadow border-0 text-center">
                <div class="card-body p-4">
                    <div class="mb-3">
                        @if($user->photo)
                            <img src="{{ asset($user->photo) }}" class="rounded-circle img-fluid border border-3 border-white shadow" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/team-2.jpg') }}" class="rounded-circle img-fluid border border-3 border-white shadow" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <div class="mb-2 text-secondary small">
                        <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                    </div>
                    @if($user->phone)
                        <div class="mb-2 text-secondary small">
                            <i class="fas fa-phone me-2"></i>{{ $user->phone }}
                        </div>
                    @endif
                    @if($user->location)
                        <div class="mb-2 text-secondary small">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $user->location }}
                        </div>
                    @endif
                    @if($user->about_me)
                        <div class="mt-3">
                            <p class="text-sm text-muted">{{ $user->about_me }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('photo').addEventListener('change', function(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection