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
                                <h6 class="text-white text-capitalize ps-3">Kelola Artikel Blog</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.blog.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Artikel
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

                    @if($artikels->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Artikel</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($artikels as $artikel)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($artikel->gambar)
                                                        <img src="{{ Storage::url($artikel->gambar) }}" class="avatar avatar-lg me-3 border-radius-lg" alt="Article Image">
                                                    @else
                                                        <div class="avatar avatar-lg me-3 border-radius-lg bg-gradient-secondary">
                                                            <i class="ni ni-single-copy-04 text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ Str::limit($artikel->judul, 60) }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($artikel->konten, 80) }}
                                                    </p>
                                                    @if($artikel->kategori)
                                                        <span class="badge badge-sm bg-gradient-info mt-1">{{ $artikel->kategori->nama_kategori ?? 'Uncategorized' }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($artikel->status == 'aktif')
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
                                                {{ $artikel->tanggal_dibuat->format('d M Y') }}<br>
                                                <small>{{ $artikel->tanggal_dibuat->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('adminui.blog.edit', $artikel) }}" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteArtikel({{ $artikel->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($artikels->hasPages())
                        <div class="card-footer px-4">
                            {{ $artikels->links() }}
                        </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5 mx-4">
                            <div class="icon icon-shape bg-gradient-primary shadow mx-auto mb-3" style="width: 100px; height: 100px;">
                                <i class="ni ni-single-copy-04 text-lg text-white opacity-10" style="font-size: 3rem; line-height: 100px;"></i>
                            </div>
                            <h5 class="text-muted">Belum Ada Artikel</h5>
                            <p class="text-sm text-muted mb-4">
                                Mulai dengan membuat artikel pertama untuk blog Anda.
                            </p>
                            <a href="{{ route('adminui.blog.create') }}" class="btn bg-gradient-primary">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Buat Artikel Pertama
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
                    <h6 class="mb-0">Informasi Blog Management</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-gradient text-info">Tentang Blog</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Artikel & Konten</h6>
                                        <span class="mb-2 text-xs">Buat dan kelola artikel blog dengan gambar, kategori, dan status publikasi.</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">SEO Friendly</h6>
                                        <span class="mb-2 text-xs">Setiap artikel otomatis generate SEO-friendly slug untuk URL yang lebih baik.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-gradient text-info">Tips & Panduan</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Gambar Featured</h6>
                                        <span class="mb-2 text-xs">Gunakan gambar berkualitas tinggi (minimal 1200x800px) untuk featured image.</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Konten Berkualitas</h6>
                                        <span class="mb-2 text-xs">Tulis konten yang informatif, menarik, dan relevan untuk pembaca Anda.</span>
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
function deleteArtikel(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Artikel ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/blog/${id}`, {
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
                        'Artikel berhasil dihapus.',
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
                    error.message || 'Terjadi kesalahan saat menghapus artikel',
                    'error'
                );
            });
        }
    });
}
</script>
@endpush
