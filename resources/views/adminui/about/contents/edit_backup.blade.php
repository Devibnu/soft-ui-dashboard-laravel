@extends('adminui.layouts.auth')

@section('content')

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

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

/* Hide default textarea when CKEditor loads */
#editor-edit {
    display: block !important;
}

#editor-edit.ck-replaced {
    display: none !important;
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
                                <h6 class="text-white text-capitalize ps-3">Edit Konten: {{ Str::limit($content->title, 40) }}</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.about.contents') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <!-- Form -->
                    <form method="POST" action="{{ route('adminui.about.contents.update', $content) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Content Section -->
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

                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">
                                                {{ $content->image_path ? 'Ganti Gambar (Opsional)' : 'Upload Gambar Konten (Opsional)' }}
                                            </label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="file" 
                                                       name="image" 
                                                       class="form-control border px-3" 
                                                       accept="image/*" 
                                                       onchange="previewImage(this)">
                                            </div>
                                            <small class="text-muted">
                                                <strong>Format:</strong> JPG, PNG, GIF, WEBP | 
                                                <strong>Ukuran maksimal:</strong> 5MB | 
                                                <strong>Resolusi optimal:</strong> 600x400px
                                            </small>
                                        </div>

                                        <!-- New Image Preview -->
                                        <div id="imagePreview" class="mt-3" style="display: none;">
                                            <label class="form-label font-weight-bold">Preview Gambar Baru:</label>
                                            <div class="border border-2 border-dashed border-success rounded-lg p-3 text-center">
                                                <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Section -->
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-header bg-transparent">
                                        <h6 class="mb-0">Pengaturan Konten</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Status Publikasi</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="is_active" 
                                                       id="is_active" 
                                                       value="1"
                                                       {{ old('is_active', $content->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    <span class="text-sm">Publikasikan konten ini</span>
                                                </label>
                                            </div>
                                            <small class="text-muted">
                                                Konten hanya akan tampil di website jika dipublikasikan.
                                            </small>
                                        </div>

                                        <!-- Content Info -->
                                        <div class="alert alert-light border">
                                            <h6><i class="ni ni-info"></i> Informasi Konten:</h6>
                                            <ul class="text-sm mb-0">
                                                <li><strong>ID:</strong> #{{ $content->id }}</li>
                                                <li><strong>Dibuat:</strong> {{ $content->created_at->format('d M Y H:i') }}</li>
                                                <li><strong>Diupdate:</strong> {{ $content->updated_at->format('d M Y H:i') }}</li>
                                                <li><strong>Status:</strong> 
                                                    <span class="badge badge-sm {{ $content->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                        {{ $content->is_active ? 'Published' : 'Draft' }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn bg-gradient-primary">
                                                <i class="material-icons text-sm">save</i>&nbsp;&nbsp;SAVE UPDATE KONTEN
                                            </button>
                                            <a href="{{ route('adminui.about.contents') }}" class="btn btn-outline-secondary">
                                                <i class="material-icons text-sm">cancel</i>&nbsp;&nbsp;CANCEL BATAL
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Delete Form (Separate from main form) -->
                    <div class="row mt-3">
                        <div class="col-md-4 offset-md-8">
                            <div class="border-top pt-3">
                                <form method="POST" action="{{ route('adminui.about.contents.destroy', $content) }}" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="material-icons text-sm">delete</i>&nbsp;&nbsp;DELETE HAPUS KONTEN
                                    </button>
                                </form>
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
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Form validation before submit (Optimized untuk edit)
document.addEventListener('DOMContentLoaded', function() {
    const mainForm = document.querySelector('form[method="POST"][action*="update"]');
    if (!mainForm) return; // Exit if no main form found
    
    const titleInput = mainForm.querySelector('input[name="title"]');
    const descriptionInput = mainForm.querySelector('textarea[name="short_description"]');
    const contentInput = mainForm.querySelector('textarea[name="content"]');

    mainForm.addEventListener('submit', function(e) {
        let hasErrors = false;
        const errors = [];

        // Validate title
        if (!titleInput || !titleInput.value.trim()) {
            hasErrors = true;
            errors.push('Judul konten wajib diisi.');
            if (titleInput) titleInput.classList.add('is-invalid');
        } else {
            if (titleInput) titleInput.classList.remove('is-invalid');
        }

        // Validate short description
        if (!descriptionInput || !descriptionInput.value.trim()) {
            hasErrors = true;
            errors.push('Deskripsi singkat wajib diisi.');
            if (descriptionInput) descriptionInput.classList.add('is-invalid');
        } else if (descriptionInput.value.length > 1000) {
            hasErrors = true;
            errors.push('Deskripsi singkat terlalu panjang (maksimal 1000 karakter).');
            if (descriptionInput) descriptionInput.classList.add('is-invalid');
        } else {
            if (descriptionInput) descriptionInput.classList.remove('is-invalid');
        }

        // Validate content
        if (!contentInput || !contentInput.value.trim()) {
            hasErrors = true;
            errors.push('Isi konten wajib diisi.');
            if (contentInput) contentInput.classList.add('is-invalid');
        } else {
            if (contentInput) contentInput.classList.remove('is-invalid');
        }

        if (hasErrors) {
            e.preventDefault();
            
            // Show validation error toast
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: '<ul style="text-align: left; margin: 0; padding-left: 20px;">' + 
                          errors.map(error => `<li>${error}</li>`).join('') + 
                          '</ul>',
                    background: 'linear-gradient(87deg, #f53939 0, #f56565 100%)',
                    color: '#fff',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000,
                    timerProgressBar: true
                });
            } else {
                alert('Validasi Gagal:\n' + errors.join('\n'));
            }
        } else {
            // Show success indication
            const submitButton = mainForm.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.innerHTML = '<i class="material-icons text-sm">hourglass_empty</i>&nbsp;&nbsp;Menyimpan...';
                submitButton.disabled = true;
            }
        }
    });
    
    // CKEditor Setup for Edit Form
    let editorEditInstance;
    
    // Function to initialize CKEditor for Edit
    function initializeCKEditorEdit() {
        const editorElement = document.querySelector('#editor-edit');
        
        if (editorElement && typeof ClassicEditor !== 'undefined') {
            ClassicEditor
                .create(editorElement, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', '|',
                            'link', 'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'imageUpload', 'blockQuote', 'insertTable', '|',
                            'undo', 'redo'
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                        ]
                    },
                    image: {
                        toolbar: [ 'imageTextAlternative', 'imageStyle:full', 'imageStyle:side' ]
                    },
                    table: {
                        contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                    },
                    language: 'id'
                })
                .then(editor => {
                    editorEditInstance = editor;
                    
                    // Mark textarea as replaced by CKEditor
                    editorElement.classList.add('ck-replaced');        // Custom upload adapter
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return {
                upload: () => {
                    return loader.file.then(file => new Promise((resolve, reject) => {
                        // Validasi ukuran file
                        if (file.size > 2 * 1024 * 1024) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ukuran gambar terlalu besar!',
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
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload gagal!',
                                    text: data.error,
                                    confirmButtonColor: '#d33'
                                });
                                reject(data.error);
                            } else {
                                resolve({ default: data.url });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload gagal!',
                                text: 'Terjadi kesalahan saat upload gambar.',
                                confirmButtonColor: '#d33'
                            });
                            reject(error);
                        });
                    }));
                }
            };
        };
    })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                    
                    // Show error and fallback to textarea
                    if (loadingElement) {
                        loadingElement.innerHTML = `
                            <i class="material-icons text-danger">error</i>
                            <p class="mb-0 mt-2 text-danger">CKEditor gagal dimuat. Menggunakan textarea biasa.</p>
                        `;
                    }
                    editorElement.style.display = 'block';
                    
                    Swal.fire({
                        icon: 'warning',
                        title: 'Editor Fallback',
                        text: 'CKEditor tidak dapat dimuat. Silakan gunakan textarea biasa untuk sementara.',
                        confirmButtonColor: '#f39c12'
                    });
                });
        } else {
            // Fallback if CKEditor is not available
            if (loadingElement) {
                loadingElement.innerHTML = `
                    <i class="material-icons text-warning">warning</i>
                    <p class="mb-0 mt-2 text-warning">CKEditor tidak tersedia. Menggunakan textarea biasa.</p>
                `;
            }
            editorElement.style.display = 'block';
        }
    }
    
    // Wait for CKEditor to be available, then initialize
    if (typeof ClassicEditor !== 'undefined') {
        initializeCKEditorEdit();
    } else {
        // If CKEditor is not loaded yet, wait for it
        const checkCKEditor = setInterval(() => {
            if (typeof ClassicEditor !== 'undefined') {
                clearInterval(checkCKEditor);
                initializeCKEditorEdit();
            }
        }, 100);
        
        // Timeout after 10 seconds
        setTimeout(() => {
            if (typeof ClassicEditor === 'undefined') {
                clearInterval(checkCKEditor);
                const loadingElement = document.querySelector('#editor-edit-loading');
                const editorElement = document.querySelector('#editor-edit');
                if (loadingElement) {
                    loadingElement.innerHTML = `
                        <i class="material-icons text-danger">error</i>
                        <p class="mb-0 mt-2 text-danger">Gagal memuat CKEditor. Menggunakan textarea biasa.</p>
                    `;
                }
                if (editorElement) {
                    editorElement.style.display = 'block';
                }
            }
        }, 10000);
    }
});
</script>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endsection