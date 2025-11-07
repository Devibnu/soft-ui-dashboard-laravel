@extends('adminui.layouts.auth')

@section('title', 'Edit Artikel Blog')

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
                        <h6>Edit Artikel Blog</h6>
                        <a href="{{ route('adminui.blog.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="artikelForm" action="{{ route('adminui.blog.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-8">
                                    <!-- Judul Artikel -->
                                    <div class="form-group mb-3">
                                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="judul" name="judul" 
                                               value="{{ old('judul', $artikel->judul) }}" required placeholder="Masukkan judul artikel...">
                                        @error('judul')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Slug (Auto-generated) -->
                                    <div class="form-group mb-3">
                                        <label for="slug" class="form-label">Slug URL</label>
                                        <input type="text" class="form-control" id="slug" name="slug" 
                                               value="{{ old('slug', $artikel->slug) }}" readonly 
                                               placeholder="slug-akan-dibuat-otomatis">
                                        <small class="text-muted">Slug akan dibuat otomatis dari judul artikel</small>
                                    </div>

                                    <!-- Ringkasan -->
                                    <div class="form-group mb-3">
                                        <label for="ringkasan" class="form-label">Ringkasan Artikel</label>
                                        <textarea class="form-control" id="ringkasan" name="ringkasan" rows="3" 
                                                  placeholder="Ringkasan singkat artikel untuk ditampilkan di halaman blog...">{{ old('ringkasan', $artikel->ringkasan) }}</textarea>
                                        @error('ringkasan')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Isi Artikel -->
                                    <div class="form-group mb-3">
                                        <label for="isi" class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="isi" name="isi" rows="15" required 
                                                  placeholder="Tulis isi artikel di sini...">{{ old('isi', $artikel->isi) }}</textarea>
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
                                            <option value="aktif" {{ old('status', $artikel->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="non_aktif" {{ old('status', $artikel->status) == 'non_aktif' ? 'selected' : '' }}>Non Aktif</option>
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
                                                    <input class="form-check-input" type="checkbox" name="kategoris[]" value="{{ $kategori->id }}" id="kategori_{{ $kategori->id }}"
                                                        {{ $artikel->kategoris->contains($kategori->id) ? 'checked' : '' }}>
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
                                        
                                        @if($artikel->gambar)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-thumbnail" style="max-height: 200px; width: 100%;">
                                            <small class="text-muted d-block mt-1">Gambar saat ini</small>
                                        </div>
                                        @endif
                                        
                                        <input type="file" class="form-control" id="gambar" name="gambar" 
                                               accept="image/jpeg,image/png,image/jpg,image/gif">
                                        <small class="text-muted">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                                        @error('gambar')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                        
                                        <!-- Image Preview -->
                                        <div id="imagePreview" class="mt-2" style="display: none;">
                                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px; width: 100%;">
                                            <small class="text-muted d-block mt-1">Preview gambar baru</small>
                                        </div>
                                    </div>

                                    <!-- Metadata Info -->
                                    <div class="alert alert-light border">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i> Informasi Artikel<br>
                                            <strong>Dibuat:</strong> {{ $artikel->tanggal_dibuat->format('d/m/Y H:i') }}<br>
                                            @if($artikel->updated_at)
                                            <strong>Diupdate:</strong> {{ $artikel->updated_at->format('d/m/Y H:i') }}<br>
                                            @endif
                                            <strong>Komentar:</strong> {{ $artikel->komentars()->count() }}
                                        </small>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary w-100 mb-2">
                                            <i class="fas fa-save me-1"></i> Update Artikel
                                        </button>
                                        <a href="{{ route('adminui.blog.index') }}" class="btn btn-secondary w-100 mb-2">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </a>
                                        <a href="{{ route('blog.detail', $artikel->slug) }}" target="_blank" class="btn btn-info w-100">
                                            <i class="fas fa-eye me-1"></i> Lihat Artikel
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
    console.log('Initializing Summernote editor for edit...');
    
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
                console.log('Summernote initialized successfully for editing!');
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

    // Form validation
    const form = document.getElementById('artikelForm');
    form.addEventListener('submit', function(e) {
        const judul = document.getElementById('judul').value.trim();
        const isi = $('#isi').summernote('code').trim();
        
        if (!judul) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Judul artikel harus diisi',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }
        
        if (!isi || isi === '<p><br></p>') {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Isi artikel harus diisi',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang mengupdate artikel',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });
});

// Show success message if any
@if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
@endif

// Show error message if any
@if(session('error'))
    Swal.fire({
        title: 'Error!',
        text: '{{ session("error") }}',
        icon: 'error',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
