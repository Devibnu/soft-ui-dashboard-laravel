@extends('adminui.layouts.auth')

@section('title', 'Edit Fitur Utama')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Edit Fitur Utama</h6>
                        <a href="{{ route('adminui.services.fitur-utama.index') }}" class="btn btn-outline-secondary btn-sm ms-auto">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('adminui.services.fitur-utama.update', $fitur->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Judul Fitur -->
                            <div class="col-md-8 mb-3">
                                <label for="judul_fitur" class="form-label">Judul Fitur <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('judul_fitur') is-invalid @enderror" 
                                       id="judul_fitur" name="judul_fitur" 
                                       value="{{ old('judul_fitur', $fitur->judul_fitur) }}" required>
                                @error('judul_fitur')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label for="status_aktif" class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" 
                                           {{ old('status_aktif', $fitur->status_aktif) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_aktif">Aktif</label>
                                </div>
                            </div>

                            <!-- Deskripsi Fitur -->
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_fitur" class="form-label">Deskripsi Fitur <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi_fitur') is-invalid @enderror" 
                                          id="deskripsi_fitur" name="deskripsi_fitur" rows="4" required>{{ old('deskripsi_fitur', $fitur->deskripsi_fitur) }}</textarea>
                                @error('deskripsi_fitur')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Ikon Fitur Saat Ini -->
                            @if($fitur->ikon_fitur)
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ikon Saat Ini</label>
                                <div class="mb-2">
                                    <img src="{{ Storage::url($fitur->ikon_fitur) }}" 
                                         alt="{{ $fitur->judul_fitur }}" 
                                         class="img-fluid border-radius-lg shadow" 
                                         style="max-height: 150px;">
                                </div>
                            </div>
                            @endif

                            <!-- Upload Ikon Baru -->
                            <div class="col-md-12 mb-3">
                                <label for="ikon_fitur" class="form-label">
                                    {{ $fitur->ikon_fitur ? 'Ganti Ikon Fitur' : 'Upload Ikon Fitur' }}
                                </label>
                                <input type="file" class="form-control @error('ikon_fitur') is-invalid @enderror" 
                                       id="ikon_fitur" name="ikon_fitur" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
                                @error('ikon_fitur')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview Image Baru -->
                            <div class="col-md-12 mb-3" id="imagePreview" style="display: none;">
                                <label class="form-label">Preview Ikon Baru</label>
                                <div>
                                    <img id="previewImg" src="" alt="Preview" 
                                         class="img-fluid border-radius-lg shadow" 
                                         style="max-height: 200px;">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn bg-gradient-primary">
                                    <i class="fas fa-save me-2"></i> Update Fitur
                                </button>
                                <a href="{{ route('adminui.services.fitur-utama.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('ikon_fitur').addEventListener('change', function(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection
