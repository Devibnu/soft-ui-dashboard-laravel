@extends('adminui.layouts.auth')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.color-preview {
    width: 50px;
    height: 38px;
    border: 1px solid #ddd;
    border-radius: 4px;
    display: inline-block;
    vertical-align: middle;
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
                                <h6 class="text-white text-capitalize ps-3 mb-0">Request A Quote Settings</h6>
                                <p class="text-white text-xs ps-3 mb-0">Configure the Request Quote section on homepage</p>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.request-quote.messages') }}" class="btn btn-outline-light btn-sm mb-0">
                                    <i class="fas fa-envelope"></i>&nbsp;&nbsp;View Messages
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    @if(session('success'))
                        <div class="alert alert-success text-white">
                            <i class="fas fa-check me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger text-white">
                            <strong>Error!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('adminui.request-quote.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Section Title -->
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">Section Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $setting->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" 
                                           {{ old('status', $setting->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Aktif</label>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="6" required>{{ old('deskripsi', $setting->subtitle) }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Background Image -->
                            @if($setting->bg_image)
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Gambar Background Saat Ini</label>
                                <div>
                                    <img src="{{ asset('storage/' . $setting->bg_image) }}" 
                                         alt="Current Background" 
                                         class="img-fluid border-radius-lg shadow" 
                                         style="max-height: 300px;">
                                </div>
                            </div>
                            @endif

                            <!-- Gambar Background -->
                            <div class="col-md-8 mb-3">
                                <label for="bg_image" class="form-label">Upload Gambar Background Baru (Opsional)</label>
                                <input type="file" class="form-control @error('bg_image') is-invalid @enderror" 
                                       id="bg_image" name="bg_image" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Rekomendasi: 1920x600px | Kosongkan jika tidak ingin mengubah</small>
                                @error('bg_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Warna Overlay -->
                            <div class="col-md-4 mb-3">
                                <label for="overlay_color" class="form-label">Warna Overlay Background</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color" 
                                           id="overlay_color_picker" value="#000000">
                                    <input type="range" class="form-range mx-2" 
                                           id="opacity_slider" min="0" max="100" value="50" style="width: 80px;">
                                    <span id="opacity_value" class="input-group-text">50%</span>
                                </div>
                                <input type="hidden" name="overlay_color" id="overlay_color" value="{{ old('overlay_color', $setting->overlay_color) }}">
                                <small class="text-muted">Pilih warna dan opacity untuk overlay di atas gambar background</small>
                            </div>

                            <!-- Button Text -->
                            <div class="col-md-12 mb-3">
                                <label for="button_text" class="form-label">Button Text <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                                       id="button_text" name="button_text" value="{{ old('button_text', $setting->button_text) }}" required>
                                @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
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
// Color Overlay Picker
const colorPicker = document.getElementById('overlay_color_picker');
const opacitySlider = document.getElementById('opacity_slider');
const opacityValue = document.getElementById('opacity_value');
const overlayColor = document.getElementById('overlay_color');

// Load existing color and opacity
function loadExistingColor() {
    const rgba = overlayColor.value;
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
    overlayColor.value = rgba;
    opacityValue.textContent = opacitySlider.value + '%';
}

colorPicker.addEventListener('input', updateOverlayColor);
opacitySlider.addEventListener('input', updateOverlayColor);
</script>
@endpush
