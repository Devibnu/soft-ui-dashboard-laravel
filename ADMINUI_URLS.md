# Soft UI Dashboard Laravel - URL Configuration

## Admin Dashboard URLs

### Main Entry Point
- **URL**: `http://jasaibnu.id/adminui`
- **Functionality**: 
  - Jika user belum login → redirect ke `/adminui/login`
  - Jika user sudah login → redirect ke `/adminui/dashboard`

### Authentication URLs
- **Login**: `http://jasaibnu.id/adminui/login`
- **Register**: `http://jasaibnu.id/adminui/register` 
- **Forgot Password**: `http://jasaibnu.id/adminui/login/forgot-password`
- **Reset Password**: `http://jasaibnu.id/adminui/reset-password/{token}`
- **Logout**: `POST http://jasaibnu.id/adminui/logout`

### Dashboard URLs (Requires Authentication)
- **Dashboard**: `http://jasaibnu.id/adminui/dashboard`
- **Profile**: `http://jasaibnu.id/adminui/profile`
- **User Profile**: `http://jasaibnu.id/adminui/user-profile`
- **User Management**: `http://jasaibnu.id/adminui/user-management`
- **Tables**: `http://jasaibnu.id/adminui/tables`
- **Billing**: `http://jasaibnu.id/adminui/billing`
- **Virtual Reality**: `http://jasaibnu.id/adminui/virtual-reality`
- **RTL**: `http://jasaibnu.id/adminui/rtl`

## Admin Credentials
- **Email**: `admin@jasaibnu.id`
- **Password**: `password`

## Development URLs (Local Testing)
Replace `http://jasaibnu.id` with `http://127.0.0.1:8000` for local development.

Example:
- Main entry: `http://127.0.0.1:8000/adminui`
- Login: `http://127.0.0.1:8000/adminui/login`
- Dashboard: `http://127.0.0.1:8000/adminui/dashboard`

## Features
✅ Smart redirect from `/adminui` based on authentication status
✅ Soft UI Dashboard Laravel theme
✅ Complete authentication system
✅ Admin user management
✅ Responsive design
✅ Production-ready configuration