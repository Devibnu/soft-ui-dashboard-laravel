@extends('adminui.layouts.auth')

@section('title', 'Daftar Layanan')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section Settings -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0" style="background: linear-gradient(310deg, #7928CA, #FF0080);">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md me-3">
                            <i class="fas fa-heading text-dark text-lg opacity-10"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-0">Header Section - Our Best Services</h6>
                            <p class="text-white text-xs mb-0 opacity-8">Judul dan deskripsi section "Our Best Services"</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adminui.services.header-daftar-layanan') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="judul_section" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2"></i>Judul Section <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('judul_section') is-invalid @enderror" 
                                       id="judul_section" name="judul_section" 
                                       placeholder="Contoh: Our Best Services"
                                       value="{{ old('judul_section', $headerDaftarLayanan->judul_section ?? 'Our Best Services') }}" required>
                                <small class="text-muted">Heading besar di bagian "Our Best Services"</small>
                                @error('judul_section')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="deskripsi_section" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2"></i>Deskripsi Section
                                </label>
                                <textarea class="form-control @error('deskripsi_section') is-invalid @enderror" 
                                          id="deskripsi_section" name="deskripsi_section" rows="3" 
                                          placeholder="Deskripsi singkat di bawah judul">{{ old('deskripsi_section', $headerDaftarLayanan->deskripsi_section ?? 'Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country') }}</textarea>
                                <small class="text-muted">Deskripsi yang tampil di bawah judul section</small>
                                @error('deskripsi_section')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               id="status_aktif" name="status_aktif" 
                                               {{ old('status_aktif', $headerDaftarLayanan->status_aktif ?? true) ? 'checked' : '' }}>
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

    <!-- Daftar Layanan Section -->
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Kelola Daftar Layanan</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#modalLayanan">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Layanan
                                </button>
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

                    @if($daftarLayanans->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Layanan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daftarLayanans as $layanan)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($layanan->gambar_layanan)
                                                        <img src="{{ Storage::url($layanan->gambar_layanan) }}" class="avatar avatar-lg me-3 border-radius-lg" alt="Image">
                                                    @else
                                                        <div class="avatar avatar-lg me-3 border-radius-lg bg-gradient-info">
                                                            <i class="fas fa-layer-group text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $layanan->nama_layanan }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($layanan->deskripsi_layanan, 80) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($layanan->status_aktif)
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
                                                {{ $layanan->created_at->format('d M Y') }}<br>
                                                <small>{{ $layanan->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" onclick="editLayanan({{ $layanan->id }}, '{{ addslashes($layanan->nama_layanan) }}', '{{ addslashes($layanan->deskripsi_layanan) }}', '{{ $layanan->harga_layanan }}', {{ $layanan->status_aktif ? 'true' : 'false' }})" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteLayanan({{ $layanan->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
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
                                <i class="fas fa-layer-group text-secondary opacity-6" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Daftar Layanan</h5>
                            <p class="text-sm text-muted mb-3">Tambahkan layanan untuk ditampilkan di website</p>
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalLayanan">
                                <i class="fas fa-plus me-1"></i> Tambah Layanan Pertama
                            </button>
                        </div>
                    @endif
                    
                    @if($daftarLayanans->hasPages())
                        <div class="card-footer pt-0">
                            <div class="d-flex justify-content-center">
                                {{ $daftarLayanans->links() }}
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
                                <i class="material-icons opacity-10 pt-2">info</i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-2">Informasi Penting</h6>
                                <ul class="text-sm mb-0 ps-3">
                                    <li>Daftar Layanan akan ditampilkan di halaman Services website</li>
                                    <li>Upload gambar dengan ukuran maksimal 300KB untuk performa optimal</li>
                                    <li>Gunakan status untuk mengatur layanan mana yang ditampilkan</li>
                                    <li>Harga layanan bersifat opsional</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add/Edit -->
<div class="modal fade" id="modalLayanan" tabindex="-1" aria-labelledby="modalLayananLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="layananForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLayananLabel">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_layanan" class="form-label">Nama Layanan</label>
                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="deskripsi_layanan" class="form-label">Deskripsi Layanan</label>
                            <textarea class="form-control" id="deskripsi_layanan" name="deskripsi_layanan" rows="4" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga_layanan" class="form-label">Harga Layanan (Opsional)</label>
                            <input type="text" class="form-control" id="harga_layanan" name="harga_layanan" placeholder="Contoh: Rp 500.000">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gambar_layanan" class="form-label">Gambar Layanan (Max: 300KB)</label>
                            <input type="file" class="form-control" id="gambar_layanan" name="gambar_layanan" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 300KB</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" checked>
                                <label class="form-check-label" for="status_aktif">Aktif</label>
                            </div>
                        </div>
                        <div class="col-md-12" id="currentImagePreview" style="display: none;">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div>
                                <img id="currentImage" src="" class="img-fluid border-radius-lg shadow" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function resetForm() {
        document.getElementById('layananForm').reset();
        document.getElementById('layananForm').action = "{{ route('adminui.services.daftar-layanan') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('modalLayananLabel').textContent = 'Tambah Layanan';
        document.getElementById('currentImagePreview').style.display = 'none';
        document.getElementById('status_aktif').checked = true;
    }

    function editLayanan(id, nama, deskripsi, harga, status) {
        document.getElementById('layananForm').action = `/adminui/services/daftar-layanan/${id}`;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('modalLayananLabel').textContent = 'Edit Layanan';
        
        document.getElementById('nama_layanan').value = nama;
        document.getElementById('deskripsi_layanan').value = deskripsi;
        document.getElementById('harga_layanan').value = harga || '';
        document.getElementById('status_aktif').checked = status;
        
        // Fetch image if exists
        fetch(`/adminui/services/daftar-layanan/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                if (data.gambar_layanan) {
                    document.getElementById('currentImage').src = data.gambar_layanan;
                    document.getElementById('currentImagePreview').style.display = 'block';
                } else {
                    document.getElementById('currentImagePreview').style.display = 'none';
                }
            })
            .catch(error => console.error('Error:', error));
        
        new bootstrap.Modal(document.getElementById('modalLayanan')).show();
    }

    function deleteLayanan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Layanan ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/adminui/services/daftar-layanan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success')
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
                });
            }
        });
    }

    // Reset form when modal is closed
    document.getElementById('modalLayanan').addEventListener('hidden.bs.modal', function () {
        resetForm();
    });
</script>
@endsection
