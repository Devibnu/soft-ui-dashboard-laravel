# Email Configuration Guide - JasaIbnu

## Overview
Panduan untuk mengkonfigurasi email SMTP agar fitur "Balas via Email" di Request Quote Inbox dapat berfungsi.

## Pilihan Provider Email

### 1. Gmail SMTP (Recommended - Free)

**Langkah-langkah:**

#### A. Setup Gmail App Password
1. Login ke Gmail Anda
2. Buka https://myaccount.google.com/security
3. Aktifkan **2-Step Verification** (jika belum)
4. Setelah aktif, kembali ke Security
5. Cari **App passwords** di bagian "Signing in to Google"
6. Klik **App passwords**
7. Pilih **Mail** sebagai app dan **Other** sebagai device
8. Tulis nama: "JasaIbnu Website"
9. Klik **Generate**
10. **Copy password 16 karakter** yang muncul (contoh: `abcd efgh ijkl mnop`)

#### B. Update .env File
Edit file `.env` di root project dan ubah bagian MAIL:

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

**⚠️ PENTING:** 
- Ganti `your-email@gmail.com` dengan email Gmail Anda
- Ganti `abcdefghijklmnop` dengan App Password yang sudah di-generate (tanpa spasi)
- Jangan gunakan password Gmail biasa, harus App Password!

---

### 2. Gmail SMTP Alternative (Port 465)

Jika port 587 tidak bekerja, coba port 465 dengan SSL:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=abcdefghijklmnop
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="JasaIbnu"
```

---

### 3. Mailtrap (Testing Only - Free)

Untuk testing di development:

1. Daftar di https://mailtrap.io (gratis)
2. Buat inbox baru
3. Copy credentials SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@jasaibnu.com
MAIL_FROM_NAME="JasaIbnu"
```

**Note:** Mailtrap hanya untuk testing, email tidak akan terkirim ke user sebenarnya.

---

### 4. SendGrid (Production - Free Tier: 100 emails/day)

1. Daftar di https://sendgrid.com
2. Verify email Anda
3. Buat API Key di Settings → API Keys
4. Copy API Key

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@jasaibnu.com
MAIL_FROM_NAME="JasaIbnu"
```

---

### 5. Mailgun (Production - Free Tier: 5000 emails/month)

1. Daftar di https://mailgun.com
2. Verify domain atau gunakan sandbox domain
3. Copy SMTP credentials

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@your-domain.mailgun.org
MAIL_PASSWORD=your-mailgun-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@jasaibnu.com
MAIL_FROM_NAME="JasaIbnu"
```

---

## Cara Apply Konfigurasi

### 1. Edit File .env
```bash
nano .env
# atau
vim .env
# atau gunakan editor favorit
```

### 2. Clear Config Cache
Setelah edit .env, jalankan:
```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
```

### 3. Test Email
Buka admin panel:
1. Go to `/adminui/request-quote/inbox`
2. Pilih salah satu message
3. Klik "Balas via Email"
4. Jika berhasil, akan muncul "Email berhasil dikirim"

---

## Troubleshooting

### Error: "Connection refused"
**Solusi:**
- Pastikan port (587 atau 465) tidak diblokir firewall
- Coba ganti port dari 587 ke 465 atau sebaliknya
- Cek apakah server mengizinkan outbound SMTP

### Error: "Username and Password not accepted"
**Solusi:**
- Untuk Gmail: Pastikan menggunakan App Password, bukan password biasa
- Cek apakah username adalah email lengkap (bukan hanya nama)
- Pastikan tidak ada spasi di password

### Error: "SSL/TLS error"
**Solusi:**
- Coba ganti `MAIL_ENCRYPTION=tls` ke `ssl` atau sebaliknya
- Sesuaikan port: TLS → 587, SSL → 465

### Email masuk Spam
**Solusi:**
- Gunakan domain email yang sama dengan website
- Setup SPF, DKIM, dan DMARC records
- Gunakan service seperti SendGrid atau Mailgun yang sudah ter-verify

---

## Recommended Setup untuk Production

**Terbaik:** Gmail SMTP (Gratis & Reliable)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@jasaibnu.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@jasaibnu.com
MAIL_FROM_NAME="JasaIbnu - Digital Solutions"
```

**Alternatif untuk High Volume:** SendGrid atau Mailgun

---

## Security Notes

⚠️ **PENTING:**
- Jangan commit file `.env` ke Git
- Jangan share App Password atau API Key
- Gunakan App Password, bukan password asli Gmail
- Backup credentials di tempat aman (password manager)

---

## Testing Commands

Test email connection dari terminal:
```bash
php artisan tinker

# Di tinker, jalankan:
Mail::raw('Test email dari JasaIbnu', function($message) {
    $message->to('test@example.com')
            ->subject('Test Email');
});

# Jika berhasil, akan return null tanpa error
# Jika error, akan muncul pesan error
```

---

## Current Status

Saat ini konfigurasi:
- **MAIL_HOST:** mailhog (development)
- **Status:** ❌ Tidak bisa mengirim email ke customer

Setelah konfigurasi Gmail:
- **MAIL_HOST:** smtp.gmail.com
- **Status:** ✅ Bisa mengirim email ke customer

---

## Support

Jika masih ada masalah setelah ikuti panduan ini:
1. Cek Laravel log: `storage/logs/laravel.log`
2. Test dengan command artisan tinker di atas
3. Pastikan `.env` sudah di-clear cache-nya

---

**Last Updated:** November 5, 2025
