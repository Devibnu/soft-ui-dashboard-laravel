# Profile Page Implementation

## Overview
Halaman profile lengkap dengan fitur edit profile dan ubah password menggunakan template Soft UI Dashboard.

## URL
- **Profile Page**: `http://jasaibnu.id/adminui/profile`
- **Update Profile**: `PUT /adminui/profile`
- **Update Password**: `PUT /adminui/profile/password`

## Features Implemented

### 1. Edit Profile
- **Name**: Input untuk mengubah nama user
- **Email**: Input untuk mengubah email (dengan validasi unique)
- **Photo Upload**: Upload foto profile dengan preview
- **Photo Preview**: Preview foto sebelum dan sesudah upload
- **Current Photo Display**: Menampilkan foto profile yang sudah ada

### 2. Change Password
- **Current Password**: Verifikasi password lama
- **New Password**: Input password baru (minimal 8 karakter)
- **Confirm Password**: Konfirmasi password baru

### 3. Profile Card (Sidebar)
- Menampilkan foto profile user
- Menampilkan informasi: Name, Email, Phone (jika ada), Location (jika ada)
- Menampilkan About Me (jika ada)

## Files Created/Modified

### 1. Migration
**File**: `database/migrations/2025_10_30_030534_add_photo_to_users_table.php`
- Menambahkan kolom `photo` (string, nullable) ke tabel `users`
- Status: ✅ Migrated

### 2. Model
**File**: `app/Models/User.php`
- Menambahkan `'photo'` ke dalam `$fillable` array
- Sekarang: `['name', 'email', 'password', 'photo', 'phone', 'location', 'about_me']`

### 3. Controller
**File**: `app/Http/Controllers/AdminUI/ProfileController.php`

#### Methods:
1. **index()**
   - Menampilkan halaman profile
   - Mengirim data user yang sedang login

2. **update(Request $request)**
   - Validasi: name (required, max:255), email (required, unique kecuali user sendiri), photo (nullable, image, max:2MB)
   - Upload foto ke `public/uploads/profile/`
   - Hapus foto lama jika upload foto baru
   - Update data user
   - Return: redirect dengan success message

3. **updatePassword(Request $request)**
   - Validasi: current_password (required), password (required, confirmed, min:8)
   - Verifikasi password lama dengan `Hash::check()`
   - Update password dengan `Hash::make()`
   - Return: redirect dengan success message

### 4. Routes
**File**: `routes/web.php`
```php
Route::get('/adminui/profile', [ProfileController::class, 'index'])->name('adminui.profile');
Route::put('/adminui/profile', [ProfileController::class, 'update'])->name('adminui.profile.update');
Route::put('/adminui/profile/password', [ProfileController::class, 'updatePassword'])->name('adminui.profile.password');
```

### 5. View
**File**: `resources/views/adminui/profile.blade.php`

#### Structure:
- **Layout**: 2 kolom (8-4)
- **Left Column**:
  - Card "Edit Profile" dengan form update profile
  - Card "Change Password" dengan form ubah password
- **Right Column**:
  - Card profile dengan foto dan informasi user

#### Features:
- Alert success/error dengan Bootstrap alerts
- Validation errors dengan `@error` directive
- Image preview dengan JavaScript FileReader
- Inline script (bukan `@section('scripts')`)
- Soft UI Dashboard styling

### 6. Upload Directory
**Directory**: `public/uploads/profile/`
- Status: ✅ Created
- Permission: Default (755)

## Validation Rules

### Update Profile
```php
'name' => 'required|string|max:255',
'email' => 'required|email|unique:users,email,' . $user->id,
'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
```

### Update Password
```php
'current_password' => 'required',
'password' => ['required', 'string', Password::min(8), 'confirmed']
```

## UI Components

### Success Alert (Bootstrap)
```html
<div class="alert alert-success alert-dismissible fade show text-white">
    <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
    <span class="alert-text">{{ session('success') }}</span>
</div>
```

### Error Alert (Bootstrap)
```html
<div class="alert alert-danger alert-dismissible fade show text-white">
    <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
    <span class="alert-text">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </span>
</div>
```

### Image Preview JavaScript
```javascript
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
    }
});
```

## Testing Checklist

### Update Profile
- ✅ Load halaman `/adminui/profile`
- ⏳ Display data user yang sedang login
- ⏳ Update nama user
- ⏳ Update email user
- ⏳ Upload foto baru (dengan preview)
- ⏳ Hapus foto lama saat upload baru
- ⏳ Validasi email unique
- ⏳ Validasi ukuran file max 2MB
- ⏳ Success message setelah update

### Change Password
- ⏳ Verifikasi password lama
- ⏳ Update password baru
- ⏳ Validasi password minimal 8 karakter
- ⏳ Validasi password confirmation
- ⏳ Error jika password lama salah
- ⏳ Success message setelah update

### UI/UX
- ⏳ Profile card menampilkan foto user
- ⏳ Profile card menampilkan informasi user
- ⏳ Image preview langsung muncul saat pilih file
- ⏳ Alert success/error muncul dengan benar
- ⏳ Responsive design (mobile & desktop)

## Error Messages (Indonesian)

### Validation Messages
```php
'name.required' => 'Nama wajib diisi.',
'name.max' => 'Nama maksimal 255 karakter.',
'email.required' => 'Email wajib diisi.',
'email.email' => 'Format email tidak valid.',
'email.unique' => 'Email sudah digunakan.',
'photo.image' => 'File harus berupa gambar.',
'photo.mimes' => 'Format gambar harus: jpeg, png, jpg, gif.',
'photo.max' => 'Ukuran gambar maksimal 2MB.',
'current_password.required' => 'Password lama wajib diisi.',
'password.required' => 'Password baru wajib diisi.',
'password.min' => 'Password minimal 8 karakter.',
'password.confirmed' => 'Konfirmasi password tidak cocok.'
```

### Success Messages
```php
'success' => 'Profile berhasil diupdate!'
'success' => 'Password berhasil diubah!'
```

### Error Messages
```php
'error' => 'Password lama tidak sesuai.'
```

## Security Features

1. **Password Hashing**: Menggunakan `Hash::make()` dan `Hash::check()`
2. **Email Uniqueness**: Validasi email unique kecuali untuk user sendiri
3. **File Validation**: Validasi tipe dan ukuran file upload
4. **CSRF Protection**: Menggunakan `@csrf` token
5. **Method Spoofing**: Menggunakan `@method('PUT')` untuk update
6. **Authentication**: Route protected dengan middleware 'auth'

## Database Changes

### users table
```sql
ALTER TABLE users ADD COLUMN photo VARCHAR(255) NULL AFTER email;
```

## Next Steps

1. Test semua fitur profile management
2. Pastikan upload foto berfungsi dengan baik
3. Test validasi untuk semua input
4. Verifikasi delete foto lama saat upload baru
5. Test responsive design di berbagai device

## Notes

- Foto disimpan di: `public/uploads/profile/`
- Path foto di database: `uploads/profile/nama_file.ext`
- Display foto: `asset($user->photo)`
- Fallback foto jika kosong: `assets/img/team-2.jpg`
- Semua JavaScript harus inline (tidak menggunakan `@section('scripts')`)
- Layout: `adminui.layouts.auth`
