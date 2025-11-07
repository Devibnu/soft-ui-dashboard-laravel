# Request Quote Services Module Documentation

## Overview
This module provides a complete admin interface for managing dynamic service options in the Request Quote form dropdown. Instead of hardcoded options, services are now stored in the database and can be easily managed through the admin panel.

## Features Implemented

### 1. Database Structure
**Migration:** `2025_11_05_070749_create_request_quote_services_table.php`
- **Table:** `request_quote_services`
- **Columns:**
  - `id` - Primary key (auto-increment)
  - `nama_service` - Service name (string, required)
  - `slug` - Auto-generated URL-friendly slug (string, unique)
  - `status` - Active/Inactive toggle (boolean, default: 1)
  - `created_at`, `updated_at` - Timestamps

### 2. Model
**File:** `app/Models/RequestQuoteService.php`
- **Auto-slug Generation:** Automatically generates slug from `nama_service` on create/update using `Str::slug()`
- **Fillable Fields:** nama_service, slug, status
- **Boot Method:** Implements event listeners to auto-generate slug when model is created or updated

### 3. Controller
**File:** `app/Http/Controllers/Admin/RequestQuoteServiceController.php`
- **Methods:**
  - `index()` - List all services with pagination
  - `create()` - Show create form
  - `store(Request $request)` - Save new service with validation
  - `edit(RequestQuoteService $service)` - Show edit form
  - `update(Request $request, RequestQuoteService $service)` - Update existing service
  - `destroy(RequestQuoteService $service)` - Delete service (AJAX)
  - `toggleStatus(RequestQuoteService $service)` - Toggle active/inactive status (AJAX)

**Validation Rules:**
- `nama_service`: required, unique (excluding current record on update)
- `status`: handled via checkbox (boolean)

### 4. Admin Views
**Location:** `resources/views/adminui/request_quote_services/`

#### index.blade.php (Service List)
- Table display with columns: Service Name, Slug, Status, Actions
- **Status Toggle:** Switch component with AJAX for instant status updates
- **Delete Button:** SweetAlert2 confirmation dialog before deletion
- **Empty State:** Shows helpful message with "Add New Service" button when no services exist
- **JavaScript Features:**
  - AJAX toggle status with fetch API
  - CSRF token handling
  - SweetAlert2 for user feedback
  - Dynamic UI updates without page reload

#### create.blade.php (Add New Service)
- Form with nama_service text input (required)
- Status checkbox (default: checked/active)
- Helper text explaining auto-slug generation
- Validation error display
- Success message with SweetAlert2

#### edit.blade.php (Edit Service)
- Pre-filled form with current values
- Disabled slug field showing auto-generated value
- Status checkbox
- Submit and back buttons
- Validation error display

### 5. Routes
**File:** `routes/web.php`
**Prefix:** `/adminui/request-quote/services`
**Middleware:** `check.permission:Dashboard`

```php
Route::get('/services', 'index')->name('services.index');
Route::get('/services/create', 'create')->name('services.create');
Route::post('/services', 'store')->name('services.store');
Route::get('/services/{service}/edit', 'edit')->name('services.edit');
Route::put('/services/{service}', 'update')->name('services.update');
Route::delete('/services/{service}', 'destroy')->name('services.destroy');
Route::post('/services/{service}/toggle-status', 'toggleStatus')->name('services.toggle-status');
```

### 6. Sidebar Navigation
**File:** `resources/views/adminui/layouts/sidebar.blade.php`
- Converted "Request Quote" menu to collapsible submenu
- Added two submenu items:
  - **Settings** - Link to Request Quote settings page
  - **Service List** - Link to service management (NEW)
- Active state detection for proper highlighting

### 7. Frontend Integration
**File:** `app/Http/Controllers/HomeController.php`
- Added `RequestQuoteService` model import
- Fetches active services ordered alphabetically
- Passes `$requestQuoteServices` to home view

**File:** `resources/views/home.blade.php`
- Updated Request Quote form dropdown
- Replaced hardcoded options with dynamic database-driven list
- Uses `@foreach` loop to display services
- Sets value to slug and displays nama_service

