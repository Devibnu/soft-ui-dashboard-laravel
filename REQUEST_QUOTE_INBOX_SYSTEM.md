# Request Quote Inbox System Documentation

## Overview
Sistem inbox admin lengkap untuk menerima, mengelola, dan membalas pesan Request Quote dari customer. Admin dapat melihat pesan masuk, mengubah status, membalas via email atau WhatsApp, dan menghapus pesan.

## Features Implemented

### 1. Database Structure
**Migration:** `2025_11_05_073605_create_request_quote_inbox_table.php`
- **Table:** `request_quote_inbox`
- **Columns:**
  - `id` - Primary key (auto-increment)
  - `nama_depan` - First name (string, required)
  - `nama_belakang` - Last name (string, required)
  - `email` - Email address (string, required)
  - `nomor_telepon` - Phone number (string, required)
  - `service_slug` - Service slug (string, foreign key to request_quote_services.slug)
  - `pesan` - Message content (text, required)
  - `status` - Status enum('baru','dibaca','selesai'), default: 'baru'
  - `created_at`, `updated_at` - Timestamps

**Foreign Key:**
- `service_slug` references `request_quote_services.slug` with cascade delete

### 2. Model
**File:** `app/Models/RequestQuoteInbox.php`

**Fillable Fields:**
- nama_depan, nama_belakang, email, nomor_telepon, service_slug, pesan, status

**Relationships:**
- `service()` - BelongsTo relationship with RequestQuoteService

**Accessors:**
- `full_name` - Returns concatenated first name + last name
- `status_badge` - Returns Bootstrap badge color based on status:
  - 'baru' → 'danger' (red)
  - 'dibaca' → 'warning' (yellow)
  - 'selesai' → 'success' (green)

### 3. Controller
**File:** `app/Http/Controllers/Admin/RequestQuoteInboxController.php`

**Methods:**

#### index(Request $request)
- List all inbox messages with pagination (10 per page)
- **Search:** nama_depan, nama_belakang, email, nomor_telepon
- **Filter:** status (baru, dibaca, selesai)
- **Status Count:** Shows count for each status in tabs
- **Returns:** adminui.request_quote_inbox.index view

#### show($id)
- Display detailed message information
- **Auto Mark as Read:** Changes status from 'baru' to 'dibaca' automatically
- **Returns:** adminui.request_quote_inbox.show view

#### updateStatus(Request $request, $id)
- AJAX endpoint to update message status
- **Validation:** status must be 'baru', 'dibaca', or 'selesai'
- **Response:** JSON with success status, message, and badge color

#### replyEmail(Request $request, $id)
- Send email reply to customer
- **Validation:** reply_message required
- **Email Template:** emails.quote_reply
- **Auto Update Status:** Sets status to 'selesai' after sending
- **Response:** JSON with success/error message

#### replyWhatsapp(Request $request, $id)
- Generate WhatsApp reply link
- **Phone Formatting:** Converts to international format (+62)
- **Auto Update Status:** Sets status to 'selesai'
- **Response:** JSON with WhatsApp URL

#### destroy($id)
- Delete message from inbox
- **Response:** JSON with success message

### 4. Admin Views

#### index.blade.php (Inbox List)
**Location:** `resources/views/adminui/request_quote_inbox/index.blade.php`

**Features:**
- **Status Filter Tabs:** Semua, Baru, Dibaca, Selesai with count badges
- **Search Bar:** Real-time search by name, email, or phone
- **Table Columns:**
  - Nama Lengkap
  - Service (from relationship)
  - Email (mailto link)
  - Telepon (tel link)
  - Status (colored badge)
  - Tanggal (human readable + formatted date)
  - Aksi (View, Delete buttons)
- **Empty State:** Friendly message when no messages found
- **Pagination:** Laravel pagination links
- **JavaScript:**
  - SweetAlert2 delete confirmation
  - AJAX delete with auto-reload

#### show.blade.php (Message Detail)
**Location:** `resources/views/adminui/request_quote_inbox/show.blade.php`

**Features:**
- **Customer Information Card:**
  - Full name, email, phone, service
  - Clickable email and phone links
