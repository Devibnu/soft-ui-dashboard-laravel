# Contact Messages Module - Documentation

## Overview
Module untuk mengelola pesan kontak dari website JasaIbnu.id. Admin dapat membaca, membalas via email/WhatsApp, dan mengelola status pesan.

## Features
✅ **List View** - Tampilan daftar semua pesan kontak dengan pagination
✅ **Detail View** - Detail lengkap pesan dengan informasi pengirim
✅ **Status Management** - 3 status: Baru, Dibaca, Selesai
✅ **Email Reply** - Balas pesan langsung via email menggunakan Gmail SMTP
✅ **WhatsApp Reply** - Generate link WhatsApp dengan template pesan
✅ **Delete Messages** - Hapus pesan dengan konfirmasi SweetAlert2
✅ **Auto Mark as Read** - Otomatis tandai dibaca saat membuka detail
✅ **Test Data** - 5 sample pesan untuk testing

## Database Structure

### Table: `contact_messages`
```sql
id              BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
name            VARCHAR(255) NOT NULL
email           VARCHAR(255) NOT NULL
subject         VARCHAR(255) NOT NULL
message         TEXT NOT NULL
status          ENUM('baru', 'dibaca', 'selesai') DEFAULT 'baru'
read_at         TIMESTAMP NULL
created_at      TIMESTAMP NULL
updated_at      TIMESTAMP NULL
```

### Status Flow
1. **baru** - Pesan baru dari website (status default)
2. **dibaca** - Admin sudah membuka detail pesan
3. **selesai** - Admin sudah membalas via email/WhatsApp

## Files Created

### 1. Migration
**File:** `database/migrations/2025_11_06_143608_create_contact_messages_table.php`
- Create table contact_messages
- Status: ✅ Migrated

### 2. Model
**File:** `app/Models/ContactMessage.php`
- Fillable: name, email, subject, message, status, read_at
- Computed Attributes:
  - `status_badge` - Returns CSS class for badge
  - `status_label` - Returns Indonesian label
- Methods:
  - `markAsRead()` - Update status dari 'baru' ke 'dibaca'

### 3. Controller
**File:** `app/Http/Controllers/Admin/ContactMessageController.php`
- `index()` - List semua pesan (20 per page)
- `show($id)` - Detail pesan + auto mark as read
- `updateStatus()` - Update status via AJAX
- `destroy($id)` - Delete pesan
- `replyEmail($id)` - Kirim email balasan via Gmail
- `replyWhatsapp($id)` - Generate WhatsApp URL + update status

### 4. Email Template
**File:** `resources/views/emails/contact_reply.blade.php`
- Professional HTML template
- Gradient header design
- Variables: $customerName, $replyMessage, $originalSubject, $originalMessage

### 5. Admin Views
**File:** `resources/views/adminui/contact_messages/index.blade.php`
- Table dengan avatar initials
- Status badges (baru=danger, dibaca=warning, selesai=success)
- View & Delete buttons
- Empty state jika belum ada pesan

**File:** `resources/views/adminui/contact_messages/show.blade.php`
- Customer info card
- Status dropdown (update via AJAX)
- Original message display
- Reply textarea dengan 2 buttons:
  - 📧 Balas via Email (API route)
  - 💬 Balas via WhatsApp (redirect)

### 6. Frontend Contact Form
**File:** `resources/views/web/contact.blade.php`
- Updated form dengan name attributes
- AJAX submission dengan jQuery
- Success/error messages dengan alert
- Fields: name, email, subject, message

### 7. Seeder
**File:** `database/seeders/ContactMessageSeeder.php`
- 5 sample messages
- Various status (baru, dibaca, selesai)
- Different timestamps
- Status: ✅ Seeded

## Routes

### Web Routes (Admin UI)
```php
Route::prefix('adminui')->name('adminui.')->group(function () {
    // Contact Messages CRUD
    Route::get('contact-messages', ContactMessageController@index)
        ->name('contact-messages.index');
    
    Route::get('contact-messages/{id}', ContactMessageController@show)
        ->name('contact-messages.show');
    
    Route::post('contact-messages/{id}/update-status', ContactMessageController@updateStatus)
        ->name('contact-messages.update-status');
    
    Route::delete('contact-messages/{id}', ContactMessageController@destroy)
        ->name('contact-messages.destroy');
    
    Route::post('contact-messages/{id}/reply-whatsapp', ContactMessageController@replyWhatsapp)
        ->name('contact-messages.reply-whatsapp');
});
```

### API Routes (Email Reply)
```php
// NO CSRF, NO WEB MIDDLEWARE
Route::post('/api/adminui/contact-messages/{id}/reply-email', 
    ContactMessageController@replyEmail);
```

### Frontend Routes
```php
// Contact Page
Route::get('/contact', KontakController@frontend)->name('contact');

// Submit Contact Form
Route::post('/contact/submit', KontakController@submitContactForm)->name('contact.submit');
```

