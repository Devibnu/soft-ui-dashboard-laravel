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
                                <h6 class="text-white text-capitalize ps-3">Tambah Header Baru</h6>
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
                    <form method="POST" action="{{ route('adminui.about.headers.store') }}" enctype="multipart/form-data">
                        @csrf
                        
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
                                                       value="{{ old('hero_title') }}"
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
                                                       value="{{ old('breadcrumb_text') }}">
                                            </div>
                                            @error('breadcrumb_text')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Hero Background Image -->
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Gambar Background</label>
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

                                        <!-- Image Preview -->
                                        <div id="imagePreview" class="mt-3" style="display: none;">
                                            <label class="form-label font-weight-bold">Preview:</label>
                                            <div class="border border-2 border-dashed border-primary rounded-lg p-3 text-center">
                                                <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                            </div>
                                        </div>

                                        <!-- Default Preview Placeholder -->
                                        <div id="imagePlaceholder" class="mt-3">
                                            <label class="form-label font-weight-bold">Preview:</label>
                                            <div class="border border-2 border-dashed border-light rounded-lg p-5 text-center">
                                                <i class="ni ni-image text-muted" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0 mt-2">Pilih gambar untuk melihat preview</p>
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
                                                       {{ old('is_active', 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    <span class="text-sm">Aktifkan header ini</span>
                                                </label>
                                            </div>
                                            <small class="text-muted">
                                                Header aktif akan ditampilkan di halaman About.
                                            </small>
                                        </div>

                                        <hr class="horizontal dark my-3">

                                        <!-- Information Card -->
                                        <div class="alert alert-info text-white">
                                            <h6 class="text-white"><i class="ni ni-bulb-61"></i> Tips:</h6>
                                            <ul class="text-sm mb-0">
                                                <li>Judul hero akan ditampilkan besar di halaman</li>
                                                <li>Breadcrumb membantu navigasi pengguna</li>
                                                <li>Gunakan gambar berkualitas tinggi</li>
                                                <li>Pastikan gambar relevan dengan konten</li>
                                            </ul>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn bg-gradient-primary">
                                                <i class="material-icons text-sm">save</i>&nbsp;&nbsp;Simpan Header
                                            </button>
                                            <a href="{{ route('adminui.about.headers.index') }}" class="btn btn-outline-secondary">
                                                <i class="material-icons text-sm">cancel</i>&nbsp;&nbsp;Batal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Guidelines Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Panduan Upload Header</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="icon icon-shape bg-gradient-success shadow mx-auto mb-3">
                                    <i class="ni ni-ruler-pencil text-lg opacity-10"></i>
                                </div>
                                <h6>Resolusi</h6>
                                <p class="text-sm text-muted">1920x800px untuk hasil optimal</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="icon icon-shape bg-gradient-info shadow mx-auto mb-3">
                                    <i class="ni ni-archive-2 text-lg opacity-10"></i>
                                </div>
                                <h6>Format</h6>
                                <p class="text-sm text-muted">JPG, PNG, atau GIF</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="icon icon-shape bg-gradient-warning shadow mx-auto mb-3">
                                    <i class="ni ni-support-16 text-lg opacity-10"></i>
                                </div>
                                <h6>Ukuran File</h6>
                                <p class="text-sm text-muted">Maksimal 2MB per file</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="icon icon-shape bg-gradient-primary shadow mx-auto mb-3">
                                    <i class="ni ni-check-bold text-lg opacity-10"></i>
                                </div>
                                <h6>Kualitas</h6>
                                <p class="text-sm text-muted">Gunakan gambar berkualitas tinggi</p>
                            </div>
                        </div>
                    </div>
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
            document.getElementById('imagePlaceholder').style.display = 'none';
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection