@extends('adminui.layouts.auth')

@section('title', 'Tambah Hero')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Tambah Home Hero</h6>
                        <a href="{{ route('adminui.home-hero.index') }}" class="btn btn-outline-secondary btn-sm ms-auto">
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

                    <form action="{{ route('adminui.home-hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Judul -->
                            <div class="col-md-8 mb-3">
                                <label for="judul" class="form-label">Judul Hero <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                       id="judul" name="judul" value="{{ old('judul', $hero->judul) }}" required>
                                @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" 
                                           {{ old('status', $hero->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Aktif</label>
                                </div>
                            </div>

                            <!-- Subjudul -->
                            <div class="col-md-12 mb-3">
                                <label for="subjudul" class="form-label">Subjudul</label>
                                <input type="text" class="form-control @error('subjudul') is-invalid @enderror" 
                                       id="subjudul" name="subjudul" value="{{ old('subjudul', $hero->subjudul) }}">
                                @error('subjudul')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="6">{{ old('deskripsi', $hero->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Background Image -->
                            @if($hero->gambar_background)
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Gambar Background Saat Ini</label>
                                <div>
                                    <img src="{{ asset('storage/' . $hero->gambar_background) }}" 
                                         alt="Current Background" 
                                         class="img-fluid border-radius-lg shadow" 
                                         style="max-height: 300px;">
                                </div>
                            </div>
                            @endif

                            <!-- Gambar Background -->
                            <div class="col-md-8 mb-3">
                                <label for="gambar_background" class="form-label">Upload Gambar Background Baru (Opsional)</label>
                                <input type="file" class="form-control @error('gambar_background') is-invalid @enderror" 
                                       id="gambar_background" name="gambar_background" accept="image/*" onchange="previewImage(event)">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Rekomendasi: 1920x1080px | Kosongkan jika tidak ingin mengubah</small>
                                @error('gambar_background')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Warna Overlay -->
                            <div class="col-md-4 mb-3">
                                <label for="warna_overlay" class="form-label">Warna Overlay Background</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color" 
                                           id="warna_overlay_picker" value="#000000">
                                    <input type="range" class="form-range mx-2" 
                                           id="opacity_slider" min="0" max="100" value="50" style="width: 80px;">
                                    <span id="opacity_value" class="input-group-text">50%</span>
                                </div>
                                <input type="hidden" name="warna_overlay" id="warna_overlay" value="{{ old('warna_overlay', $hero->warna_overlay ?? 'rgba(0, 0, 0, 0.5)') }}">
                                <small class="text-muted">Pilih warna dan opacity untuk overlay di atas gambar background</small>
                            </div>

                            <!-- Preview New Image -->
                            <div class="col-md-12 mb-3" id="imagePreview" style="display: none;">
                                <label class="form-label">Preview Gambar Baru</label>
                                <div>
                                    <img id="previewImg" src="" alt="Preview" 
                                         class="img-fluid border-radius-lg shadow" 
                                         style="max-height: 300px;">
                                </div>
                            </div>

                            <!-- Button Text -->
                            <div class="col-md-6 mb-3">
                                <label for="tombol_text" class="form-label">Button Text</label>
                                <input type="text" class="form-control @error('tombol_text') is-invalid @enderror" 
                                       id="tombol_text" name="tombol_text" value="{{ old('tombol_text', $hero->tombol_text) }}">
                                @error('tombol_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Button Link -->
                            <div class="col-md-6 mb-3">
                                <label for="tombol_link" class="form-label">Button Link</label>
                                <input type="text" class="form-control @error('tombol_link') is-invalid @enderror" 
                                       id="tombol_link" name="tombol_link" value="{{ old('tombol_link', $hero->tombol_link) }}" 
                                       placeholder="https://jasaibnu.com atau /contact">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Bisa URL eksternal (https://jasaibnu.com, https://wa.me/6281234567890) atau internal (/contact, /about)
                                </small>
                                @error('tombol_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn bg-gradient-primary">
                                    <i class="fas fa-save me-2"></i> Update Hero
                                </button>
                                <a href="{{ route('adminui.home-hero.index') }}" class="btn btn-secondary">
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

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
// Initialize CKEditor
let editorInstance;
ClassicEditor
    .create(document.querySelector('#deskripsi'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
    })
    .then(editor => {
        editorInstance = editor;
    })
    .catch(error => {
        console.error(error);
    });

// Form validation before submit
document.querySelector('form').addEventListener('submit', function(e) {
    if (editorInstance) {
        const content = editorInstance.getData().trim();
        if (!content || content === '') {
            e.preventDefault();
            alert('Deskripsi tidak boleh kosong!');
            // Focus on editor
            editorInstance.editing.view.focus();
            return false;
        }
    }
});

// Color Overlay Picker
const colorPicker = document.getElementById('warna_overlay_picker');
const opacitySlider = document.getElementById('opacity_slider');
const opacityValue = document.getElementById('opacity_value');
const warnaOverlay = document.getElementById('warna_overlay');

// Load existing color and opacity
function loadExistingColor() {
    const rgba = warnaOverlay.value;
    const match = rgba.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*([\d.]+))?\)/);
    
    if (match) {
        const r = match[1];
        const g = match[2];
        const b = match[3];
        const a = match[4] || 1;
        
        // Convert RGB to Hex
        const hex = '#' + [r, g, b].map(x => {
            const hex = parseInt(x).toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('');
        
        colorPicker.value = hex;
        opacitySlider.value = Math.round(a * 100);
        opacityValue.textContent = Math.round(a * 100) + '%';
    }
}

loadExistingColor();

function updateOverlayColor() {
    const color = colorPicker.value;
    const opacity = opacitySlider.value / 100;
    
    // Convert hex to RGB
    const r = parseInt(color.substr(1, 2), 16);
    const g = parseInt(color.substr(3, 2), 16);
    const b = parseInt(color.substr(5, 2), 16);
    
    const rgba = `rgba(${r}, ${g}, ${b}, ${opacity})`;
    warnaOverlay.value = rgba;
    opacityValue.textContent = opacitySlider.value + '%';
}

colorPicker.addEventListener('input', updateOverlayColor);
opacitySlider.addEventListener('input', updateOverlayColor);

// Preview Image
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('previewImg');
    const container = document.getElementById('imagePreview');
    
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
@endsection
