@extends('adminui.layouts.auth')
@section('title', 'Tambah User')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 mb-4 rounded-3">
                <div class="card-header bg-transparent pb-0 px-5 pt-4">
                    <h5 class="mb-0 font-weight-bold">Tambah User Baru</h5>
                </div>
                <div class="card-body px-5 py-5">
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
                    <form action="{{ route('adminui.users.store') }}" method="POST">
                        @csrf
                        <div class="row g-4 align-items-stretch">
                            <div class="col-lg-8 col-md-8">
                                <div class="card h-100 shadow-sm border-0 rounded-3">
                                    <div class="card-body px-5 py-5">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                            <small class="text-muted">Minimal 8 karakter</small>
                                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                                <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="Admin" {{ old('role', 'Admin') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                            </select>
                                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3">
                                    <div class="card-header bg-gradient-light pb-2 px-3">
                                        <h6 class="mb-0 font-weight-bold">Hak Akses Menu</h6>
                                    </div>
                                    <div class="card-body pt-3 pb-2 px-3">
                                        <div class="row g-3">
                                            @foreach($menuList as $menu)
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]" id="menu_{{ Str::slug($menu, '_') }}" value="{{ $menu }}" {{ is_array(old('permissions')) && in_array($menu, old('permissions', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="menu_{{ Str::slug($menu, '_') }}">{{ $menu }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <small class="text-muted d-block mt-3">Centang menu yang boleh diakses user. <strong>Super Admin</strong> otomatis akses semua menu.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn bg-gradient-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i>Simpan User
                            </button>
                            <a href="{{ route('adminui.users.index') }}" class="btn btn-link ms-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
