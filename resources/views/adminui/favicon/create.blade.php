@extends('adminui.layouts.auth')

@section('content')
<style>
    /* Toggle Switch Style */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
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
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    /* Preview Container */
    .preview-container {
        width: 150px;
        height: 150px;
        border: 2px dashed #ddd;
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
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Upload Favicon</h6>
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
                        <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                            <span class="alert-text"><strong>Error!</strong> Ada masalah dengan input Anda:</span>
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
                                <!-- Upload Favicon -->
                                <div class="form-group mb-3">
                                    <label for="favicon" class="form-label">Upload Favicon <span class="text-danger">*</span></label>
                                    <input type="file" 
                                           class="form-control @error('favicon') is-invalid @enderror" 
                                           id="favicon" 
                                           name="favicon" 
                                           accept="image/png,image/x-icon,image/jpg,image/jpeg"
                                           required>
                                    @error('favicon')
                                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: PNG, ICO, JPG, JPEG | Max: 2MB | Rekomendasi: 32x32px atau 16x16px</small>
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
                                    <label class="form-label">Preview Favicon</label>
                                    <div class="preview-container" id="previewContainer">
                                        <span class="text-muted">Preview akan muncul di sini</span>
                                    </div>
                                    <small class="text-muted d-block mt-2">Favicon akan tampil kecil di browser tab</small>
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
                                <i class="fas fa-upload me-1"></i> Upload Favicon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faviconInput = document.getElementById('favicon');
        const previewContainer = document.getElementById('previewContainer');
        const statusCheckbox = document.getElementById('status');
        const statusLabel = document.getElementById('statusLabel');

        // File preview
        faviconInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                // Validate file size (2MB max)
                if (file.size > 2048000) {
                    alert('File terlalu besar! Maksimal 2MB');
                    this.value = '';
                    return;
                }

                // Validate file type
                const validTypes = ['image/png', 'image/x-icon', 'image/jpeg', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak valid! Gunakan PNG, ICO, JPG, atau JPEG');
                    this.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Preview" id="previewImage">';
                };
                reader.readAsDataURL(file);
            }
        });

        // Status toggle
        statusCheckbox.addEventListener('change', function() {
            if (this.checked) {
                statusLabel.textContent = 'Aktif';
                statusLabel.className = 'ms-2 text-success';
            } else {
                statusLabel.textContent = 'Non-Aktif';
                statusLabel.className = 'ms-2 text-secondary';
            }
        });
    });
</script>
@endpush
@endsection