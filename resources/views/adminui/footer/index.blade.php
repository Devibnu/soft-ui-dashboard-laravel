@extends('adminui.layouts.auth')

@section('title', 'Footer Settings')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Footer Settings</h6>
                    <p class="text-sm">Kelola tampilan footer website Anda</p>
                </div>
                <div class="card-body">
                    <form id="footerForm" method="POST" action="{{ route('adminui.footer.update') }}">
                        @csrf
                        
                        <div class="row">
                            <!-- Contact Information Section -->
                            <div class="col-md-6">
                                <h6 class="text-sm mb-3">Informasi Kontak</h6>
                                
                                <div class="form-group">
                                    <label for="alamat" class="form-control-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $footer->alamat) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="telepon" class="form-control-label">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $footer->telepon) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $footer->email) }}" required>
                                </div>
                            </div>

                            <!-- Subscribe Section -->
                            <div class="col-md-6">
                                <h6 class="text-sm mb-3">Subscribe Newsletter</h6>
                                
                                <div class="form-group">
                                    <label for="placeholder_subscribe" class="form-control-label">Placeholder Input</label>
                                    <input type="text" class="form-control" id="placeholder_subscribe" name="placeholder_subscribe" value="{{ old('placeholder_subscribe', $footer->placeholder_subscribe) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tombol_subscribe_text" class="form-control-label">Teks Tombol</label>
                                    <input type="text" class="form-control" id="tombol_subscribe_text" name="tombol_subscribe_text" value="{{ old('tombol_subscribe_text', $footer->tombol_subscribe_text) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tombol_subscribe_link" class="form-control-label">Link Tombol</label>
                                    <input type="text" class="form-control" id="tombol_subscribe_link" name="tombol_subscribe_link" value="{{ old('tombol_subscribe_link', $footer->tombol_subscribe_link) }}" placeholder="#">
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        <!-- Social Media Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-sm mb-3">Social Media Links</h6>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook_link" class="form-control-label">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </label>
                                    <input type="url" class="form-control" id="facebook_link" name="facebook_link" value="{{ old('facebook_link', $footer->facebook_link) }}" placeholder="https://facebook.com/...">
                                </div>

                                <div class="form-group">
                                    <label for="twitter_link" class="form-control-label">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </label>
                                    <input type="url" class="form-control" id="twitter_link" name="twitter_link" value="{{ old('twitter_link', $footer->twitter_link) }}" placeholder="https://twitter.com/...">
                                </div>

                                <div class="form-group">
                                    <label for="instagram_link" class="form-control-label">
                                        <i class="fab fa-instagram"></i> Instagram
                                    </label>
                                    <input type="url" class="form-control" id="instagram_link" name="instagram_link" value="{{ old('instagram_link', $footer->instagram_link) }}" placeholder="https://instagram.com/...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin_link" class="form-control-label">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </label>
                                    <input type="url" class="form-control" id="linkedin_link" name="linkedin_link" value="{{ old('linkedin_link', $footer->linkedin_link) }}" placeholder="https://linkedin.com/...">
                                </div>

                                <div class="form-group">
                                    <label for="youtube_link" class="form-control-label">
                                        <i class="fab fa-youtube"></i> YouTube
                                    </label>
                                    <input type="url" class="form-control" id="youtube_link" name="youtube_link" value="{{ old('youtube_link', $footer->youtube_link) }}" placeholder="https://youtube.com/...">
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        <!-- Copyright Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-sm mb-3">Copyright</h6>
                                
                                <div class="form-group">
                                    <label for="copyright_text" class="form-control-label">Teks Copyright</label>
                                    <textarea class="form-control" id="copyright_text" name="copyright_text" rows="2" required>{{ old('copyright_text', $footer->copyright_text) }}</textarea>
                                    <small class="text-muted">Gunakan &copy; untuk simbol copyright</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons text-sm">save</i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Preview Footer</h6>
                    <p class="text-sm">Pratinjau tampilan footer website</p>
                </div>
                <div class="card-body">
                    <div class="row" id="footer-preview" style="background: #1a1a1a; color: #fff; padding: 30px; border-radius: 8px;">
                        <div class="col-md-4 mb-3">
                            <h6 class="text-white mb-3">Have a Questions?</h6>
                            <div class="text-sm mb-2">
                                <i class="material-icons text-sm">location_on</i>
                                <span id="preview-alamat">{{ $footer->alamat }}</span>
                            </div>
                            <div class="text-sm mb-2">
                                <i class="material-icons text-sm">phone</i>
                                <span id="preview-telepon">{{ $footer->telepon }}</span>
                            </div>
                            <div class="text-sm">
                                <i class="material-icons text-sm">email</i>
                                <span id="preview-email">{{ $footer->email }}</span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h6 class="text-white mb-3">Subscribe Us!</h6>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="preview-placeholder" placeholder="{{ $footer->placeholder_subscribe }}" disabled>
                                <button class="btn btn-primary" id="preview-button" type="button">{{ $footer->tombol_subscribe_text }}</button>
                            </div>
                            
                            <h6 class="text-white mb-2 mt-4">Connect With Us</h6>
                            <div id="preview-socials">
                                @if($footer->facebook_link)
                                    <a href="#" class="btn btn-link text-white p-1"><i class="fab fa-facebook"></i></a>
                                @endif
                                @if($footer->twitter_link)
                                    <a href="#" class="btn btn-link text-white p-1"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($footer->instagram_link)
                                    <a href="#" class="btn btn-link text-white p-1"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($footer->linkedin_link)
                                    <a href="#" class="btn btn-link text-white p-1"><i class="fab fa-linkedin"></i></a>
                                @endif
                                @if($footer->youtube_link)
                                    <a href="#" class="btn btn-link text-white p-1"><i class="fab fa-youtube"></i></a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h6 class="text-white mb-3">Quick Links</h6>
                            <div class="text-sm">
                                <div class="mb-1">• Home</div>
                                <div class="mb-1">• About</div>
                                <div class="mb-1">• Services</div>
                                <div class="mb-1">• Projects</div>
                                <div class="mb-1">• Contact</div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                            <div class="text-center text-sm" id="preview-copyright">
                                {!! $footer->copyright_text !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview update
    const form = document.getElementById('footerForm');
    const previewElements = {
        alamat: document.getElementById('preview-alamat'),
        telepon: document.getElementById('preview-telepon'),
        email: document.getElementById('preview-email'),
        placeholder: document.getElementById('preview-placeholder'),
        button: document.getElementById('preview-button'),
        copyright: document.getElementById('preview-copyright')
    };

    // Update preview on input
    form.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', function() {
            const name = this.name;
            
            if (name === 'alamat') previewElements.alamat.textContent = this.value;
            if (name === 'telepon') previewElements.telepon.textContent = this.value;
            if (name === 'email') previewElements.email.textContent = this.value;
            if (name === 'placeholder_subscribe') previewElements.placeholder.placeholder = this.value;
            if (name === 'tombol_subscribe_text') previewElements.button.textContent = this.value;
            if (name === 'copyright_text') previewElements.copyright.innerHTML = this.value;
        });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="material-icons text-sm">hourglass_empty</i> Menyimpan...';
        submitBtn.disabled = true;

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new FormData(this)
        })
        .then(async response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers.get('content-type'));
            
            const text = await response.text();
            console.log('Response text (first 500 chars):', text.substring(0, 500));
            
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error('JSON parse error:', e);
                console.error('Full response:', text);
                throw new Error('Server returned invalid JSON. Check console for details.');
            }
            
            if (!response.ok) {
                throw data;
            }
            
            return data;
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            let errorMessage = 'Terjadi kesalahan saat menyimpan data';
            
            if (error.errors) {
                // Validation errors
                const errorList = Object.values(error.errors).flat();
                errorMessage = errorList.join('<br>');
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: errorMessage
            });
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
});
</script>
@endsection
