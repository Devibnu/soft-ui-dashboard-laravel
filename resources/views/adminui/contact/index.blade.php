@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Manage Contact Page</h6>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success text-white alert-dismissible fade show m-3" role="alert">
                        <span class="text-sm">{{ session('success') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger text-white alert-dismissible fade show m-3" role="alert">
                        <span class="text-sm"><strong>Error!</strong> {{ session('error') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <div class="card-body">
                    <form id="contactForm" action="{{ route('adminui.contact.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- SECTION 1: INFO PERUSAHAAN -->
                        <div class="alert alert-primary mb-4">
                            <h6 class="mb-2"><i class="fas fa-building me-2"></i><strong>INFORMASI PERUSAHAAN</strong></h6>
                            <small>Data kontak utama yang akan ditampilkan di halaman Contact</small>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul_halaman" class="form-label"><strong>Judul Halaman</strong></label>
                                    <input type="text" class="form-control" id="judul_halaman" name="judul_halaman" 
                                           value="{{ $kontak->judul_halaman ?? 'Contact Us' }}" required>
                                    <small class="text-muted">Contoh: "Contact Us"</small>
                                </div>
                                <div class="mb-3">
                                    <label for="subjudul" class="form-label"><strong>Sub Judul</strong></label>
                                    <input type="text" class="form-control" id="subjudul" name="subjudul" 
                                           value="{{ $kontak->subjudul ?? '' }}">
                                    <small class="text-muted">Contoh: "please do not hesitate to send us a message"</small>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label"><strong>Alamat</strong></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $kontak->alamat ?? '' }}</textarea>
                                    <small class="text-muted">Alamat lengkap perusahaan</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telepon" class="form-label"><strong>Telepon</strong></label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" 
                                           value="{{ $kontak->telepon ?? '' }}" required>
                                    <small class="text-muted">Contoh: "+1 235 2355 98"</small>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label"><strong>Email</strong></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ $kontak->email ?? '' }}" required>
                                    <small class="text-muted">Email kontak perusahaan</small>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_pesan" class="form-label"><strong>Deskripsi Pesan</strong></label>
                                    <textarea class="form-control" id="deskripsi_pesan" name="deskripsi_pesan" rows="3">{{ $kontak->deskripsi_pesan ?? '' }}</textarea>
                                    <small class="text-muted">Teks di atas form kontak (opsional)</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SECTION 2: GOOGLE MAPS & WHATSAPP -->
                        <hr class="my-4">
                        <div class="alert alert-success mb-4">
                            <h6 class="mb-2"><i class="fas fa-map me-2"></i><strong>GOOGLE MAPS & WHATSAPP</strong></h6>
                            <small>Embed Maps dan fitur WhatsApp floating button</small>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="map_embed" class="form-label"><strong>Google Maps Embed Code</strong></label>
                                    <textarea class="form-control" id="map_embed" name="map_embed" rows="4">{{ $kontak->map_embed ?? '' }}</textarea>
                                    <small class="text-muted">Paste code iframe dari Google Maps</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomor_whatsapp" class="form-label"><strong>Nomor WhatsApp</strong></label>
                                    <input type="text" class="form-control" id="nomor_whatsapp" name="nomor_whatsapp" 
                                           value="{{ $kontak->nomor_whatsapp ?? '' }}">
                                    <small class="text-muted">Contoh: "6281234567890" (tanpa +)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="logo_whatsapp" class="form-label"><strong>Logo WhatsApp</strong></label>
                                    <input type="file" class="form-control" id="logo_whatsapp" name="logo_whatsapp" 
                                           accept="image/*" onchange="checkFileSize(this, 0.3)">
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. <strong>Maksimal 300KB</strong>.</small>
                                    <div class="invalid-feedback" id="logo_whatsapp_error"></div>
                                    
                                    @if($kontak && $kontak->logo_whatsapp)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($kontak->logo_whatsapp) }}" 
                                                 alt="WhatsApp Logo" class="img-thumbnail" style="max-width: 100px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status dan Submit -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" 
                                               {{ ($kontak->status_aktif ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_aktif">
                                            <strong>Status Aktif</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn bg-gradient-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save Contact Data
                        </button>
                        
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Data akan otomatis tersimpan setiap 5 detik
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-save functionality
let autoSaveTimeout;
let isFormChanged = false;

// Function to check file size before upload
function checkFileSize(input, maxSizeMB) {
    const file = input.files[0];
    const errorDiv = document.getElementById(input.id + '_error');
    
    if (file) {
        const fileSizeKB = file.size / 1024;
        const fileSizeMB = file.size / (1024 * 1024);
        
        if (fileSizeMB > maxSizeMB) {
            input.classList.add('is-invalid');
            const maxKB = maxSizeMB * 1024;
            errorDiv.textContent = `File terlalu besar! Maksimal ${maxKB}KB. Ukuran file Anda: ${fileSizeKB.toFixed(0)}KB. Silakan compress gambar terlebih dahulu.`;
            errorDiv.style.display = 'block';
            input.value = ''; // Clear the file input
            
            // Show suggestion for compression
            setTimeout(() => {
                alert('Tips: Gunakan tools online seperti tinypng.com atau compressor.io untuk mengecilkan ukuran gambar.');
            }, 500);
            
            return false;
        } else {
            input.classList.remove('is-invalid');
            errorDiv.style.display = 'none';
            return true;
        }
    }
}

// Track form changes for auto-save
document.getElementById('contactForm').addEventListener('input', function() {
    isFormChanged = true;
    clearTimeout(autoSaveTimeout);
    autoSaveTimeout = setTimeout(autoSave, 5000); // Auto-save after 5 seconds
});

// Auto-save function
function autoSave() {
    if (!isFormChanged) return;
    
    const form = document.getElementById('contactForm');
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show subtle notification
            showNotification('Data tersimpan otomatis', 'success');
            isFormChanged = false;
        }
    })
    .catch(error => {
        console.error('Auto-save error:', error);
    });
}

// Notification function
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
    notification.innerHTML = `
        <small><i class="fas fa-check-circle me-1"></i>${message}</small>
    `;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// SweetAlert2 for form submission
document.getElementById('contactForm').addEventListener('submit', function(e) {
    if (e.target.querySelector('[type="submit"]').contains(e.submitter)) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Simpan Data?',
            text: 'Data kontak akan disimpan dan ditampilkan di halaman frontend.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    }
});
</script>
@endsection
