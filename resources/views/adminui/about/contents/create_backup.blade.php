@extends('adminui.layouts.auth')

@section('content')

<!-- CKEditor CDN - Using more stable version -->
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
                                <h6 class="text-white text-capitalize ps-3">Tambah Konten Baru</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.about.contents') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminui.about.contents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                                       value="{{ old('title') }}" 
                                                       required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                                            <textarea name="short_description" 
                                                      class="form-control border px-3" 
                                                      rows="3" 
                                                      placeholder="Masukkan deskripsi singkat untuk preview konten" 
                                                      required>{{ old('short_description') }}</textarea>
                                            <small class="text-muted">Deskripsi ini akan ditampilkan di preview konten (maksimal 1000 karakter)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Konten Lengkap <span class="text-danger">*</span></label>
                                            <textarea name="content" 
                                                      id="editor"
                                                      class="form-control border px-3" 
                                                      rows="8" 
                                                      placeholder="Masukkan konten lengkap. Anda dapat menggunakan CKEditor untuk formatting yang lebih baik." 
                                                      required>{{ old('content') }}</textarea>
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
                                                       value="{{ old('cta_link') }}">
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
                                                       value="{{ old('cta_text') }}">
                                            </div>
                                            <small class="text-muted">Masukkan teks untuk tombol CTA. Jika kosong, tombol tidak akan muncul di halaman.</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Gambar Konten (Opsional)</label>
                                            <div class="input-group input-group-dynamic">
                                                <input type="file" 
                                                       name="image" 
                                                       class="form-control border px-3" 
                                                       accept="image/*"
                                                       onchange="previewImage(this)">
                                            </div>
                                            <small class="text-muted">Format: JPG, PNG, GIF, WEBP | Ukuran maksimal 5MB | Resolusi optimal 500-600px</small>
                                            
                                            <div id="imagePreview" style="display: none;" class="mt-3">
                                                <div class="border border-2 border-primary rounded-lg p-3 text-center">
                                                    <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
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
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_published" id="published" value="1" checked>
                                                <label class="form-check-label" for="published">
                                                    Publikasikan konten ini
                                                </label>
                                            </div>
                                            <small class="text-muted">Konten hanya akan tampil di website jika dipublikasikan.</small>
                                        </div>

                                        <div class="bg-gradient-info border-radius-lg p-3 mb-3">
                                            <h6 class="text-white mb-2">
                                                <i class="material-icons text-sm">info</i>
                                                Tips Menulis:
                                            </h6>
                                            <ul class="text-white text-sm mb-0" style="list-style: none; padding-left: 0;">
                                                <li>• Gunakan judul yang menarik dan informatif</li>
                                                <li>• Deskripsi singkat sebaiknya 100-150 karakter</li>
                                                <li>• Konten lengkap berisi informasi detail</li>
                                                <li>• Tambahkan CTA link untuk interaksi lebih lanjut</li>
                                            </ul>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn bg-gradient-success mb-0 me-2 flex-fill">
                                                <i class="material-icons text-sm">save</i>&nbsp;&nbsp;SAVE SIMPAN KONTEN
                                            </button>
                                            <a href="{{ route('adminui.about.contents') }}" class="btn btn-outline-secondary mb-0 flex-fill">
                                                CANCEL BATAL
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border mt-3">
                                    <div class="card-header bg-transparent">
                                        <h6 class="mb-0">Preview Konten</h6>
                                    </div>
                                    <div class="card-body">
                                        <small class="text-muted mb-2 d-block">Preview akan muncul saat Anda mulai menulis</small>
                                        <div id="contentPreview" class="border rounded p-3 bg-light">
                                            <h6 class="text-primary">Judul Konten</h6>
                                            <p class="text-sm text-muted">Deskripsi singkat akan muncul di sini</p>
                                            <div class="text-xs">Konten lengkap akan muncul di sini</div>
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

// Real-time content preview and validation
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.querySelector('input[name="title"]');
    const descriptionInput = document.querySelector('textarea[name="short_description"]');
    const contentInput = document.querySelector('textarea[name="content"]');
    const previewDiv = document.getElementById('contentPreview');
    const form = document.querySelector('form');

    function updatePreview() {
        const title = titleInput.value || 'Judul Konten';
        const description = descriptionInput.value || 'Deskripsi singkat akan muncul di sini';
        const content = window.editorInstance ? window.editorInstance.getData() : contentInput.value || 'Konten lengkap akan muncul di sini';

        previewDiv.innerHTML = `
            <h6 class="text-primary">${title}</h6>
            <p class="text-sm text-muted">${description.substring(0, 100)}${description.length > 100 ? '...' : ''}</p>
            <div class="text-xs">${content.replace(/<[^>]*>/g, '').substring(0, 150)}${content.replace(/<[^>]*>/g, '').length > 150 ? '...' : ''}</div>
        `;
    }

    titleInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    
    // Initialize CKEditor
    setTimeout(function() {
        if (typeof ClassicEditor !== 'undefined') {
            console.log('🚀 Initializing CKEditor...');
            
            ClassicEditor.create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'imageUpload', '|', 'undo', 'redo']
            })
            .then(editor => {
                console.log('✅ CKEditor initialized successfully!');
                window.editorInstance = editor;
                
                // Update preview when CKEditor content changes
                editor.model.document.on('change:data', () => {
                    updatePreview();
                });
                
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
            })
            .catch(error => {
                console.error('❌ CKEditor failed:', error);
            });
        } else {
            console.error('CKEditor not available');
        }
    }, 1000);
});
</script>
@endsection