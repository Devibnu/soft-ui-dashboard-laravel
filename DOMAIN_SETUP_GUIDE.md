# 🔧 Setup Domain jasaibnu.id untuk Local Development

## ✅ Status: AdminUI Routes Sudah Diperbaiki!

Routes adminui sudah berhasil ditambahkan kembali dan berfungsi dengan baik di:
- ✅ `http://localhost:8000/adminui`
- ✅ `http://localhost:8000/adminui/login`
- ✅ `http://localhost:8000/adminui/dashboard`

## 🌐 Cara Setup Domain jasaibnu.id untuk Local:

### Opsi 1: Edit File Hosts (Recommended untuk Development)

**macOS/Linux:**
```bash
sudo nano /etc/hosts
```

**Windows:**
```bash
# Buka sebagai Administrator
notepad C:\Windows\System32\drivers\etc\hosts
```

Tambahkan baris ini:
```
127.0.0.1   jasaibnu.id
127.0.0.1   www.jasaibnu.id
```

Setelah itu akses: `http://jasaibnu.id:8000/adminui`

### Opsi 2: Virtual Host Apache/Nginx

**Untuk Apache (httpd.conf atau sites-available):**
```apache
<VirtualHost *:80>
    DocumentRoot "/Users/ibnuqosim/Documents/devlopmentibnu/jasaibnu/public"
    ServerName jasaibnu.id
    ServerAlias www.jasaibnu.id
</VirtualHost>
```

**Untuk Nginx:**
```nginx
server {
    listen 80;
    server_name jasaibnu.id www.jasaibnu.id;
    root /Users/ibnuqosim/Documents/devlopmentibnu/jasaibnu/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

### Opsi 3: Laravel Valet (macOS)

```bash
# Install Valet
composer global require laravel/valet
valet install

# Di folder project
cd /Users/ibnuqosim/Documents/devlopmentibnu/jasaibnu
valet link jasaibnu

# Akses via: http://jasaibnu.test/adminui
```

## 🚀 URL Testing yang Berfungsi Sekarang:

### Localhost (Sudah Berfungsi):
- `http://localhost:8000/adminui` → Smart redirect
- `http://localhost:8000/adminui/login` → Login page  
- `http://localhost:8000/adminui/dashboard` → Dashboard

### Setelah Setup Domain:
- `http://jasaibnu.id/adminui` (port 80 dengan Apache/Nginx)
- `http://jasaibnu.id:8000/adminui` (dengan php artisan serve + hosts file)

## 🔑 Login Credentials:
- **Email**: `admin@jasaibnu.com`
- **Password**: `password`

## ⚡ Quick Fix untuk Testing:
Gunakan localhost dulu untuk testing:
`http://localhost:8000/adminui`

Routes sudah diperbaiki dan adminui sudah berfungsi normal!