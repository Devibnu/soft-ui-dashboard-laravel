@extends('adminui.layouts.auth')

@section('title', 'Header Fitur Utama')

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
                    <i class="fas fa-star text-white text-lg opacity-10"></i>
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">Kelola Header Fitur Utama</h5>
                <p class="mb-0 font-weight-bold text-sm">Atur header section "Fitur Utama Kami" dan CTA Box</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
            <span class="alert-text">
                <strong>Validation Error!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
            <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ route('adminui.services.header-fitur-utama') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- SECTION 1: Header Section (Judul "Fitur Utama Kami") -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="background: linear-gradient(310deg, #2152ff, #21d4fd);">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-md me-3">
                                <i class="fas fa-heading text-dark text-lg opacity-10"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Header Section - Fitur Utama Kami</h6>
                                <p class="text-white text-xs mb-0 opacity-8">Judul dan deskripsi section sebelah kiri</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Keterangan:</strong> Bagian ini adalah judul besar "Fitur Utama Kami" beserta deskripsi yang ada di sebelah kiri (di samping gambar CTA).
                        </div>
                        
                        <div class="row">
                            <!-- Judul Section -->
                            <div class="col-md-12 mb-3">
                                <label for="judul_section" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2"></i>Judul Section <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('judul_section') is-invalid @enderror" 
                                       id="judul_section" name="judul_section" 
                                       placeholder="Contoh: Our Main Features"
                                       value="{{ old('judul_section', $headerFiturUtama->judul_section ?? 'Our Main Features') }}" required>
                                <small class="text-muted">Heading besar di atas detail fitur. Contoh: <strong>Our Main Features</strong></small>
                                @error('judul_section')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi Section -->
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_section" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2"></i>Deskripsi Section <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('deskripsi_section') is-invalid @enderror" 
                                          id="deskripsi_section" name="deskripsi_section" rows="3" required 
                                          placeholder="Deskripsi singkat tentang fitur-fitur utama">{{ old('deskripsi_section', $headerFiturUtama->deskripsi_section ?? 'Kami menyediakan berbagai layanan berkualitas tinggi dengan teknologi terdepan dan tim berpengalaman untuk membantu mengembangkan bisnis Anda.') }}</textarea>
                                <small class="text-muted">Deskripsi yang tampil di bawah judul section</small>
                                @error('deskripsi_section')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: CTA Box (Success Story Box di Kanan) -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="background: linear-gradient(310deg, #17ad37, #21d4fd);">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-md me-3">
                                <i class="fas fa-image text-success text-lg opacity-10"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">CTA Box (Call to Action) - Box Sebelah Kanan</h6>
                                <p class="text-white text-xs mb-0 opacity-8">Gambar, judul, deskripsi dan button di sebelah kanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Keterangan:</strong> Ini adalah box dengan gambar di sebelah KANAN yang berisi "Read Our Success Story for Inspiration" dengan tombol Contact us.
                        </div>
                        
                        <div class="row">
                            <!-- Gambar CTA -->
                            <div class="col-md-12 mb-4">
                                <label for="gambar_cta" class="form-label fw-bold">
                                    <i class="fas fa-image me-2"></i>Gambar CTA Box
                                </label>
                                <input type="file" class="form-control @error('gambar_cta') is-invalid @enderror" 
                                       id="gambar_cta" name="gambar_cta" accept="image/*" onchange="previewCtaImage(event)">
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-info-circle"></i> Ukuran rekomendasi: 600x400px. Format: JPG, PNG, GIF. Maksimal 2MB
                                </small>
                                @error('gambar_cta')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <!-- Preview Area -->
                                <div class="mt-3" id="ctaImagePreviewContainer" @if(!isset($headerFiturUtama) || !$headerFiturUtama->gambar_cta) style="display: none;" @endif>
                                    <label class="form-label text-sm fw-bold">Preview Gambar CTA:</label>
                                    <div class="position-relative" style="max-width: 500px; overflow: hidden; border-radius: 0.75rem;">
                                        <img id="ctaImagePreview" 
                                             src="{{ isset($headerFiturUtama) && $headerFiturUtama->gambar_cta ? Storage::url($headerFiturUtama->gambar_cta) : '' }}" 
                                             class="img-fluid border-radius-lg shadow-lg" 
                                             style="width: 100%; height: 300px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12"><hr class="my-3"></div>

                            <!-- Judul CTA -->
                            <div class="col-md-12 mb-3">
                                <label for="judul_cta" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2"></i>Judul CTA Box <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('judul_cta') is-invalid @enderror" 
                                       id="judul_cta" name="judul_cta" 
                                       placeholder="Contoh: Read Our Success Story for Inspiration"
                                       value="{{ old('judul_cta', $headerFiturUtama->judul_cta ?? 'Read Our Success Story for Inspiration') }}" required>
                                <small class="text-muted">Judul yang tampil di dalam box CTA</small>
                                @error('judul_cta')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi CTA -->
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_cta" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2"></i>Deskripsi CTA Box <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('deskripsi_cta') is-invalid @enderror" 
                                          id="deskripsi_cta" name="deskripsi_cta" rows="4" required 
                                          placeholder="Deskripsi menarik untuk mengajak visitor melakukan aksi">{{ old('deskripsi_cta', $headerFiturUtama->deskripsi_cta ?? 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.') }}</textarea>
                                <small class="text-muted">Deskripsi yang tampil di dalam box CTA, di bawah judul</small>
                                @error('deskripsi_cta')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12"><hr class="my-3"></div>

                            <!-- Button Text -->
                            <div class="col-md-6 mb-3">
                                <label for="button_text" class="form-label fw-bold">
                                    <i class="fas fa-hand-pointer me-2"></i>Text Button <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                                       id="button_text" name="button_text" 
                                       placeholder="Contoh: Contact us"
                                       value="{{ old('button_text', $headerFiturUtama->button_text ?? 'Contact us') }}" required>
                                <small class="text-muted">Text yang tampil pada button CTA</small>
                                @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Button URL -->
                            <div class="col-md-6 mb-3">
                                <label for="button_url" class="form-label fw-bold">
                                    <i class="fas fa-link me-2"></i>URL Button <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('button_url') is-invalid @enderror" 
                                       id="button_url" name="button_url" 
                                       placeholder="Contoh: /contact atau https://..."
                                       value="{{ old('button_url', $headerFiturUtama->button_url ?? '/contact') }}" required>
                                <small class="text-muted">URL tujuan ketika button diklik. Bisa menggunakan path relatif (/contact) atau URL lengkap</small>
                                @error('button_url')
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
                                           {{ old('status_aktif', $headerFiturUtama->status_aktif ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status_aktif">
                                        <i class="fas fa-toggle-on me-2"></i>Aktifkan Header Fitur Utama
                                    </label>
                                    <small class="text-muted d-block">Jika dinonaktifkan, section ini tidak akan tampil di halaman Services</small>
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
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Informasi Penting</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-sm font-weight-bold">📌 Layout di Frontend:</h6>
                            <ul class="text-sm mb-3">
                                <li><strong>Sebelah Kiri:</strong> Judul Section + Deskripsi + Detail Fitur (dikelola di menu "Detail Fitur")</li>
                                <li><strong>Sebelah Kanan:</strong> CTA Box (Gambar + Judul + Deskripsi + Button)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-sm font-weight-bold">💡 Tips:</h6>
                            <ul class="text-sm mb-0">
                                <li>Gunakan gambar CTA yang menarik dan relevan</li>
                                <li>Buat judul dan deskripsi yang mengajak visitor untuk action</li>
                                <li>Pastikan button URL valid (bisa cek dengan klik button di frontend)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function previewCtaImage(event) {
    const input = event.target;
    const preview = document.getElementById('ctaImagePreview');
    const container = document.getElementById('ctaImagePreviewContainer');
    
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
