@extends('adminui.layouts.auth')

@section('title', 'Upload Favicon')

@push('styles')
<style>
.preview-container {
    width: 150px;
    height: 150px;
    border: 2px dashed #d2d6da;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    overflow: hidden;
}
.preview-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}
.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider {
    background-color: #4CAF50;
}
input:checked + .slider:before {
    transform: translateX(26px);
}
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Edit Favicon</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.favicon.index') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('adminui.favicon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Upload Favicon Baru (Optional) -->
                                <div class="form-group mb-3">
                                    <label for="favicon" class="form-label">Upload Favicon Baru (Opsional)</label>
                                    <input type="file" 
                                           class="form-control @error('favicon') is-invalid @enderror" 
                                           id="favicon" 
                                           name="favicon" 
                                           accept="image/png,image/x-icon,image/jpg,image/jpeg">
                                    @error('favicon')
                                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: PNG, ICO, JPG, JPEG | Max: 2MB | Rekomendasi: 32x32px atau 16x16px | Kosongkan jika tidak ingin mengubah</small>
                                </div>

                                <!-- Status Toggle -->
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label d-block">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" id="status" name="status" value="1" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <span class="ms-2 text-success" id="statusLabel">Aktif</span>
                                    <div>
                                        <small class="text-muted">Set sebagai favicon aktif (hanya 1 favicon yang bisa aktif)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Preview -->
                                <div class="form-group mb-3">
                                    <label class="form-label">Preview Favicon Baru</label>
                                    <div class="preview-container" id="previewContainer" style="width: 150px; height: 150px; border: 2px dashed #d2d6da; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; overflow: hidden;">
                                        @if($favicon->favicon)
                                            <img src="{{ asset('storage/' . $favicon->favicon) }}" alt="Current Favicon" id="previewImage" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        @else
                                            <span class="text-muted">Preview akan muncul di sini</span>
                                        @endif
                                    </div>
                                    <small class="text-muted d-block mt-2">Favicon akan tampil kecil di browser tab. Preview akan update jika Anda upload file baru.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Info Alert -->
                        <div class="alert alert-info text-white mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Tips:</strong> Gunakan gambar persegi dengan ukuran 32x32px atau 16x16px untuk hasil terbaik. Format ICO atau PNG dengan background transparan direkomendasikan.
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('adminui.favicon.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Favicon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const faviconInput = document.getElementById('favicon');
    const previewContainer = document.getElementById('previewContainer');
    const statusToggle = document.getElementById('status');
    const statusLabel = document.getElementById('statusLabel');
    
    // Preview favicon saat dipilih
    if (faviconInput) {
        faviconInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            if (file) {
                // Validasi ukuran file (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    this.value = '';
                    return;
                }
                
                // Validasi tipe file
                const allowedTypes = ['image/png', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/jpg', 'image/jpeg'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung! Gunakan PNG, ICO, JPG, atau JPEG');
                    this.value = '';
                    return;
                }
                
                // Tampilkan loading
                previewContainer.innerHTML = '<span class="text-muted"><i class="fas fa-spinner fa-spin"></i> Loading...</span>';
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Preview" id="previewImage">';
                };
                reader.onerror = function(e) {
                    console.error('Error reading file:', e);
                    alert('Gagal membaca file!');
                    previewContainer.innerHTML = '<span class="text-danger">Gagal memuat preview</span>';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Update status label
    if (statusToggle && statusLabel) {
        statusToggle.addEventListener('change', function() {
            if (this.checked) {
                statusLabel.textContent = 'Aktif';
                statusLabel.classList.remove('text-danger');
                statusLabel.classList.add('text-success');
            } else {
                statusLabel.textContent = 'Non-Aktif';
                statusLabel.classList.remove('text-success');
                statusLabel.classList.add('text-danger');
            }
        });
    }
});
</script>
@endpush
