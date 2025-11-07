# Database Configuration Guide

## 📋 Konfigurasi Database Laravel untuk JasaIbnu

### 🎯 Status Saat Ini:
✅ **SQLite Database**: Sudah dikonfigurasi dan berjalan dengan baik  
✅ **Laravel Breeze**: Terinstall dan terintegrasi dengan adminui  
✅ **User Authentication**: Berfungsi dengan sempurna  
✅ **AdminUI Integration**: Login menggunakan sistem auth Laravel Breeze  

### 🔄 Cara Migrasi ke MySQL:

Ketika MySQL server sudah siap, ikuti langkah berikut:

#### 1. Edit file `.env`:
```env
# Ganti konfigurasi database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jasaibnu
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

#### 2. Pastikan MySQL service berjalan:
```bash
# macOS (menggunakan Homebrew)
brew services start mysql

# Atau jika menggunakan MAMP/XAMPP
# Start MySQL dari control panel
```

#### 3. Buat database `jasaibnu` di MySQL:
```sql
CREATE DATABASE jasaibnu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 4. Migrasi data ke MySQL:
```bash
php artisan migrate:fresh --seed
```

#### 5. Clear dan cache konfigurasi:
```bash
php artisan optimize:clear
php artisan config:cache
```

### 👤 User Admin untuk Testing:
- **Email**: `admin@jasaibnu.com`
- **Password**: `password`

### 🌐 URL Testing:
- **Main AdminUI**: `http://localhost:8000/adminui`
- **Login Page**: `http://localhost:8000/adminui/login`
- **Dashboard**: `http://localhost:8000/adminui/dashboard`

### 📊 Tabel Database yang Dibuat:
1. `users` - User authentication
2. `password_resets` - Password reset tokens
3. `failed_jobs` - Failed job queue
4. `personal_access_tokens` - API tokens (Laravel Sanctum)

### 🔧 Troubleshooting MySQL:
Jika mengalami error koneksi MySQL:
1. Pastikan MySQL service berjalan
2. Cek username dan password di `.env`
3. Pastikan database `jasaibnu` sudah dibuat
4. Test koneksi: `php artisan tinker` lalu `DB::connection()->getPdo()`