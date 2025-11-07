@extends('adminui.layouts.auth')

@section('title', 'Header Layanan')

@section('content')
<!-- Header -->
<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <div class="avatar avatar-xl bg-gradient-primary shadow-primary border-radius-lg d-flex align-items-center justify-content-center">
                    <i class="fas fa-heading text-white text-lg opacity-10"></i>
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">Kelola Header Layanan</h5>
                <p class="mb-0 font-weight-bold text-sm">Atur header dan informasi utama halaman Services</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    <form method="POST" action="{{ route('adminui.services.header-layanan') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- SECTION 1: Hero Section (Bagian Atas Halaman) -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="background: linear-gradient(310deg, #2152ff, #21d4fd);">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-md me-3">
                                <i class="ni ni-image text-dark text-lg opacity-10"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Hero Section (Header Halaman Services)</h6>
                                <p class="text-white text-xs mb-0 opacity-8">Bagian paling ATAS halaman dengan background gambar besar</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Posisi:</strong> Bagian ini HANYA untuk Hero Section di paling atas halaman. Untuk Fitur Utama dikelola di menu terpisah.
                        </div>
                        
                        <div class="row">
                            <!-- Gambar Latar Background - DI PALING ATAS -->
                            <div class="col-md-12 mb-4">
                                <label for="gambar_latar" class="form-label fw-bold">
                                    <i class="fas fa-image me-2"></i>Gambar Background Hero Section
                                </label>
                                <input type="file" class="form-control @error('gambar_latar') is-invalid @enderror" 
                                       id="gambar_latar" name="gambar_latar" accept="image/*" onchange="previewImage(event)">
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-info-circle"></i> Ukuran rekomendasi: 1920x600px. Format: JPG, PNG, GIF. Maksimal 2MB
                                </small>
                                @error('gambar_latar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <!-- Preview Area -->
                                <div class="mt-3" id="imagePreviewContainer" @if(!isset($headerLayanan) || !$headerLayanan->gambar_latar) style="display: none;" @endif>
                                    <label class="form-label text-sm fw-bold">Preview Gambar:</label>
                                    <div class="position-relative" style="max-width: 100%; overflow: hidden; border-radius: 0.75rem;">
                                        <img id="imagePreview" 
                                             src="{{ isset($headerLayanan) && $headerLayanan->gambar_latar ? Storage::url($headerLayanan->gambar_latar) : '' }}" 
                                             class="img-fluid border-radius-lg shadow-lg" 
                                             style="width: 100%; height: 300px; object-fit: cover;">
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                                             style="background: rgba(0,0,0,0.3);">
                                            <div class="text-center text-white">
                                                <i class="fas fa-check-circle fa-3x mb-2"></i>
                                                <p class="mb-0 fw-bold">Gambar Background Siap Digunakan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12"><hr class="my-3"></div>

                            <!-- Judul Utama -->
                            <div class="col-md-12 mb-3">
                                <label for="judul_utama" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2"></i>Judul Hero Section
                                </label>
                                <input type="text" class="form-control @error('judul_utama') is-invalid @enderror" 
                                       id="judul_utama" name="judul_utama" 
                                       placeholder="Contoh: Services"
                                       value="{{ old('judul_utama', $headerLayanan->judul_utama ?? '') }}" required>
                                <small class="text-muted">Heading besar yang tampil di hero section. Contoh: <strong>Services</strong></small>
                                @error('judul_utama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Submit -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" 
                                           id="status_aktif" name="status_aktif" 
                                           {{ old('status_aktif', $headerLayanan->status_aktif ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status_aktif">
                                        <i class="fas fa-toggle-on me-2"></i>Aktifkan Header Layanan
                                    </label>
                                    <small class="text-muted d-block">Jika dinonaktifkan, header tidak akan tampil di halaman Services</small>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn bg-gradient-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Simpan Semua Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Info Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                    <ul class="text-sm mb-0">
                        <li>Header Layanan akan ditampilkan di bagian atas halaman Services</li>
                        <li>Gunakan gambar latar yang menarik dengan ukuran minimal 1920x600px</li>
                        <li>Pastikan teks mudah dibaca dengan kontras yang baik terhadap background</li>
                        <li>Main Features menampilkan fitur-fitur utama yang tersedia</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('imagePreviewContainer');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
            
            // Smooth scroll to preview
            setTimeout(() => {
                container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
