@extends('adminui.layouts.auth')

@section('title', 'Fitur Utama')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section Settings -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0" style="background: linear-gradient(310deg, #2152ff, #21d4fd);">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md me-3">
                            <i class="fas fa-heading text-dark text-lg opacity-10"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-0">Header Section - Fitur Utama Kami</h6>
                            <p class="text-white text-xs mb-0 opacity-8">Judul, deskripsi section dan CTA Box</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adminui.services.header-fitur-utama') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Section Header -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6 class="text-sm font-weight-bold text-primary mb-2">
                                    <i class="fas fa-align-left me-2"></i>Section Header (Sebelah Kiri)
                                </h6>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="judul_section" class="form-label fw-bold">
                                    Judul Section <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" 
                                       id="judul_section" name="judul_section" 
                                       placeholder="Contoh: Our Main Features"
                                       value="{{ old('judul_section', $headerFiturUtama->judul_section ?? 'Our Main Features') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="deskripsi_section" class="form-label fw-bold">
                                    Deskripsi Section <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" 
                                          id="deskripsi_section" name="deskripsi_section" rows="2" required 
                                          placeholder="Deskripsi singkat">{{ old('deskripsi_section', $headerFiturUtama->deskripsi_section ?? 'Kami menyediakan berbagai layanan berkualitas tinggi.') }}</textarea>
                            </div>
                        </div>

                        <hr class="horizontal dark my-3">

                        <!-- CTA Box -->
                        <div class="row">
                            <div class="col-12 mb-2">
                                <h6 class="text-sm font-weight-bold text-success mb-0">
                                    <i class="fas fa-image me-2"></i>CTA Box (Sebelah Kanan)
                                </h6>
                                <small class="text-muted">Box dengan gambar, judul, deskripsi dan button di sebelah kanan</small>
                            </div>

                            <!-- Gambar CTA -->
                            <div class="col-md-12 mb-3">
                                <label for="gambar_cta" class="form-label fw-bold">
                                    <i class="fas fa-image me-2"></i>Gambar CTA
                                </label>
                                <input type="file" class="form-control" id="gambar_cta" name="gambar_cta" accept="image/*" onchange="previewCta(event)">
                                <small class="text-muted">Ukuran rekomendasi: 600x400px. Format: JPG, PNG, GIF. Max 2MB</small>
                                @if(isset($headerFiturUtama) && $headerFiturUtama->gambar_cta)
                                    <div class="mt-2">
                                        <img id="ctaPreview" src="{{ Storage::url($headerFiturUtama->gambar_cta) }}" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @else
                                    <div class="mt-2" id="ctaPreviewContainer" style="display: none;">
                                        <img id="ctaPreview" src="" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                            </div>

                            <!-- Judul CTA -->
                            <div class="col-md-12 mb-3">
                                <label for="judul_cta" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2"></i>Judul CTA <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" 
                                       id="judul_cta" name="judul_cta" 
                                       placeholder="Contoh: Read Our Success Story for Inspiration"
                                       value="{{ old('judul_cta', $headerFiturUtama->judul_cta ?? 'Read Our Success Story for Inspiration') }}" required>
                                <small class="text-muted">Judul yang tampil di dalam box CTA</small>
                            </div>

                            <!-- Deskripsi CTA -->
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_cta" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2"></i>Deskripsi CTA <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" 
                                          id="deskripsi_cta" name="deskripsi_cta" rows="3" required 
                                          placeholder="Deskripsi menarik untuk mengajak visitor melakukan aksi">{{ old('deskripsi_cta', $headerFiturUtama->deskripsi_cta ?? 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.') }}</textarea>
                                <small class="text-muted">Deskripsi yang tampil di dalam box CTA, di bawah judul</small>
                            </div>

                            <!-- Button -->
                            <div class="col-md-6 mb-3">
                                <label for="button_text" class="form-label fw-bold">
                                    <i class="fas fa-hand-pointer me-2"></i>Button Text <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" 
                                       id="button_text" name="button_text" 
                                       placeholder="Contoh: Contact us"
                                       value="{{ old('button_text', $headerFiturUtama->button_text ?? 'Contact us') }}" required>
                                <small class="text-muted">Text yang tampil pada button CTA</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="button_url" class="form-label fw-bold">
                                    <i class="fas fa-link me-2"></i>Button URL <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" 
                                       id="button_url" name="button_url" 
                                       placeholder="Contoh: /contact"
                                       value="{{ old('button_url', $headerFiturUtama->button_url ?? '/contact') }}" required>
                                <small class="text-muted">URL tujuan ketika button diklik</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               id="status_aktif" name="status_aktif" 
                                               {{ old('status_aktif', $headerFiturUtama->status_aktif ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="status_aktif">
                                            <i class="fas fa-toggle-on me-2"></i>Aktifkan Header
                                        </label>
                                    </div>
                                    <button type="submit" class="btn bg-gradient-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Header
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Fitur Section -->
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Kelola Detail Fitur</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.services.fitur-utama.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Fitur
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success mx-4 text-white font-weight-bold">
                            <i class="fas fa-check me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mx-4 text-white font-weight-bold">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @if($fiturUtamas->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fitur</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fiturUtamas as $fitur)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($fitur->ikon_fitur)
                                                        <img src="{{ Storage::url($fitur->ikon_fitur) }}" class="avatar avatar-lg me-3 border-radius-lg" alt="Icon">
                                                    @else
                                                        <div class="avatar avatar-lg me-3 border-radius-lg bg-gradient-info">
                                                            <i class="fas fa-star text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fitur->judul_fitur }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($fitur->deskripsi_fitur, 80) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($fitur->status_aktif)
                                                <span class="badge badge-sm bg-gradient-success">
                                                    <i class="fas fa-check-circle me-1"></i>AKTIF
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">
                                                    <i class="fas fa-times-circle me-1"></i>TIDAK AKTIF
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $fitur->created_at->format('d M Y') }}<br>
                                                <small>{{ $fitur->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('adminui.services.fitur-utama.edit', $fitur->id) }}" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteFitur({{ $fitur->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-star text-secondary opacity-6" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Fitur Utama</h5>
                            <p class="text-sm text-muted mb-3">Tambahkan fitur utama untuk layanan Anda</p>
                            <a href="{{ route('adminui.services.fitur-utama.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
                                <i class="fas fa-plus me-1"></i> Tambah Fitur Pertama
                            </a>
                        </div>
                    @endif
                    
                    @if($fiturUtamas->hasPages())
                        <div class="card-footer pt-0">
                            <div class="d-flex justify-content-center">
                                {{ $fiturUtamas->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Information Card -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-lg me-3">
                                <i class="fas fa-info-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Informasi Fitur Utama</h6>
                                <p class="text-sm mb-0">
                                    Fitur utama menampilkan keunggulan dan layanan yang Anda tawarkan. Gunakan ikon yang menarik dan deskripsi yang jelas untuk menarik perhatian pengunjung.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Preview gambar CTA
function previewCta(event) {
    const input = event.target;
    const preview = document.getElementById('ctaPreview');
    const container = document.getElementById('ctaPreviewContainer');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            if (container) {
                container.style.display = 'block';
            }
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteFitur(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Fitur akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/services/fitur-utama/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Terhapus!',
                        'Fitur berhasil dihapus.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    error.message || 'Terjadi kesalahan saat menghapus fitur',
                    'error'
                );
            });
        }
    });
}
</script>
@endsection
