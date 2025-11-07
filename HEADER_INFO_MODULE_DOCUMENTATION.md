# 📋 HEADER INFO MODULE DOCUMENTATION

## 🎯 Overview
Modul **Header Info** digunakan untuk mengelola informasi yang ditampilkan di header/top bar website seperti:
- Nama Website
- Email Kontak
- Nomor Telepon
- Tombol CTA (Call To Action)

---

## 📂 Files Created

### 1. Migration
- **File**: `database/migrations/2025_11_02_142307_create_header_info_table.php`
- **Table**: `header_info`
- **Columns**:
  - `id` - Primary key
  - `nama_website` - Nama website (string)
  - `email` - Email kontak (string)
  - `telepon` - Nomor telepon (string)
  - `cta_text` - Teks tombol CTA (string)
  - `cta_link` - Link tombol CTA (string)
  - `status` - Status aktif/non-aktif (boolean, default: true)
  - `timestamps` - created_at & updated_at

### 2. Model
- **File**: `app/Models/HeaderInfo.php`
- **Features**:
  - Mass assignment protection dengan `$fillable`
  - Auto-casting untuk `status` ke boolean
  - Observer untuk memastikan hanya 1 record aktif
  - Scope `active()` untuk query data aktif

### 3. Controller
- **File**: `app/Http/Controllers/HeaderInfoController.php`
- **Methods**:
  - `index()` - Menampilkan daftar header info
  - `create()` - Form tambah header info
  - `store()` - Menyimpan header info baru
  - `edit()` - Form edit header info
  - `update()` - Update header info
  - `destroy()` - Hapus header info

### 4. Routes
- **File**: `routes/web.php`
- **Routes**: `Route::resource('header-info', HeaderInfoController::class)`
- **URL Base**: `/adminui/header-info`

### 5. Views
- `resources/views/adminui/header-info/index.blade.php` - List view
- `resources/views/adminui/header-info/create.blade.php` - Create form
- `resources/views/adminui/header-info/edit.blade.php` - Edit form

### 6. Sidebar Menu
- **File**: `resources/views/adminui/layouts/sidebar.blade.php`
- **Menu**: "Header Info" dengan icon info-circle
- **Position**: Setelah menu "Home Hero"

---

## 🔧 Admin Panel Usage

### Access Module
1. Login ke Admin Panel
2. Navigate ke menu **Header Info** di sidebar
3. URL: `http://jasaibnu.id/adminui/header-info`

### Create New Header Info
1. Click tombol **"Tambah Header Info"**
2. Isi form:
   - **Nama Website**: Contoh "JasaIbnu"
   - **Email**: Contoh "info@jasaibnu.id"
   - **Telepon**: Contoh "+62 812 3456 7890"
   - **Teks Tombol CTA**: Contoh "Hubungi Kami"
   - **Link Tombol CTA**: Contoh "/contact" atau "https://wa.me/628123456789"
   - **Status**: Toggle ON untuk aktif, OFF untuk non-aktif
3. Click **"Simpan Header Info"**

### Edit Existing Header Info
1. Pada list header info, click tombol **"Edit"**
2. Update data yang diperlukan
3. Click **"Update Header Info"**

### Delete Header Info
1. Pada list header info, click tombol **"Hapus"**
2. Confirm delete dengan SweetAlert
3. Data akan dihapus permanen

---

## 🌐 Frontend Integration

### Basic Usage in Blade Templates

#### 1. Get Active Header Info
```php
@php
    $header = \App\Models\HeaderInfo::where('status', true)->first();
@endphp
```

#### 2. Display in Template
```php
@if($header)
    <div class="header-info">
        <!-- Website Name -->
        <span class="website-name">{{ $header->nama_website }}</span>
        
        <!-- Email -->
        <a href="mailto:{{ $header->email }}">
            <i class="fas fa-envelope"></i> {{ $header->email }}
        </a>
        
        <!-- Phone -->
        <a href="tel:{{ $header->telepon }}">
            <i class="fas fa-phone"></i> {{ $header->telepon }}
        </a>
        
        <!-- CTA Button -->
        <a href="{{ $header->cta_link }}" class="btn btn-primary">
            {{ $header->cta_text }}
        </a>
    </div>
@endif
```