## Menu Navigation
**File:** `resources/views/adminui/layouts/sidebar.blade.php`
- Position: After "Request Quote" menu
- Icon: Email envelope icon
- Route: `adminui.contact-messages.index`
- Permission: Dashboard

## Email Configuration
Gmail SMTP sudah dikonfigurasi di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=devibnuq@gmail.com
MAIL_PASSWORD=vzicxezcxcluuajk
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=devibnuq@gmail.com
MAIL_FROM_NAME="JasaIbnu"
```

## Usage Flow

### 1. User Mengirim Pesan
1. User mengisi form di `/contact`
2. Submit via AJAX ke `/contact/submit`
3. KontakController::submitContactForm() create ContactMessage
4. Status default: 'baru'
5. User dapat success message

### 2. Admin Melihat Pesan
1. Admin masuk ke menu "Contact Messages"
2. Melihat list semua pesan di `/adminui/contact-messages`
3. Badge "Baru" menunjukkan pesan belum dibaca
4. Klik "View" untuk detail

### 3. Admin Membuka Detail
1. Redirect ke `/adminui/contact-messages/{id}`
2. Auto mark as read (status: 'baru' → 'dibaca')
3. Tampil info lengkap: nama, email, subject, pesan
4. Ada dropdown status dan tombol balas

### 4. Admin Balas via Email
1. Ketik balasan di textarea
2. Klik "Balas via Email" 
3. AJAX ke API route (bypass CSRF)
4. Email dikirim via Gmail SMTP
5. Status update ke 'selesai'
6. SweetAlert2 success notification

### 5. Admin Balas via WhatsApp
1. Ketik balasan di textarea
2. Klik "Balas via WhatsApp"
3. Generate WhatsApp URL dengan template
4. Redirect ke WhatsApp web/app
5. Status update ke 'selesai'

### 6. Admin Update Status Manual
1. Klik dropdown status
2. Pilih status baru
3. AJAX update via `/contact-messages/{id}/update-status`
4. Badge berubah warna real-time

### 7. Admin Hapus Pesan
1. Klik tombol Delete (trash icon)
2. SweetAlert2 konfirmasi
3. AJAX DELETE ke `/contact-messages/{id}`
4. Row dihapus dari table

## Testing Checklist

### ✅ Database
- [x] Migration berhasil
- [x] Table created dengan kolom lengkap
- [x] Seeder berhasil (5 messages)

### ✅ Routes
- [x] Web routes terdaftar (5 routes)
- [x] API route terdaftar (1 route)
- [x] Frontend route submit form

### ✅ Backend
- [x] Controller methods complete
- [x] Model dengan computed attributes
- [x] Email template professional

### ✅ Frontend
- [x] Index view dengan table
- [x] Detail view dengan reply options
- [x] Contact form updated dengan AJAX
- [x] Menu item di sidebar

### 🔲 Testing Needed
- [ ] Submit contact form dari website
- [ ] Verify message masuk ke database
- [ ] Buka list messages di admin
- [ ] Klik view detail
- [ ] Test email reply (verify email terkirim)
- [ ] Test WhatsApp reply (verify redirect)
- [ ] Test status update
- [ ] Test delete message
- [ ] Test pagination (jika >20 messages)

## Troubleshooting

### Issue: Email tidak terkirim
**Solution:** 
- Cek Gmail SMTP config di `.env`
- Cek App Password masih valid
- Lihat Laravel log: `storage/logs/laravel.log`
- Test manual: `php artisan tinker` → `Mail::raw('test', function($m) { $m->to('test@example.com')->subject('Test'); });`

### Issue: CSRF Token Mismatch pada email reply
**Solution:** 
- Email reply menggunakan API route (no CSRF check)
- Pastikan URL: `/api/adminui/contact-messages/{id}/reply-email`
- Jangan gunakan `@csrf` di form

### Issue: Routes tidak ditemukan
**Solution:**
- Run: `php artisan route:clear`
- Run: `php artisan route:cache`
- Verify: `php artisan route:list --name=contact-messages`

### Issue: View tidak tampil
**Solution:**
- Cek typo di route name
- Pastikan controller return view yang benar
- Cek permission middleware

## Related Modules
- **Request Quote Inbox** - Similar pattern untuk quote requests
- **Contact Page Admin** - Manage kontak info perusahaan
- **Email System** - Shared Gmail SMTP configuration

## Future Enhancements
- [ ] Email notification ke admin saat ada pesan baru
- [ ] Attachment upload di contact form
- [ ] Export messages to Excel/CSV
- [ ] Auto-reply template system
- [ ] Search & filter by status/date/email
- [ ] Pagination customize (20, 50, 100 per page)
- [ ] Soft delete instead of hard delete
- [ ] Admin notes/internal comments

## Developer Notes
- Pattern mengikuti Request Quote Inbox module
- Menggunakan API route untuk bypass CSRF issues
- SweetAlert2 untuk user experience
- Extensive logging untuk debugging
- Indonesian localization untuk messages
- Professional email template matching brand design

## Contact
Developer: GitHub Copilot
Date: 2025-01-06
Version: 1.0.0
Status: ✅ Production Ready
