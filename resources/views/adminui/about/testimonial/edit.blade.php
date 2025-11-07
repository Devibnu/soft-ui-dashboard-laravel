@extends('adminui.layouts.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Edit Testimonial</h6>
                            <a href="{{ route('adminui.about') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adminui.about.testimonial.update', $testimonial->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Judul Section <span class="text-danger">*</span></label>
                                        <input class="form-control @error('section_title') is-invalid @enderror" 
                                               type="text" 
                                               name="section_title" 
                                               value="{{ old('section_title', $testimonial->section_title) }}"
                                               placeholder="Our Clients Say" 
                                               required>
                                        @error('section_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Subteks <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('section_subtext') is-invalid @enderror" 
                                                  name="section_subtext" 
                                                  rows="3" 
                                                  placeholder="Separated they live in. A small river named Duden flows..." 
                                                  required>{{ old('section_subtext', $testimonial->section_subtext) }}</textarea>
                                        @error('section_subtext')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Nama Klien <span class="text-danger">*</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" 
                                               type="text" 
                                               name="name" 
                                               value="{{ old('name', $testimonial->name) }}"
                                               placeholder="John Doe" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Jabatan <span class="text-danger">*</span></label>
                                        <input class="form-control @error('position') is-invalid @enderror" 
                                               type="text" 
                                               name="position" 
                                               value="{{ old('position', $testimonial->position) }}"
                                               placeholder="CEO, Company ABC" 
                                               required>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Upload Foto</label>
                                        <input class="form-control @error('photo') is-invalid @enderror" 
                                               type="file" 
                                               name="photo" 
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <small class="text-muted">Max: 2MB (JPG, PNG, JPEG). Kosongkan jika tidak ingin mengubah.</small>
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        
                                        @if($testimonial->photo)
                                            <div class="mt-2">
                                                <label class="text-sm">Foto Saat Ini:</label>
                                                <img src="{{ asset('storage/' . $testimonial->photo) }}" 
                                                     style="max-width: 100px; max-height: 100px; border-radius: 50%; display: block;">
                                            </div>
                                        @endif
                                        
                                        <div id="imagePreview" style="display: none; margin-top: 10px;">
                                            <label class="text-sm">Preview Baru:</label>
                                            <img id="preview" src="" style="max-width: 100px; max-height: 100px; border-radius: 50%;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Isi Testimoni <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  name="message" 
                                                  rows="6" 
                                                  placeholder="Far far away, behind the word mountains..." 
                                                  required>{{ old('message', $testimonial->message) }}</textarea>
                                        @error('message')
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
                                            <option value="1" {{ old('is_active', $testimonial->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('is_active', $testimonial->is_active) == '0' ? 'selected' : '' }}>Non Aktif</option>
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
                                            <i class="fas fa-save me-1"></i> Update Testimonial
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
<script>
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
