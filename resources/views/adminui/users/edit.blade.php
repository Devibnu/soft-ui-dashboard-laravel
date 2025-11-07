@extends('adminui.layouts.auth')
@section('title', 'Edit User')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 mb-4 rounded-3">
                <div class="card-header bg-transparent pb-0 px-5 pt-4">
                    <h5 class="mb-0 font-weight-bold">Edit User</h5>
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
                    <form action="{{ route('adminui.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4 align-items-stretch">
                            <div class="col-lg-8 col-md-8">
                                <div class="card h-100 shadow-sm border-0 rounded-3">
                                    <div class="card-body px-5 py-5">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                                <option value="Super Admin" {{ old('role', $user->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Staff" {{ old('role', $user->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                                            </select>
                                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3">
                                    <div class="card-body px-4 py-4">
                                        <label class="form-label">Hak Akses Menu</label>
                                        <div class="row">
                                            @foreach($menuList as $menu)
                                            <div class="col-12 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $menu }}" id="menu-{{ $loop->index }}" {{ (is_array(old('permissions', $user->permissions)) && in_array($menu, old('permissions', $user->permissions))) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="menu-{{ $loop->index }}">{{ $menu }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @if(strtolower(old('role', $user->role)) == 'super admin')
                                            <div class="text-muted small mt-2">Super Admin akses semua menu.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <a href="{{ route('adminui.users.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
