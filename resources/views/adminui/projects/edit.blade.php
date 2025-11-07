@extends('adminui.layouts.auth')

@section('title', 'Edit Project')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Edit Project: {{ $project->judul }}</h6>
                        <a href="{{ route('adminui.projects.index') }}" class="btn btn-outline-secondary btn-sm ms-auto">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
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

                    <form action="{{ route('adminui.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Judul Project -->
                            <div class="col-md-8 mb-3">
                                <label for="judul" class="form-label">Judul Project <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul" name="judul" 
                                       value="{{ old('judul', $project->judul) }}" required>
                                <small class="text-muted">Current slug: {{ $project->slug }}</small>
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-4 mb-3">
                                <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" id="kategori_id" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $project->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">
                                    Belum ada kategori? <a href="{{ route('adminui.kategori-project.index') }}" target="_blank">Tambahkan kategori</a>
                                </small>
                            </div>

                            <!-- Deskripsi Singkat -->
                            <div class="col-12 mb-3">
                                <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" 
                                          rows="3" required>{{ old('deskripsi_singkat', $project->deskripsi_singkat) }}</textarea>
                            </div>

                            <!-- Deskripsi Lengkap dengan CKEditor -->
                            <div class="col-12 mb-3">
                                <label for="deskripsi_lengkap" class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi_lengkap" name="deskripsi_lengkap" 
                                          rows="10">{{ old('deskripsi_lengkap', $project->deskripsi_lengkap) }}</textarea>
                            </div>

                            <!-- Gambar Utama -->
                            <div class="col-md-6 mb-3">
                                <label for="gambar_utama" class="form-label">Gambar Utama</label>
                                <input type="file" class="form-control" id="gambar_utama" name="gambar_utama" 
                                       accept="image/*" onchange="previewMainImage(event)">
                                <small class="text-muted">Format: JPG, PNG. Max: 2MB. Kosongkan jika tidak ingin mengubah</small>
                                <div class="mt-2">
                                    @if($project->gambar_utama)
                                        <img id="preview_gambar_utama" 
                                             src="{{ asset('storage/' . $project->gambar_utama) }}" 
                                             alt="Current Image" 
                                             class="img-thumbnail" 
                                             style="max-width: 300px;">
                                    @else
                                        <img id="preview_gambar_utama" src="" alt="Preview" 
                                             style="max-width: 300px; display: none;" class="img-thumbnail">
                                    @endif
                                </div>
                            </div>

                            <!-- Add New Gallery Images -->
                            <div class="col-md-12 mb-3">
                                <label for="galeri" class="form-label">Tambah Gambar ke Galeri <span class="badge badge-info">Multiple Upload</span></label>
                                <input type="file" class="form-control" id="galeri" name="galeri[]" 
                                       accept="image/*" multiple onchange="previewGallery(event)">
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-info-circle"></i> Tekan Ctrl/Cmd saat memilih file untuk upload multiple gambar sekaligus. Gambar baru akan ditambahkan ke galeri yang sudah ada.
                                </small>
                                <div id="preview_galeri" class="mt-3 row g-2"></div>
                            </div>

                            <!-- Existing Gallery -->
                            @if($project->galeri && is_array($project->galeri) && count($project->galeri) > 0)
                                <div class="col-12 mb-3">
                                    <label class="form-label">Galeri Saat Ini ({{ count($project->galeri) }} gambar)</label>
                                    <div class="row g-3">
                                        @foreach($project->galeri as $index => $image)
                                            <div class="col-md-3 col-sm-4 col-6">
                                                <div class="card shadow-sm" id="gallery_card_{{ $index }}">
                                                    <img src="{{ asset('storage/' . $image) }}" 
                                                         class="card-img-top" 
                                                         style="height: 200px; object-fit: cover;"
                                                         alt="Gallery {{ $index + 1 }}">
                                                    <div class="card-body p-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input delete-gallery-checkbox" 
                                                                   type="checkbox" 
                                                                   name="hapus_galeri[]" 
                                                                   value="{{ $image }}" 
                                                                   id="delete_{{ $index }}"
                                                                   onchange="toggleDeleteStyle(this, {{ $index }})">
                                                            <label class="form-check-label text-danger fw-bold" for="delete_{{ $index }}">
                                                                <i class="fas fa-trash"></i> Tandai untuk dihapus
                                                            </label>
                                                        </div>
                                                        <small class="text-muted d-block mt-1 text-truncate" title="{{ basename($image) }}">
                                                            {{ basename($image) }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        <i class="fas fa-info-circle"></i> Centang checkbox untuk menandai gambar yang akan dihapus
                                    </small>
                                </div>
                            @endif

                            <!-- Klien -->
                            <div class="col-md-6 mb-3">
                                <label for="klien" class="form-label">Nama Klien</label>
                                <input type="text" class="form-control" id="klien" name="klien" 
                                       value="{{ old('klien', $project->klien) }}">
                            </div>

                            <!-- Lokasi -->
                            <div class="col-md-6 mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" 
                                       value="{{ old('lokasi', $project->lokasi) }}">
                            </div>

                            <!-- Tanggal Proyek -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_proyek" class="form-label">Tanggal Proyek</label>
                                <input type="date" class="form-control" id="tanggal_proyek" name="tanggal_proyek" 
                                       value="{{ old('tanggal_proyek', $project->tanggal_proyek ? $project->tanggal_proyek->format('Y-m-d') : '') }}">
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1" {{ old('status', $project->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $project->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('adminui.projects.index') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn bg-gradient-primary">
                                <i class="fas fa-save me-2"></i> Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Summernote
    $('#deskripsi_lengkap').summernote({
        height: 400,
        placeholder: 'Tulis deskripsi lengkap project di sini...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

    // Preview main image
    function previewMainImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('preview_gambar_utama');
        
        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Preview gallery images (new uploads)
    function previewGallery(event) {
        const previewContainer = document.getElementById('preview_galeri');
        previewContainer.innerHTML = '';
        
        const files = event.target.files;
        
        if (files.length > 0) {
            // Show count info
            const countInfo = document.createElement('div');
            countInfo.className = 'col-12 mb-2';
            countInfo.innerHTML = `<div class="alert alert-success py-2 mb-0"><i class="fas fa-check-circle"></i> ${files.length} gambar baru akan ditambahkan</div>`;
            previewContainer.appendChild(countInfo);
        }
        
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            const fileName = files[i].name;
            
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 col-sm-4 col-6';
                
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
                    <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="${fileName}">
                    <div class="card-body p-2">
                        <small class="text-success fw-bold"><i class="fas fa-plus-circle"></i> Baru</small>
                        <small class="text-muted d-block text-truncate">${fileName}</small>
                    </div>
                `;
                
                col.appendChild(card);
                previewContainer.appendChild(col);
            };
            
            reader.readAsDataURL(files[i]);
        }
    }

    // Toggle style when checkbox is checked/unchecked
    function toggleDeleteStyle(checkbox, index) {
        const card = document.getElementById('gallery_card_' + index);
        if (checkbox.checked) {
            card.style.opacity = '0.5';
            card.style.border = '2px solid #dc3545';
            card.querySelector('.card-img-top').style.filter = 'grayscale(100%)';
        } else {
            card.style.opacity = '1';
            card.style.border = '';
            card.querySelector('.card-img-top').style.filter = '';
        }
    }
</script>
@endpush
