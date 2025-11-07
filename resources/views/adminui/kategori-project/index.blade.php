@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Kelola Kategori Project</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#modalKategori" onclick="openCreateModal()">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Kategori
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

                    @if($kategoris->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategoris as $kategori)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <div class="avatar avatar-lg me-3 border-radius-lg" style="background-color: {{ $kategori->warna }};">
                                                        <i class="ni ni-briefcase-24 text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $kategori->nama }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($kategori->deskripsi ?? 'Tidak ada deskripsi', 60) }}
                                                    </p>
                                                    <span class="badge badge-sm bg-gradient-info mt-1">{{ $kategori->projects_count }} project</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($kategori->status == 'published')
                                                <span class="badge badge-sm bg-gradient-success">
                                                    <i class="fas fa-check-circle me-1"></i>PUBLISHED
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning">
                                                    <i class="fas fa-clock me-1"></i>DRAFT
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $kategori->created_at->format('d M Y') }}<br>
                                                <small>{{ $kategori->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" onclick="openEditModal({{ $kategori->id }}, '{{ addslashes($kategori->nama) }}', '{{ addslashes($kategori->deskripsi) }}', '{{ $kategori->warna }}', {{ $kategori->urutan }}, '{{ $kategori->status }}')" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteKategori({{ $kategori->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
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
                                    <i class="fas fa-folder-open text-secondary opacity-6" style="font-size: 4rem;"></i>
                                </div>
                                <h5 class="text-muted mb-2">Belum Ada Kategori</h5>
                                <p class="text-sm text-muted mb-3">Mulai buat kategori pertama untuk mengorganisir project Anda.</p>
                                <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalKategori" onclick="openCreateModal()">
                                    <i class="fas fa-plus me-1"></i> Tambah Kategori Pertama
                                </button>
                            </div>
                        @endif
                        
                        @if($kategoris->hasPages())
                            <div class="card-footer pt-0">
                                <div class="d-flex justify-content-center">
                                    {{ $kategoris->links() }}
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
                                    <h6 class="mb-1">Informasi Kategori Project</h6>
                                    <p class="text-sm mb-0">
                                        Kategori membantu pengunjung menemukan project yang relevan. Gunakan nama kategori yang jelas dan deskriptif. 
                                        Anda dapat mengatur warna untuk setiap kategori agar lebih mudah dikenali.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kategori -->
    <div class="modal fade" id="modalKategori" tabindex="-1" aria-labelledby="modalKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formKategori">
                    <div class="modal-body">
                        <input type="hidden" id="kategori_id" name="kategori_id">
                        
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Contoh: Web Development">
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat kategori..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="warna" class="form-label">Warna</label>
                                    <input type="color" class="form-control" id="warna" name="warna" value="#3b82f6">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="urutan" class="form-label">Urutan</label>
                                    <input type="number" class="form-control" id="urutan" name="urutan" value="0" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="published" selected>Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
let isEditMode = false;

function openCreateModal() {
    isEditMode = false;
    document.getElementById('modalKategoriLabel').textContent = 'Tambah Kategori';
    document.getElementById('formKategori').reset();
    document.getElementById('kategori_id').value = '';
}

function openEditModal(id, nama, deskripsi, warna, urutan, status) {
    isEditMode = true;
    document.getElementById('modalKategoriLabel').textContent = 'Edit Kategori';
    document.getElementById('kategori_id').value = id;
    document.getElementById('nama').value = nama;
    document.getElementById('deskripsi').value = deskripsi || '';
    document.getElementById('warna').value = warna;
    document.getElementById('urutan').value = urutan;
    document.getElementById('status').value = status;
    
    const modal = new bootstrap.Modal(document.getElementById('modalKategori'));
    modal.show();
}

// Form Submit
document.getElementById('formKategori').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const kategoriId = document.getElementById('kategori_id').value;
    const url = isEditMode ? `/adminui/kategori-project/${kategoriId}` : '/adminui/kategori-project';
    const method = isEditMode ? 'PUT' : 'POST';
    
    // Convert FormData to JSON
    const data = {};
    formData.forEach((value, key) => {
        if (key !== 'kategori_id') {
            data[key] = value;
        }
    });
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
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
                location.reload();
            });
        } else {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Error!',
            text: error.message || 'Terjadi kesalahan saat menyimpan kategori',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});

function deleteKategori(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Kategori akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/kategori-project/${id}`, {
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
                        'Kategori berhasil dihapus.',
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
                    error.message || 'Terjadi kesalahan saat menghapus kategori',
                    'error'
                );
            });
        }
    });
}
</script>
@endpush
