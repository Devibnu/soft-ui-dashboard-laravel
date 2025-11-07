# Projects Module Documentation

## Overview
Complete CRUD module for managing and displaying projects on JasaIbnu website. This module is fully independent and does not affect existing modules (About, Blog, Services, Contact).

## Database Structure

### Table: `proyek`
Created via migration: `2025_10_29_075116_create_proyek_table.php`

**Columns:**
- `id` - Primary key
- `judul` - Project title (string, 255)
- `slug` - URL-friendly identifier (string, unique, auto-generated)
- `kategori` - Project category (string, 100)
- `deskripsi_singkat` - Short description (text)
- `deskripsi_lengkap` - Full description with HTML (text)
- `gambar_utama` - Main project image path (string, nullable)
- `galeri` - JSON array of gallery image paths (json, nullable)
- `klien` - Client name (string, 255, nullable)
- `lokasi` - Project location (string, 255, nullable)
- `tanggal_proyek` - Project date (date, nullable)
- `status` - Active/inactive (boolean, default: true)
- `timestamps` - created_at, updated_at

**Migration Commands:**
```bash
php artisan migrate
php artisan db:seed --class=ProjectSeeder
```

## Model

### File: `app/Models/Proyek.php`

**Features:**
- Auto-slug generation from `judul` on create/update
- Unique slug enforcement with counter suffix (e.g., project-name-2)
- JSON casting for `galeri` field
- Date casting for `tanggal_proyek`
- Query scopes:
  - `scopeAktif($query)` - Get only active projects
  - `scopeKategori($query, $kategori)` - Filter by category

**Usage Examples:**
```php
// Get all active projects
$projects = Proyek::aktif()->get();

// Filter by category
$webProjects = Proyek::aktif()->kategori('Web Development')->get();

// Auto-slug example
$project = new Proyek(['judul' => 'My Project']);
$project->save(); // slug automatically becomes 'my-project'
```

## Admin Panel (Backend)

### Routes: `/adminui/projects`
All routes use `adminui` prefix and require authentication.

**Available Routes:**
- `GET /adminui/projects` - List all projects
- `GET /adminui/projects/create` - Create form
- `POST /adminui/projects` - Store new project
- `GET /adminui/projects/{project}/edit` - Edit form
- `PUT /adminui/projects/{project}` - Update project
- `DELETE /adminui/projects/{project}` - Delete project

### Controller: `app/Http/Controllers/Admin/ProjectController.php`

**Methods:**

1. **index()** - Display paginated list (10 per page)
2. **create()** - Show create form with predefined categories
3. **store(Request $request)** - Validate and save new project
   - Uploads main image to `storage/projects/`
   - Uploads gallery images to `storage/projects/gallery/`
   - Shows success/error notifications
4. **edit(Proyek $project)** - Show edit form with existing data
5. **update(Request $request, Proyek $project)** - Update existing project
   - Handles image replacement (deletes old if new uploaded)
   - Manages gallery additions and deletions
6. **destroy(Proyek $project)** - Delete project and all images

**Validation Rules:**
```php
'judul' => 'required|string|max:255',
'kategori' => 'required|string|max:100',
'deskripsi_singkat' => 'required|string',
'deskripsi_lengkap' => 'required|string',
'gambar_utama' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Required on create only
'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
'klien' => 'nullable|string|max:255',
'lokasi' => 'nullable|string|max:255',
'tanggal_proyek' => 'nullable|date',
'status' => 'required|boolean'
```

### Admin Views

#### 1. Index Page: `resources/views/adminui/projects/index.blade.php`
- Table listing with thumbnail, title, category, client, date, status
- Edit and Delete buttons per row
- SweetAlert2 confirmation on delete
- Pagination support
- Success/error message display

#### 2. Create Page: `resources/views/adminui/projects/create.blade.php`
- Full form with all fields
- CKEditor5 for `deskripsi_lengkap`
- Image preview for main image
- Multiple image upload for gallery with previews
- Predefined categories dropdown
- Status toggle
- Back button to index

**Predefined Categories:**
- Web Development
- Mobile App
- UI/UX Design
- Branding
- Digital Marketing
- E-Commerce

#### 3. Edit Page: `resources/views/adminui/projects/edit.blade.php`
- Pre-filled form with existing data
- CKEditor5 for content editing
- Main image preview with option to replace
- Gallery management:
  - Display existing images
  - Checkbox to mark images for deletion
  - Upload new images to add to gallery
- Current slug display