### 8. Database Seeder
**File:** `database/seeders/RequestQuoteServiceSeeder.php`
**Default Services (10):**
1. Web Development
2. Mobile App Development
3. Digital Marketing
4. SEO Optimization
5. Business Consulting
6. UI/UX Design
7. E-Commerce Solutions
8. Cloud Services
9. IT Support
10. Other Services

**Run Seeder:**
```bash
php artisan db:seed --class=RequestQuoteServiceSeeder
```

## Usage Guide

### Admin Panel Access
1. Navigate to `/adminui/request-quote/services`
2. Or use sidebar menu: Request Quote → Service List

### Adding a New Service
1. Click "Add New Service" button
2. Enter service name (e.g., "Graphic Design")
3. Check/uncheck status toggle (default: active)
4. Click "Save Service"
5. Slug will be auto-generated (e.g., "graphic-design")

### Editing a Service
1. Click edit icon (pencil) on service row
2. Modify service name
3. Update status if needed
4. Click "Update Service"
5. Slug will auto-update based on new name

### Toggle Service Status
1. Click the switch toggle in Status column
2. Service status updates instantly via AJAX
3. Only active services appear in frontend dropdown

### Deleting a Service
1. Click delete icon (trash) on service row
2. Confirm deletion in SweetAlert2 dialog
3. Service is removed from database

### Frontend Display
- Homepage Request Quote form dropdown shows only active services
- Services ordered alphabetically by name
- Form submits slug value (used for processing)
- If no active services exist, dropdown shows "Select Service" only

## Technical Details

### Auto-Slug Generation Logic
```php
protected static function boot()
{
    parent::boot();
    
    static::creating(function ($service) {
        $service->slug = Str::slug($service->nama_service);
    });
    
    static::updating(function ($service) {
        $service->slug = Str::slug($service->nama_service);
    });
}
```

### AJAX Status Toggle
```javascript
document.querySelectorAll('.status-toggle').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        const serviceId = this.dataset.id;
        fetch(`/adminui/request-quote/services/${serviceId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Status Updated',
                    text: data.message,
                    timer: 1500
                });
            }
        });
    });
});
```

## Migration Commands
```bash
# Run migration
php artisan migrate

# Seed default services
php artisan db:seed --class=RequestQuoteServiceSeeder

# Clear caches (after route/view changes)
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

## File Structure
```
app/
├── Http/
│   └── Controllers/
│       └── Admin/
│           └── RequestQuoteServiceController.php
└── Models/
    └── RequestQuoteService.php

database/
├── migrations/
│   └── 2025_11_05_070749_create_request_quote_services_table.php
└── seeders/
    └── RequestQuoteServiceSeeder.php

resources/
└── views/
    ├── adminui/
    │   ├── layouts/
    │   │   └── sidebar.blade.php (updated)
    │   └── request_quote_services/
    │       ├── index.blade.php
    │       ├── create.blade.php
    │       └── edit.blade.php
    └── home.blade.php (updated)

routes/
└── web.php (7 new routes added)
```

## Benefits
✅ **Dynamic Service Management** - No code changes needed to add/remove services
✅ **User-Friendly Admin UI** - Consistent with existing Soft UI Dashboard design
✅ **AJAX Operations** - Instant updates without page refresh
✅ **Auto-Slug Generation** - SEO-friendly URLs automatically created
✅ **Status Toggle** - Easy enable/disable without deleting services
✅ **Data Validation** - Ensures unique service names
✅ **Scalable** - Easily add unlimited services
✅ **Safe Deletion** - Confirmation dialog prevents accidental deletions

## Testing Checklist
- [ ] Access admin panel at `/adminui/request-quote/services`
- [ ] Create a new service and verify slug generation
- [ ] Edit service and check slug auto-update
- [ ] Toggle status switch and verify AJAX response
- [ ] Delete service with confirmation
- [ ] Check homepage dropdown shows active services only
- [ ] Submit quote form with new service
- [ ] Verify inactive services don't appear in frontend
- [ ] Test empty state when no services exist
- [ ] Check sidebar submenu navigation

## Notes
- Migration successfully run with 10 default services seeded
- All caches cleared after implementation
- Frontend dropdown now uses database services instead of hardcoded values
- Sidebar menu converted to collapsible submenu structure
- Status toggle uses boolean casting (1 = active, 0 = inactive)

## Version History
- **v1.0** (2025-01-05): Initial implementation with full CRUD, AJAX operations, and database seeder