#### 3. Example Implementation (Template Consulotion Style)
```php
{{-- Top Bar Header --}}
<div class="top-bar">
    <div class="container">
        <div class="row">
            @php
                $header = \App\Models\HeaderInfo::where('status', true)->first();
            @endphp
            
            @if($header)
                <div class="col-md-6">
                    <ul class="top-info">
                        <li>
                            <a href="mailto:{{ $header->email }}">
                                <i class="fa fa-envelope"></i> {{ $header->email }}
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{ str_replace(' ', '', $header->telepon) }}">
                                <i class="fa fa-phone"></i> {{ $header->telepon }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="top-right">
                        <a href="{{ $header->cta_link }}" class="btn btn-sm btn-primary">
                            {{ $header->cta_text }}
                        </a>
                    </div>
                </div>
            @else
                {{-- Default/Fallback Content --}}
                <div class="col-md-12">
                    <p class="text-center">Welcome to our website</p>
                </div>
            @endif
        </div>
    </div>
</div>
```

### Using in Controller
```php
use App\Models\HeaderInfo;

class YourController extends Controller
{
    public function index()
    {
        $headerInfo = HeaderInfo::active()->first();
        // atau
        $headerInfo = HeaderInfo::where('status', true)->first();
        
        return view('your.view', compact('headerInfo'));
    }
}
```

### Available Scope Methods
```php
// Get active header info
HeaderInfo::active()->first();

// Get all header info (including inactive)
HeaderInfo::all();

// Get latest created
HeaderInfo::latest()->get();
```

---

## 🎨 Features

### ✅ Implemented Features
- ✅ Full CRUD functionality (Create, Read, Update, Delete)
- ✅ Only 1 active record allowed (auto-deactivate others)
- ✅ Form validation for all fields
- ✅ SweetAlert for delete confirmation
- ✅ Success/Error notifications
- ✅ Toggle switch for status (ON/OFF)
- ✅ Responsive admin interface (Soft UI Dashboard)
- ✅ Icon-based navigation
- ✅ Auto-hide alerts after 5 seconds

### 🔒 Business Rules
1. **Single Active Record**: Hanya 1 header info yang dapat berstatus aktif
2. **Required Fields**: Semua field wajib diisi
3. **Email Validation**: Email harus valid format
4. **Status Toggle**: Jika set aktif, otomatis menonaktifkan record lain

---

## 🧪 Testing

### Test CRUD Operations
```bash
# 1. Create test data
php artisan tinker
>>> $header = \App\Models\HeaderInfo::create(['nama_website' => 'Test Site', 'email' => 'test@test.com', 'telepon' => '123456', 'cta_text' => 'Contact', 'cta_link' => '/contact', 'status' => true]);

# 2. Verify active record
>>> \App\Models\HeaderInfo::active()->first();

# 3. Test single active constraint
>>> \App\Models\HeaderInfo::create(['nama_website' => 'Test 2', 'email' => 'test2@test.com', 'telepon' => '123456', 'cta_text' => 'Contact', 'cta_link' => '/contact', 'status' => true]);
>>> \App\Models\HeaderInfo::where('status', true)->count(); // Should be 1
```

---

## 📝 Database Structure

### Table: `header_info`
```sql
CREATE TABLE `header_info` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nama_website` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `telepon` varchar(255) NOT NULL,
    `cta_text` varchar(255) NOT NULL,
    `cta_link` varchar(255) NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);
```

---

## 🚀 API Endpoints (Admin)

| Method | URL | Action | Description |
|--------|-----|--------|-------------|
| GET | `/adminui/header-info` | index | List all header info |
| GET | `/adminui/header-info/create` | create | Show create form |
| POST | `/adminui/header-info` | store | Save new header info |
| GET | `/adminui/header-info/{id}/edit` | edit | Show edit form |
| PUT/PATCH | `/adminui/header-info/{id}` | update | Update header info |
| DELETE | `/adminui/header-info/{id}` | destroy | Delete header info |

---

## 🎯 Next Steps (Optional Enhancements)

Jika diperlukan di masa depan, bisa menambahkan:
- [ ] Social media links (Facebook, Instagram, Twitter)
- [ ] Working hours display
- [ ] Multiple language support
- [ ] Custom CSS classes for styling
- [ ] Cache management for performance
- [ ] API endpoint untuk frontend SPA

---

## ⚠️ Important Notes

1. **Jangan ubah file lain**: Modul ini independent, tidak mengubah modul existing
2. **Hanya 1 aktif**: System otomatis ensure hanya 1 record status=true
3. **Validasi required**: Semua field wajib diisi untuk data consistency
4. **Soft UI Theme**: Views menggunakan template Soft UI Dashboard existing

---

## 📞 Support

Modul ini dibuat sesuai spesifikasi:
- ✅ Bahasa Indonesia untuk database & komentar
- ✅ Tidak mengubah modul existing
- ✅ Full CRUD dengan SweetAlert
- ✅ Toggle switch untuk status
- ✅ Responsive design

**Status**: ✅ COMPLETED & READY TO USE

---

*Generated on: November 2, 2025*