**CKEditor5 Implementation:**
```javascript
ClassicEditor.create(document.querySelector('#deskripsi_lengkap'), {
    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 
              'numberedList', '|', 'outdent', 'indent', '|', 
              'blockQuote', 'insertTable', 'undo', 'redo']
})
```

## Frontend (Public Website)

### Routes
- `GET /projects` - List all active projects
- `GET /projects/{slug}` - Project detail page

### Controller: `app/Http/Controllers/ProjectFrontendController.php`

**Methods:**

1. **index(Request $request)**
   - Displays active projects only
   - Supports search by title
   - Supports category filter
   - Pagination (9 per page)
   - Returns categories for filter buttons

2. **show($slug)**
   - Find project by slug
   - Get related projects (same category, max 3)
   - 404 if not found or inactive

### Frontend Views

#### 1. Projects List: `resources/views/website/project.blade.php`
Based on Consulotion template's `project.html`

**Features:**
- Search form in navigation
- Category filter buttons (All + each category)
- Grid layout (3 columns)
- Project cards with:
  - Background image overlay
  - Title and category
  - Link to detail page
- Custom pagination
- Responsive design

**Filter Example:**
```blade
<a href="{{ route('projects.index', ['kategori' => 'Web Development']) }}" 
   class="btn btn-sm btn-primary">
  Web Development
</a>
```

#### 2. Project Detail: `resources/views/website/project-single.blade.php`
Based on Consulotion template's `blog-single.html` structure

**Features:**
- Hero section with project title
- Main image display
- Short and full descriptions
- Project gallery with lightbox (Magnific Popup)
- Project information box:
  - Category
  - Client name
  - Location
  - Project date
- Sidebar with:
  - Category list with counts
  - Related projects (same category)
  - Contact CTA
- Responsive layout

## Seeder

### File: `database/seeders/ProjectSeeder.php`

**Includes 5 Example Projects:**
1. Website E-Commerce Fashion Terkini (Web Development)
2. Mobile App Delivery Food (Mobile App)
3. Corporate Website & Branding (Branding)
4. Dashboard Analytics untuk SaaS (UI/UX Design)
5. Digital Marketing Campaign (Digital Marketing)

**Run Seeder:**
```bash
php artisan db:seed --class=ProjectSeeder
```

**Note:** Seeder creates projects with placeholder image paths. You need to add actual images to:
- `storage/app/public/projects/` - Main images
- `storage/app/public/projects/gallery/` - Gallery images

## Image Storage

### Storage Structure
```
storage/
  app/
    public/
      projects/
        {main-images}.jpg
        gallery/
          {gallery-images}.jpg
```

### Setup Storage Link
```bash
php artisan storage:link
```

### Image Upload Handling
- Main image: `$request->file('gambar_utama')->store('projects', 'public')`
- Gallery images: Loop and store to `projects/gallery`
- Update: Deletes old image before storing new one
- Delete: Cascading deletion of all project images

### Image Display
```blade
<!-- Admin -->
<img src="{{ asset('storage/' . $project->gambar_utama) }}" alt="{{ $project->judul }}">

<!-- Frontend -->
@if($project->gambar_utama)
  <img src="{{ asset('storage/' . $project->gambar_utama) }}" class="img-fluid">
@endif
```

## Integration with Existing System

### Navigation Updates
Update your navigation menu in layouts to include:

```blade
<!-- Admin Menu -->
<li class="nav-item">
  <a href="{{ route('adminui.projects.index') }}" class="nav-link">
    <i class="fas fa-folder-open"></i>
    <span class="nav-link-text ms-1">Projects</span>
  </a>
</li>

<!-- Frontend Menu -->
<li class="nav-item">
  <a href="{{ route('projects.index') }}" class="nav-link">Projects</a>
</li>
```

### No Conflicts
This module:
- ✅ Uses separate table (`proyek`)
- ✅ Uses separate controllers namespace (`Admin\ProjectController`, `ProjectFrontendController`)
- ✅ Uses unique routes (`/projects`, `/adminui/projects`)
- ✅ Uses separate views directories
- ✅ Does NOT modify any existing modules

## Testing Checklist

### Admin Panel
- [ ] Access `/adminui/projects` (requires login)
- [ ] Click "Tambah Project" button
- [ ] Fill form with all fields
- [ ] Upload main image (max 2MB, JPG/PNG)
- [ ] Upload multiple gallery images
- [ ] Use CKEditor to format description
- [ ] Save and verify redirect to index
- [ ] Edit existing project
- [ ] Replace main image
- [ ] Add/remove gallery images
- [ ] Update content with CKEditor
- [ ] Delete project (confirm SweetAlert works)
- [ ] Verify images are deleted from storage
- [ ] Test pagination

