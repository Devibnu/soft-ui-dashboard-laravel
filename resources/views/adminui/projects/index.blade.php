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
                                <h6 class="text-white text-capitalize ps-3">Kelola Projects</h6>
                                <p class="text-white text-xs ps-3 mb-0">Kelola daftar projects yang akan ditampilkan</p>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.projects.header.index') }}" class="btn btn-outline-light btn-sm mb-0 me-2">
                                    <i class="fas fa-heading"></i>&nbsp;&nbsp;Header Projects
                                </a>
                                <a href="{{ route('adminui.projects.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Project
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

                    @if($projects->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($project->gambar_utama)
                                                        <img src="{{ asset('storage/' . $project->gambar_utama) }}" class="avatar avatar-lg me-3 border-radius-lg" alt="Project Image">
                                                    @else
                                                        <div class="avatar avatar-lg me-3 border-radius-lg bg-gradient-secondary">
                                                            <i class="ni ni-folder-17 text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $project->judul }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($project->deskripsi_singkat, 60) }}
                                                    </p>
                                                    @if($project->kategori)
                                                        <span class="badge badge-sm mt-1" style="background-color: {{ $project->kategori->warna }};">
                                                            {{ $project->kategori->nama }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary mt-1">Tanpa Kategori</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($project->status)
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
                                                {{ $project->created_at->format('d M Y') }}<br>
                                                <small>{{ $project->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('adminui.projects.edit', $project) }}" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteProject({{ $project->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($projects->hasPages())
                        <div class="card-footer px-4">
                            {{ $projects->links() }}
                        </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5 mx-4">
                            <div class="icon icon-shape bg-gradient-primary shadow mx-auto mb-3" style="width: 100px; height: 100px;">
                                <i class="ni ni-folder-17 text-lg text-white opacity-10" style="font-size: 3rem; line-height: 100px;"></i>
                            </div>
                            <h5 class="text-muted">Belum Ada Project</h5>
                            <p class="text-sm text-muted mb-4">
                                Mulai dengan membuat project pertama untuk portfolio Anda.
                            </p>
                            <a href="{{ route('adminui.projects.create') }}" class="btn bg-gradient-primary">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Buat Project Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Information Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Informasi Project Management</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-gradient text-info">Tentang Projects</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Portfolio Projects</h6>
                                        <span class="mb-2 text-xs">Tampilkan project terbaik Anda dengan gambar, deskripsi, dan detail lengkap.</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Image Gallery</h6>
                                        <span class="mb-2 text-xs">Setiap project dapat memiliki gambar utama dan galeri untuk menampilkan detail project.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-gradient text-info">Tips & Panduan</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Gambar Berkualitas</h6>
                                        <span class="mb-2 text-xs">Gunakan gambar resolusi tinggi (minimal 1200x800px) untuk hasil terbaik.</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Deskripsi Menarik</h6>
                                        <span class="mb-2 text-xs">Tulis deskripsi yang jelas dan menarik untuk setiap project Anda.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteProject(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Project ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/projects/${id}`, {
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
                        'Project berhasil dihapus.',
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
                    error.message || 'Terjadi kesalahan saat menghapus project',
                    'error'
                );
            });
        }
    });
}
</script>
@endpush
