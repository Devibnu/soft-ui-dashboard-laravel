@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Header Blog Section</h6>
                        <p class="text-xs text-white ps-3 mb-0 opacity-8">Kelola judul dan deskripsi yang ditampilkan di bagian blog homepage</p>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible text-white font-weight-bold fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible text-white font-weight-bold fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('adminui.blog.header.update') }}" class="mt-4">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="judul_section" class="form-label">Judul Section <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('judul_section') is-invalid @enderror" 
                                       id="judul_section" 
                                       name="judul_section" 
                                       value="{{ old('judul_section', $headerBlog->judul_section ?? 'Recent Blog') }}"
                                       placeholder="e.g., Recent Blog">
                                @error('judul_section')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Judul yang akan ditampilkan di section blog homepage</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_section" class="form-label">Deskripsi Section <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi_section') is-invalid @enderror" 
                                          id="deskripsi_section" 
                                          name="deskripsi_section" 
                                          rows="3"
                                          placeholder="e.g., Stay updated with our latest insights, tips, and industry news.">{{ old('deskripsi_section', $headerBlog->deskripsi_section ?? 'Stay updated with our latest insights, tips, and industry news.') }}</textarea>
                                @error('deskripsi_section')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Deskripsi singkat yang akan ditampilkan di bawah judul section</small>
                            </div>

                            <div class="col-md-12 mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="status_aktif" 
                                           name="status_aktif"
                                           {{ old('status_aktif', $headerBlog->status_aktif ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_aktif">Status Aktif</label>
                                </div>
                                <small class="form-text text-muted">Aktifkan untuk menampilkan header blog di homepage</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-primary mb-0">
                                    <i class="fas fa-save me-2"></i>Simpan Header Blog
                                </button>
                                <a href="{{ route('adminui.blog.index') }}" class="btn btn-outline-secondary mb-0">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Blog
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">Preview Header Blog</h6>
                    <p class="text-sm mb-0">Ini adalah tampilan header blog section di homepage</p>
                </div>
                <div class="card-body p-3">
                    <div class="text-center py-4">
                        <h2 class="mb-3" id="preview-title">{{ $headerBlog->judul_section ?? 'Recent Blog' }}</h2>
                        <p class="text-muted mb-0" id="preview-desc">{{ $headerBlog->deskripsi_section ?? 'Stay updated with our latest insights, tips, and industry news.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
// Live preview
document.addEventListener('DOMContentLoaded', function() {
    const judulInput = document.getElementById('judul_section');
    const deskripsiInput = document.getElementById('deskripsi_section');
    const previewTitle = document.getElementById('preview-title');
    const previewDesc = document.getElementById('preview-desc');
    
    if (judulInput && previewTitle) {
        judulInput.addEventListener('input', function(e) {
            previewTitle.textContent = e.target.value || 'Recent Blog';
        });
    }
    
    if (deskripsiInput && previewDesc) {
        deskripsiInput.addEventListener('input', function(e) {
            previewDesc.textContent = e.target.value || 'Stay updated with our latest insights, tips, and industry news.';
        });
    }
});
</script>
@endpush
