@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Edit Header #{{ $header->id }}</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.about.headers.index') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <!-- Form -->
                    <form method="POST" action="{{ route('adminui.about.headers.update', $header) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Left Column - Header Info -->
                            <div class="col-md-8">
                                <div class="card border">
                                    <div class="card-header bg-transparent">
                                        <h6 class="mb-0">Informasi Header</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- Hero Title -->
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Judul Hero <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="text" 
                                                       name="hero_title" 
                                                       class="form-control border px-3" 
                                                       placeholder="Contoh: Tentang Kami" 
                                                       value="{{ old('hero_title', $header->hero_title) }}"
                                                       required>
                                            </div>
                                            @error('hero_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Breadcrumb Text -->
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Teks Breadcrumb</label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="text" 
                                                       name="breadcrumb_text" 
                                                       class="form-control border px-3" 
                                                       placeholder="Contoh: Home / About Us" 
                                                       value="{{ old('breadcrumb_text', $header->breadcrumb_text) }}">
                                            </div>
                                            @error('breadcrumb_text')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Current Background Image -->
                                        @if($header->hero_background)
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Gambar Background Saat Ini:</label>
                                            <div class="border border-2 border-primary rounded-lg p-3 text-center">
                                                <img src="{{ Storage::url($header->hero_background) }}" alt="Current Background" class="img-fluid rounded" style="max-height: 300px;">
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Hero Background Image -->
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">
                                                {{ $header->hero_background ? 'Ganti Gambar Background (Opsional)' : 'Upload Gambar Background' }}
                                            </label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="file" 
                                                       name="hero_background" 
                                                       class="form-control border px-3" 
                                                       accept="image/*"
                                                       onchange="previewImage(this)">
                                            </div>
                                            <small class="text-muted">
                                                <strong>Format:</strong> JPG, PNG | 
                                                <strong>Ukuran maksimal:</strong> 2MB | 
                                                <strong>Resolusi optimal:</strong> 1920x800px
                                            </small>
                                            @error('hero_background')
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- New Image Preview -->
                                        <div id="imagePreview" class="mt-3" style="display: none;">
                                            <label class="form-label font-weight-bold">Preview Gambar Baru:</label>
                                            <div class="border border-2 border-dashed border-success rounded-lg p-3 text-center">
                                                <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Section -->
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-header bg-transparent">
                                        <h6 class="mb-0">Pengaturan</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- Status Toggle -->
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="is_active" 
                                                       id="is_active" 
                                                       value="1"
                                                       {{ old('is_active', $header->is_active ?? 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    <span class="text-sm">Aktifkan header ini</span>
                                                </label>
                                            </div>
                                            <small class="text-muted">
                                                Header aktif akan ditampilkan di halaman About.
                                            </small>
                                        </div>

                                        <hr class="horizontal dark my-3">

                                        <!-- Header Info -->
                                        <div class="alert alert-light border">
                                            <h6><i class="ni ni-info"></i> Informasi Header:</h6>
                                            <ul class="text-sm mb-0">
                                                <li><strong>ID:</strong> #{{ $header->id }}</li>
                                                <li><strong>Dibuat:</strong> {{ $header->created_at->format('d M Y H:i') }}</li>
                                                <li><strong>Diupdate:</strong> {{ $header->updated_at->format('d M Y H:i') }}</li>
                                                <li><strong>Status:</strong> 
                                                    <span class="badge badge-sm {{ ($header->is_active ?? 1) ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                        {{ ($header->is_active ?? 1) ? 'Aktif' : 'Non-Aktif' }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn bg-gradient-primary">
                                                <i class="material-icons text-sm">save</i>&nbsp;&nbsp;Update Header
                                            </button>
                                            <a href="{{ route('adminui.about.headers.index') }}" class="btn btn-outline-secondary">
                                                <i class="material-icons text-sm">cancel</i>&nbsp;&nbsp;Batal
                                            </a>
                                            
                                            <!-- Delete Button (moved out of main form to avoid nested form issues) -->
                                            <div class="border-top pt-3 mt-3">
                                                <button id="deleteHeaderBtn" type="button" class="btn btn-outline-danger btn-sm w-100">
                                                    <i class="material-icons text-sm">delete</i>&nbsp;&nbsp;Hapus Header
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Actual delete form moved outside the update form to prevent nested form inputs altering request method -->
                    <form id="deleteHeaderForm" method="POST" action="{{ route('adminui.about.headers.delete', $header) }}" onsubmit="return confirm('Are you sure you want to delete this header? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Hook delete button to submit the standalone delete form (prevents nested form issues)
document.addEventListener('DOMContentLoaded', function () {
    var delBtn = document.getElementById('deleteHeaderBtn');
    if (delBtn) {
        delBtn.addEventListener('click', function () {
            var form = document.getElementById('deleteHeaderForm');
            if (form) {
                if (confirm('Are you sure you want to delete this header? This action cannot be undone.')) {
                    form.submit();
                }
            }
        });
    }
});
</script>
@endsection