- **Status & Date Card:**
  - Current status badge
  - Received date (formatted + relative)
  - Status dropdown for quick update
- **Message Content Card:**
  - Full message display with preserved line breaks
- **Reply Actions Card:**
  - Textarea for reply message
  - "Balas via Email" button (sends email + marks selesai)
  - "Balas via WhatsApp" button (opens WhatsApp + marks selesai)
- **JavaScript:**
  - AJAX status update with badge refresh
  - Email send with SweetAlert confirmation
  - WhatsApp link generation

### 5. Routes
**File:** `routes/web.php`
**Prefix:** `/adminui/request-quote/inbox`
**Middleware:** `check.permission:Dashboard`

```php
Route::get('/', 'index')->name('inbox.index');
Route::get('/{id}', 'show')->name('inbox.show');
Route::post('/{id}/update-status', 'updateStatus')->name('inbox.update-status');
Route::post('/{id}/reply-email', 'replyEmail')->name('inbox.reply-email');
Route::post('/{id}/reply-whatsapp', 'replyWhatsapp')->name('inbox.reply-whatsapp');
Route::delete('/{id}', 'destroy')->name('inbox.destroy');
```

### 6. Sidebar Navigation
**File:** `resources/views/adminui/layouts/sidebar.blade.php`

**Structure:**
```
Request Quote (collapsible)
├── Settings
├── Inbox Messages (NEW)
└── Service List
```

**Active State Detection:**
- Highlights parent menu when any submenu is active
- Expands/collapses based on current route

### 7. Frontend Form Integration
**File:** `resources/views/home.blade.php`

**Changes:**
- Added email field (required)
- Reorganized form layout:
  - Row 1: First Name, Last Name
  - Row 2: Email, Phone
  - Row 3: Service dropdown, Message textarea
  - Row 4: Submit button

**JavaScript Updates:**
- Added email to formData object
- Submits to existing `/request-quote/send` route

**File:** `app/Http/Controllers/Admin/RequestQuoteController.php`

**submitQuote() Method Updates:**
- Added email validation: `'email' => 'required|email|max:100'`
- Saves to both tables:
  1. `request_quote_messages` (old table - backward compatibility)
  2. `request_quote_inbox` (new table - main inbox system)
- Maps form fields to inbox table columns

### 8. Email Template
**File:** `resources/views/emails/quote_reply.blade.php`

**Design:**
- Responsive HTML email template
- Gradient header with JasaIbnu branding
- Reply message section
- Original request info display
- Call-to-action button
- Footer with company info

**Variables:**
- `$customerName` - Customer full name
- `$replyMessage` - Admin's reply content
- `$originalMessage` - Customer's original message
- `$service` - Service name

## Usage Guide

### Access Admin Inbox
1. Navigate to `/adminui/request-quote/inbox`
2. Or use sidebar: Request Quote → Inbox Messages

### View Messages
1. **Filter by Status:** Click tabs (Semua, Baru, Dibaca, Selesai)
2. **Search:** Enter name, email, or phone in search box
3. **View Details:** Click eye icon on any message

### Manage Message Status
**Auto Status Update:**
- Opening a new message automatically changes status to "Dibaca"

**Manual Status Update:**
- In message detail page, use status dropdown
- Changes are saved instantly via AJAX

### Reply to Customer

#### Via Email:
1. Open message detail page
2. Type reply in textarea
3. Click "Balas via Email"
4. Confirm in popup dialog
5. Email is sent using Laravel Mail
6. Status automatically set to "Selesai"

#### Via WhatsApp:
1. Open message detail page
2. Type reply in textarea
3. Click "Balas via WhatsApp"
4. WhatsApp web/app opens in new tab with pre-filled message
5. Status automatically set to "Selesai"

### Delete Message
1. In inbox list, click trash icon
2. Confirm deletion in SweetAlert dialog
3. Message is permanently removed

## Technical Details

### WhatsApp Link Generation
```php
// Clean phone number
$phone = preg_replace('/[^0-9]/', '', $nomor_telepon);

// Convert to international format (Indonesia +62)
if (substr($phone, 0, 1) === '0') {
    $phone = '62' . substr($phone, 1);
}

// Generate link
$url = "https://wa.me/{$phone}?text=" . urlencode($message);
```

### Status Badge Colors
```php
[
    'baru' => 'danger',    // Red badge
    'dibaca' => 'warning', // Yellow badge
    'selesai' => 'success' // Green badge
]
```

### Email Configuration
**Required .env Settings:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="JasaIbnu"
```

## Database Queries

### Get All New Messages:
```php
RequestQuoteInbox::where('status', 'baru')->get();
```

### Get Messages with Service Info:
```php
RequestQuoteInbox::with('service')->get();
```

### Search Messages:
```php
RequestQuoteInbox::where('nama_depan', 'like', "%{$search}%")
    ->orWhere('email', 'like', "%{$search}%")
    ->get();
```

### Count by Status:
```php
$counts = [
    'baru' => RequestQuoteInbox::where('status', 'baru')->count(),
    'dibaca' => RequestQuoteInbox::where('status', 'dibaca')->count(),
    'selesai' => RequestQuoteInbox::where('status', 'selesai')->count(),
];
```

## Testing Checklist

- [ ] Submit quote from homepage → Check if saved in inbox with status 'baru'
- [ ] Access `/adminui/request-quote/inbox` → Verify message appears in list
- [ ] Click eye icon → Verify detail page loads and status changes to 'dibaca'
- [ ] Change status dropdown → Verify AJAX updates status
- [ ] Filter by status tabs → Verify correct messages displayed
- [ ] Search by name/email → Verify search works
- [ ] Reply via email (configure MAIL settings first) → Verify email sent
- [ ] Reply via WhatsApp → Verify link opens correctly with formatted phone
- [ ] Delete message → Verify deletion works with confirmation
- [ ] Check pagination → Verify works with >10 messages
- [ ] Check sidebar submenu → Verify "Inbox Messages" appears and works

## Integration Notes

### Backward Compatibility
- Old `request_quote_messages` table still receives data
- Both tables are populated on form submission
- No breaking changes to existing functionality

### Service Integration
- Form now uses database services from `request_quote_services`
- Service slug is stored (not service name)
- Relationship allows easy access to service details

### Frontend Changes
- Email field added to form (required)
- Form layout reorganized for better UX
- All changes maintain existing styling

## File Structure
```
app/
├── Http/
│   └── Controllers/
│       └── Admin/
│           ├── RequestQuoteController.php (updated)
│           └── RequestQuoteInboxController.php (new)
└── Models/
    └── RequestQuoteInbox.php (new)

database/
└── migrations/
    └── 2025_11_05_073605_create_request_quote_inbox_table.php (new)

resources/
└── views/
    ├── adminui/
    │   ├── layouts/
    │   │   └── sidebar.blade.php (updated)
    │   └── request_quote_inbox/
    │       ├── index.blade.php (new)
    │       └── show.blade.php (new)
    ├── emails/
    │   └── quote_reply.blade.php (new)
    └── home.blade.php (updated)

routes/
└── web.php (6 new routes added)
```

## Security Features
- CSRF token protection on all forms
- Input validation on all submissions
- Email validation for email field
- Permission middleware on all admin routes
- SweetAlert confirmation before deletions
- SQL injection protection via Eloquent ORM

## Performance Considerations
- Pagination (10 items per page)
- Eager loading service relationship (with('service'))
- Indexed foreign key on service_slug
- Database query optimization with where clauses

## Future Enhancements (Optional)
- Email queue for better performance
- SMS notification option
- Export messages to CSV/Excel
- Bulk actions (mark multiple as read, delete multiple)
- Internal notes for admins
- Assign messages to specific admin users
- Email templates management in admin
- Automated responses based on service type
- Integration with CRM systems

## Version History
- **v1.0** (2025-11-05): Initial implementation
  - Complete inbox system
  - Email & WhatsApp reply functionality
  - Status management
  - Search & filter
  - Admin UI with Soft UI Dashboard theme

## Support
For issues or questions, contact: admin@jasaibnu.com
