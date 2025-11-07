@extends('adminui.layouts.auth')

@section('title', 'Tambah Artikel Blog')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.form-label {
    font-weight: 600;
    color: #333;
}

.note-editor.note-frame {
    border: 1px solid #d2d6da;
    border-radius: 0.375rem;
}

.note-toolbar {
    background-color: #f8f9fa;
}
</style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Tambah Artikel Blog</h6>
                        <a href="{{ route('adminui.blog.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="artikelForm" action="{{ route('adminui.blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-8">
                                    <!-- Judul Artikel -->
                                    <div class="form-group mb-3">
                                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="judul" name="judul" 
                                               value="{{ old('judul') }}" required placeholder="Masukkan judul artikel...">
                                        @error('judul')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Slug (Auto-generated) -->
                                    <div class="form-group mb-3">
                                        <label for="slug" class="form-label">Slug URL</label>
                                        <input type="text" class="form-control" id="slug" name="slug" 
                                               value="{{ old('slug') }}" readonly 
                                               placeholder="slug-akan-dibuat-otomatis">
                                        <small class="text-muted">Slug akan dibuat otomatis dari judul artikel</small>
                                    </div>

                                    <!-- Ringkasan -->
                                    <div class="form-group mb-3">
                                        <label for="ringkasan" class="form-label">Ringkasan Artikel</label>
                                        <textarea class="form-control" id="ringkasan" name="ringkasan" rows="3" 
                                                  placeholder="Ringkasan singkat artikel untuk ditampilkan di halaman blog...">{{ old('ringkasan') }}</textarea>
                                        @error('ringkasan')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Isi Artikel -->
                                    <div class="form-group mb-3">
                                        <label for="isi" class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="isi" name="isi" rows="15" required 
                                                  placeholder="Tulis isi artikel di sini...">{{ old('isi') }}</textarea>
                                        @error('isi')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Gunakan format HTML jika diperlukan</small>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-4">
                                    <!-- Status -->
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="aktif" selected>Aktif</option>
                                            <option value="non_aktif">Non Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Kategori -->
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kategori</label>
                                        @if($kategoris->count() > 0)
                                            @foreach($kategoris as $kategori)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="kategoris[]" value="{{ $kategori->id }}" id="kategori_{{ $kategori->id }}">
                                                    <label class="form-check-label" for="kategori_{{ $kategori->id }}">
                                                        <span class="badge badge-sm" style="background-color: {{ $kategori->warna }}; color: white;">{{ $kategori->nama }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted text-sm">Belum ada kategori. <a href="{{ route('adminui.kategori.index') }}" target="_blank">Buat kategori baru</a></p>
                                        @endif
                                    </div>

                                    <!-- Gambar Utama -->
                                    <div class="form-group mb-3">
                                        <label for="gambar" class="form-label">Gambar Utama</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar" 
                                               accept="image/jpeg,image/png,image/jpg,image/gif">
                                        <small class="text-muted">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</small>
                                        @error('gambar')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                        
                                        <!-- Image Preview -->
                                        <div id="imagePreview" class="mt-2" style="display: none;">
                                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px; width: 100%;">
                                        </div>
                                    </div>

                                    <!-- Auto-save Status -->
                                    <div class="alert alert-info" id="autoSaveStatus" style="display: none;">
                                        <i class="fas fa-save me-1"></i> <span id="autoSaveText">Auto-save disabled for new articles</span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary w-100 mb-2">
                                            <i class="fas fa-save me-1"></i> Simpan Artikel
                                        </button>
                                        <a href="{{ route('adminui.blog.index') }}" class="btn btn-secondary w-100">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </a>
                                    </div>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    console.log('Initializing Summernote editor...');
    
    // Initialize Summernote
    $('#isi').summernote({
        height: 400,
        placeholder: 'Tulis isi artikel di sini...',
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
        ],
        callbacks: {
            onInit: function() {
                console.log('Summernote initialized successfully!');
            }
        }
    });


    // Auto-generate slug from title
    const judulInput = document.getElementById('judul');
    const slugInput = document.getElementById('slug');
    
    judulInput.addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-'); // Replace multiple hyphens with single hyphen
        
        slugInput.value = slug;
    });

    // Image preview
    const imageInput = document.getElementById('gambar');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Form submission
    const form = document.getElementById('artikelForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Sync Summernote content to textarea
        $('#isi').val($('#isi').summernote('code'));
        
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        // Show loading state
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
        submitButton.disabled = true;
        
        // Create FormData for file upload
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '{{ route("adminui.blog.index") }}';
                });
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: error.message || 'Terjadi kesalahan saat menyimpan artikel',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => {
            // Reset button
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        });
    });
});
</script>
@endpush