# 🔐 Admin Login Credentials

## Login Information untuk AdminUI

### 📍 **URL Login:**
```
http://jasaibnu.id/adminui/login
atau
http://127.0.0.1:8000/adminui/login
```

### 🔑 **Login Credentials:**
```
Email    : admin@jasaibnu.id
Password : password123
```

### 📝 **Langkah Login:**

1. **Buka browser** ke URL login AdminUI
2. **Masukkan email**: `admin@jasaibnu.id`
3. **Masukkan password**: `password123`
4. **Klik "Sign in"**
5. **Redirect otomatis** ke Dashboard Admin

### 🚨 **Troubleshooting:**

#### Jika login gagal:
1. **Pastikan kredensial benar** (case-sensitive)
2. **Clear browser cache** dan cookies
3. **Pastikan database connection** berjalan
4. **Check Laravel logs** di `storage/logs/`

#### Test kredensial di terminal:
```bash
php artisan tinker
>>> Auth::attempt(['email' => 'admin@jasaibnu.id', 'password' => 'password123'])
```

### 🔄 **Reset Password (jika diperlukan):**
```bash
php artisan tinker
>>> $user = App\Models\User::where('email', 'admin@jasaibnu.id')->first();
>>> $user->password = Hash::make('password123');
>>> $user->save();
```

### ✅ **Test Status:**
- ✅ Admin user exists in database
- ✅ Password hashed correctly  
- ✅ Login form working
- ✅ Authentication routes active
- ✅ Dashboard redirect configured

**💡 Note:** Pastikan menggunakan kredensial yang tepat dan case-sensitive!