### Frontend
- [ ] Visit `/projects`
- [ ] Test category filters
- [ ] Test search functionality
- [ ] Test pagination
- [ ] Click on project card
- [ ] Verify detail page loads
- [ ] Check all project info displays
- [ ] Test gallery lightbox
- [ ] Verify related projects appear
- [ ] Test category sidebar links
- [ ] Click "Contact Us" CTA

### Edge Cases
- [ ] Try creating project without title (should fail validation)
- [ ] Try uploading file > 2MB (should fail)
- [ ] Try uploading non-image file (should fail)
- [ ] Create project with duplicate title (slug should auto-increment)
- [ ] Create project without gallery (should work)
- [ ] Filter by category with no projects (should show empty state)
- [ ] Search for non-existent project (should show empty state)
- [ ] Access non-existent slug on detail page (should 404)

## Customization Guide

### Adding New Categories
Edit the categories array in both controllers:

**Admin Controller (create/edit methods):**
```php
$categories = [
    'Web Development', 
    'Mobile App', 
    'UI/UX Design', 
    'Branding', 
    'Digital Marketing', 
    'E-Commerce',
    'Your New Category'  // Add here
];
```

### Changing Pagination
**Admin (10 per page):**
```php
// In ProjectController@index
$projects = Proyek::latest()->paginate(15); // Change 10 to 15
```

**Frontend (9 per page):**
```php
// In ProjectFrontendController@index
$projects = $query->paginate(12); // Change 9 to 12
```

### Customizing CKEditor Toolbar
```javascript
toolbar: [
    'heading', '|', 
    'bold', 'italic', 'underline', '|',  // Add underline
    'link', 'imageUpload', '|',  // Add image upload
    'bulletedList', 'numberedList', '|', 
    'outdent', 'indent', '|', 
    'blockQuote', 'insertTable', 
    'undo', 'redo'
]
```

### Adding Status Filter to Admin
In `ProjectController@index`:
```php
$query = Proyek::query();

if ($request->has('status')) {
    $query->where('status', $request->status);
} else {
    $query->latest();
}

$projects = $query->paginate(10);
```

## Troubleshooting

### Images Not Displaying
```bash
# Ensure storage link exists
php artisan storage:link

# Check file permissions
chmod -R 775 storage/app/public
```

### CKEditor Not Loading
- Check CDN connection: `https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js`
- Verify script is in `@push('js')` section
- Check browser console for errors

### Routes Not Working
```bash
php artisan route:clear
php artisan route:list | grep projects  # Verify routes exist
```

### Slug Conflicts
The auto-slug generation handles conflicts automatically:
- "My Project" → `my-project`
- "My Project" (duplicate) → `my-project-2`
- "My Project" (another) → `my-project-3`

### Gallery Images Not Saving
- Check `enctype="multipart/form-data"` in form tag
- Verify `galeri[]` name with brackets for multiple files
- Check file size limits in `php.ini`:
  ```ini
  upload_max_filesize = 10M
  post_max_size = 20M
  ```

## File Summary

### Created Files
```
app/
  Http/Controllers/
    Admin/ProjectController.php
    ProjectFrontendController.php
  Models/Proyek.php

database/
  migrations/2025_10_29_075116_create_proyek_table.php
  seeders/ProjectSeeder.php

resources/views/
  adminui/projects/
    index.blade.php
    create.blade.php
    edit.blade.php
  website/
    project.blade.php
    project-single.blade.php
```

### Modified Files
```
routes/web.php - Added admin and frontend routes
```

## Commands Reference

```bash
# Run migration
php artisan migrate

# Run seeder
php artisan db:seed --class=ProjectSeeder

# Create storage link
php artisan storage:link

# Clear caches
php artisan route:clear
php artisan view:clear
php artisan config:clear

# Check routes
php artisan route:list | grep projects
```

## Support & Maintenance

### Regular Tasks
- Monitor storage usage (`storage/app/public/projects/`)
- Optimize images before upload (recommended < 500KB)
- Backup database regularly
- Review and approve projects before setting status=active

### Future Enhancements
- [ ] Add project tags system
- [ ] Implement project sorting (newest, oldest, popular)
- [ ] Add view counter for projects
- [ ] Enable project comments
- [ ] Add export to PDF functionality
- [ ] Implement project portfolio download
- [ ] Add multi-language support
- [ ] Create public API for projects

---

**Module Status:** ✅ Complete and Production Ready
**Last Updated:** January 2025
**Version:** 1.0.0
