@extends('adminui.layouts.auth')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
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
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Edit About Content</h6>
                            <a href="{{ route('adminui.about') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adminui.about.content.update', $content->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Judul Halaman <span class="text-danger">*</span></label>
                                        <input class="form-control @error('title') is-invalid @enderror" 
                                               type="text" 
                                               name="title" 
                                               value="{{ old('title', $content->title) }}"
                                               placeholder="Welcome to Consolution" 
                                               required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Judul Box Kanan <span class="text-danger">*</span></label>
                                        <input class="form-control @error('right_title') is-invalid @enderror" 
                                               type="text" 
                                               name="right_title" 
                                               value="{{ old('right_title', $content->right_title) }}"
                                               placeholder="Read Our Success Story for Inspiration" 
                                               required>
                                        @error('right_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Isi Paragraf Kiri <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('left_paragraph') is-invalid @enderror" 
                                                  id="left_paragraph"
                                                  name="left_paragraph" 
                                                  rows="8" 
                                                  placeholder="Deskripsi utama tentang perusahaan..." 
                                                  required>{{ old('left_paragraph', $content->left_paragraph) }}</textarea>
                                        @error('left_paragraph')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Isi Box Kanan <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('right_paragraph') is-invalid @enderror" 
                                                  name="right_paragraph" 
                                                  rows="8" 
                                                  placeholder="Deskripsi singkat untuk box kanan..." 
                                                  required>{{ old('right_paragraph', $content->right_paragraph) }}</textarea>
                                        @error('right_paragraph')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Upload Gambar Kanan</label>
                                        <input class="form-control @error('right_image') is-invalid @enderror" 
                                               type="file" 
                                               name="right_image" 
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <small class="text-muted">Max: 2MB (JPG, PNG, JPEG). Kosongkan jika tidak ingin mengubah.</small>
                                        @error('right_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        
                                        @if($content->right_image)
                                            <div class="mt-2">
                                                <label class="text-sm">Gambar Saat Ini:</label>
                                                <img src="{{ asset('storage/' . $content->right_image) }}" 
                                                     style="max-width: 100%; max-height: 150px; border-radius: 8px; display: block;">
                                            </div>
                                        @endif
                                        
                                        <div id="imagePreview" style="display: none; margin-top: 10px;">
                                            <label class="text-sm">Preview Baru:</label>
                                            <img id="preview" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">CTA Button Text</label>
                                        <input class="form-control @error('cta_text') is-invalid @enderror" 
                                               type="text" 
                                               name="cta_text" 
                                               value="{{ old('cta_text', $content->cta_text) }}"
                                               placeholder="Contact Us">
                                        @error('cta_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">CTA Button Link</label>
                                        <input class="form-control @error('cta_link') is-invalid @enderror" 
                                               type="url" 
                                               name="cta_link" 
                                               value="{{ old('cta_link', $content->cta_link) }}"
                                               placeholder="https://jasaibnu.id/contact">
                                        @error('cta_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Status</label>
                                        <select class="form-control @error('is_active') is-invalid @enderror" name="is_active">
                                            <option value="1" {{ old('is_active', $content->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('is_active', $content->is_active) == '0' ? 'selected' : '' }}>Non Aktif</option>
                                        </select>
                                        @error('is_active')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('adminui.about') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Update Content
                                        </button>
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
<script>
$(document).ready(function() {
    // Initialize Summernote for Isi Paragraf Kiri
    $('#left_paragraph').summernote({
        height: 300,
        placeholder: 'Tulis deskripsi utama tentang perusahaan...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>
@endpush
