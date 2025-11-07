# 📤 Upload Guidelines - Jasa Ibnu Admin Panel

## Image Upload Specifications

### 🖼️ About Headers (Slideshow)
- **Maximum Size**: 5MB (5120 KB)
- **Supported Formats**: JPG, JPEG, PNG, GIF, WEBP
- **Optimal Resolution**: 1920x800px
- **Usage**: Hero section slideshow backgrounds

### 📄 About Contents
- **Maximum Size**: 5MB (5120 KB)
- **Supported Formats**: JPG, JPEG, PNG, GIF, WEBP
- **Optimal Resolution**: 600x400px
- **Usage**: Content section images

## Error Messages

### ⚠️ Size Limit Exceeded
**Message**: "Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB)."
**Solution**: Compress your image or use a smaller file.

### 🚫 Invalid Format
**Message**: "Format gambar tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp."
**Solution**: Convert your image to a supported format.

### 📋 Validation Errors
- All validation errors appear as dismissible Bootstrap alerts
- Orange/warning alerts for file upload issues
- Red/danger alerts for form validation errors
- Existing data is preserved when upload fails

## System Configuration
- **Server Upload Limit**: 50MB
- **POST Size Limit**: 55MB
- **Laravel Validation**: 5MB per file
- **Max Files**: 20 files per request

## Best Practices
1. **Compress images** before uploading
2. **Use web-optimized formats** (WEBP recommended)
3. **Check file size** before uploading
4. **Use appropriate resolutions** for better performance
5. **Test uploads** with different file sizes

## Troubleshooting
- If upload fails, check file size and format
- Clear browser cache if issues persist
- Contact admin if server limits need adjustment