@extends('adminui.layouts.auth')

@section('content')

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<style>
/* CKEditor Custom Styling */
.ck.ck-editor {
    border: 2px solid #e9ecef !important;
    border-radius: 8px !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
    margin-top: 8px !important;
}

.ck.ck-editor__top {
    border-bottom: 1px solid #e9ecef !important;
    background: #f8f9fa !important;
}

.ck.ck-toolbar {
    background: linear-gradient(87deg, #f8f9fa 0, #ffffff 100%) !important;
    border: none !important;
    border-radius: 8px 8px 0 0 !important;
    padding: 12px !important;
}

.ck.ck-toolbar__items {
    flex-wrap: wrap !important;
}

.ck.ck-button {
    margin: 2px !important;
    border-radius: 4px !important;
}

.ck.ck-button:hover {
    background: #e3f2fd !important;
    border-color: #2196f3 !important;
}

.ck.ck-button.ck-on {
    background: #2196f3 !important;
    border-color: #1976d2 !important;
    color: white !important;
}

.ck.ck-content {
    min-height: 250px !important;
    padding: 20px !important;
    font-size: 14px !important;
    line-height: 1.6 !important;
    border-radius: 0 0 8px 8px !important;
}

.ck.ck-content:focus {
    border: none !important;
    box-shadow: none !important;
}

.ck.ck-editor__editable_inline {
    background: white !important;
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
                                <h6 class="text-white text-capitalize ps-3">Edit Konten: {{ $content->title }}</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.about.content.index') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminui.about.content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card border">
                                    <div class="card-header bg-transparent">
                                        <h6 class="mb-0">Informasi Konten</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Judul Konten <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="text" 
                                                       name="title" 
                                                       class="form-control border px-3" 
                                                       placeholder="Masukkan judul konten yang menarik" 
                                                       value="{{ old('title', $content->title) }}" 
                                                       required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                                            <textarea name="short_description" 
                                                      class="form-control border px-3" 
                                                      rows="3" 
                                                      placeholder="Masukkan deskripsi singkat untuk preview konten" 
                                                      required>{{ old('short_description', $content->short_description) }}</textarea>
                                            <small class="text-muted">Deskripsi ini akan ditampilkan di preview konten (maksimal 1000 karakter)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Konten Lengkap <span class="text-danger">*</span></label>
                                            <textarea name="content" 
                                                      id="editor-edit"
                                                      class="form-control border px-3" 
                                                      rows="8" 
                                                      placeholder="Masukkan konten lengkap. Anda dapat menggunakan CKEditor untuk formatting yang lebih baik." 
                                                      required>{{ old('content', $content->content) }}</textarea>
                                            <small class="text-muted">
                                                <i class="material-icons text-sm">edit</i>
                                                Gunakan CKEditor untuk formatting yang lebih baik. Anda dapat upload gambar langsung di editor.
                                            </small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">CTA Link (Opsional)</label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="url" 
                                                       name="cta_link" 
                                                       class="form-control border px-3" 
                                                       placeholder="https://contoh.com/halaman-tujuan" 
                                                       value="{{ old('cta_link', $content->cta_link) }}">
                                            </div>
                                            <small class="text-muted">Link untuk tombol Call-to-Action (opsional)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Teks Tombol CTA (Opsional)</label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="text" 
                                                       name="cta_text" 
                                                       class="form-control border px-3" 
                                                       placeholder="Contoh: Pelajari Selengkapnya" 
                                                       value="{{ old('cta_text', $content->cta_text) }}">
                                            </div>
                                            <small class="text-muted">Masukkan teks untuk tombol CTA. Jika kosong, tombol tidak akan muncul di halaman.</small>
                                        </div>

                                        <!-- Current Image -->
                                        @if($content->image_path)
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Gambar Saat Ini:</label>
                                            <div class="border border-2 border-primary rounded-lg p-3 text-center">
                                                <img src="{{ $content->image_url }}" alt="Current Image" class="img-fluid rounded" style="max-height: 200px;">
                                            </div>
                                        </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">
                                                {{ $content->image_path ? 'Ganti Gambar (Opsional)' : 'Gambar Konten (Opsional)' }}
                                            </label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="file" 
                                                       name="image" 
                                                       class="form-control border px-3" 
                                                       accept="image/*"
                                                       onchange="previewImage(this)">
                                            </div>
                                            <small class="text-muted">Format: JPG, PNG, GIF, WEBP | Ukuran maksimal 5MB | Resolusi optimal 500-600px</small>
                                            
                                            <div id="imagePreview" style="display: none;" class="mt-3">
                                                <div class="border border-2 border-success rounded-lg p-3 text-center">
                                                    <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                                    <p class="text-success mt-2 mb-0"><small>Preview gambar baru</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-header bg-transparent">
                                        <h6 class="mb-0">Pengaturan Konten</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Status Publikasi</label>
                                            <div class="form-check p-3 rounded" style="background-color: {{ old('is_active', $content->is_active) ? '#d4edda' : '#f8d7da' }}; border: 2px solid {{ old('is_active', $content->is_active) ? '#28a745' : '#dc3545' }};">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="published" value="1" 
                                                       {{ old('is_active', $content->is_active) ? 'checked' : '' }} onchange="togglePublishStatus(this)">
                                                <label class="form-check-label" for="published">
                                                    <i class="fas fa-{{ old('is_active', $content->is_active) ? 'check-circle' : 'clock' }} text-sm me-1" id="publish-icon" style="color: {{ old('is_active', $content->is_active) ? '#28a745' : '#dc3545' }};"></i>
                                                    <span id="publish-text" style="color: {{ old('is_active', $content->is_active) ? '#28a745' : '#dc3545' }}; font-weight: bold;">
                                                        {{ old('is_active', $content->is_active) ? 'PUBLIKASIKAN KONTEN INI (tampilkan di website)' : 'SIMPAN SEBAGAI DRAFT (tidak tampil di website)' }}
                                                    </span>
                                                </label>
                                            </div>
                                            <small class="text-muted">
                                                <i class="material-icons text-sm">info</i>
                                                <span id="publish-help">
                                                    {{ old('is_active', $content->is_active) ? '✅ Konten akan ditampilkan di website publik dan dapat diakses pengunjung.' : '❌ Konten disimpan sebagai draft dan tidak akan tampil di website.' }}
                                                </span>
                                            </small>
                                        </div>

                                        <div class="card border mb-3">
                                            <div class="card-header bg-transparent">
                                                <h6 class="mb-0 text-primary">Informasi Konten:</h6>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled text-sm mb-0">
                                                    <li><strong>ID:</strong> #{{ $content->id }}</li>
                                                    <li><strong>Dibuat:</strong> {{ $content->created_at->format('d M Y H:i') }}</li>
                                                    <li><strong>Diupdate:</strong> {{ $content->updated_at->format('d M Y H:i') }}</li>
                                                    <li><strong>Status:</strong> 
                                                        @if($content->is_active)
                                                            <span class="badge bg-success">PUBLISHED</span>
                                                        @else
                                                            <span class="badge bg-warning">DRAFT</span>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn bg-gradient-success mb-0 me-2 flex-fill">
                                                <i class="material-icons text-sm">save</i>&nbsp;&nbsp;SAVE UPDATE KONTEN
                                            </button>
                                            <a href="{{ route('adminui.about.content.index') }}" class="btn btn-outline-secondary mb-0 flex-fill">
                                                CANCEL BATAL
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

// Initialize CKEditor for Edit Form
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initializing CKEditor for Edit Form...');
    
    setTimeout(function() {
        if (typeof ClassicEditor !== 'undefined') {
            const editorElement = document.querySelector('#editor-edit');
            
            if (editorElement) {
                ClassicEditor.create(editorElement, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'imageUpload', '|', 'undo', 'redo']
                })
                .then(editor => {
                    console.log('✅ CKEditor for Edit initialized successfully!');
                    window.editorEditInstance = editor;
                    
                    // Setup image upload
                    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                        return {
                            upload: () => {
                                return loader.file.then(file => new Promise((resolve, reject) => {
                                    if (file.size > 2 * 1024 * 1024) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'File terlalu besar!',
                                            text: 'Maksimal 2MB per gambar.',
                                            confirmButtonColor: '#d33'
                                        });
                                        reject('File too large');
                                        return;
                                    }

                                    const data = new FormData();
                                    data.append('upload', file);

                                    fetch("{{ route('adminui.ckeditor.upload') }}?_token={{ csrf_token() }}", {
                                        method: 'POST',
                                        body: data
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.error) {
                                            reject(data.error);
                                        } else {
                                            resolve({ default: data.url });
                                        }
                                    })
                                    .catch(reject);
                                }));
                            }
                        };
                    };
                    
                    // Update form submission to include CKEditor data
                    const form = document.querySelector('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            // Sync CKEditor data to textarea
                            const editorData = editor.getData();
                            editorElement.value = editorData;
                        });
                    }
                })
                .catch(error => {
                    console.error('❌ CKEditor Edit failed:', error);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Editor Fallback',
                        text: 'CKEditor tidak dapat dimuat. Menggunakan textarea biasa.',
                        confirmButtonColor: '#f39c12'
                    });
                });
            } else {
                console.error('Editor element #editor-edit not found');
            }
        } else {
            console.error('ClassicEditor not available');
            Swal.fire({
                icon: 'error',
                title: 'CKEditor Error',
                text: 'CKEditor gagal dimuat. Periksa koneksi internet.',
                confirmButtonColor: '#d33'
            });
        }
    }, 1000);
});

// Toggle publish status visual feedback
function togglePublishStatus(checkbox) {
    const icon = document.getElementById('publish-icon');
    const text = document.getElementById('publish-text');
    const help = document.getElementById('publish-help');
    const container = checkbox.closest('.form-check');
    
    if (checkbox.checked) {
        // Published - Hijau Terang
        icon.className = 'fas fa-check-circle text-sm me-1';
        icon.style.color = '#28a745';
        text.style.color = '#28a745';
        text.style.fontWeight = 'bold';
        text.textContent = 'PUBLIKASIKAN KONTEN INI (tampilkan di website)';
        help.textContent = '✅ Konten akan ditampilkan di website publik dan dapat diakses pengunjung.';
        container.style.backgroundColor = '#d4edda';
        container.style.borderColor = '#28a745';
        container.style.borderWidth = '2px';
    } else {
        // Draft - Merah Terang
        icon.className = 'fas fa-clock text-sm me-1';
        icon.style.color = '#dc3545';
        text.style.color = '#dc3545';
        text.style.fontWeight = 'bold';
        text.textContent = 'SIMPAN SEBAGAI DRAFT (tidak tampil di website)';
        help.textContent = '❌ Konten disimpan sebagai draft dan tidak akan tampil di website.';
        container.style.backgroundColor = '#f8d7da';
        container.style.borderColor = '#dc3545';
        container.style.borderWidth = '2px';
    }
}
</script>
@endsection