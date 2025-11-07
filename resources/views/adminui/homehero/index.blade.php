@extends('adminui.layouts.auth')

@section('title', 'Home Hero')

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
                                <h6 class="text-white text-capitalize ps-3">Kelola Home Hero Section</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.home-hero.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Hero
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

                    @if($heroes->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hero</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($heroes as $hero)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($hero->gambar_background)
                                                        <img src="{{ Storage::url($hero->gambar_background) }}" class="avatar avatar-lg me-3 border-radius-lg" alt="Hero Image">
                                                    @else
                                                        <div class="avatar avatar-lg me-3 border-radius-lg bg-gradient-info">
                                                            <i class="fas fa-image text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $hero->judul }}</h6>
                                                    @if($hero->subjudul)
                                                        <p class="text-xs text-secondary mb-0">{{ $hero->subjudul }}</p>
                                                    @endif
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit(strip_tags($hero->deskripsi), 60) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($hero->status)
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
                                                {{ $hero->created_at->format('d M Y') }}<br>
                                                <small>{{ $hero->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('adminui.home-hero.edit', $hero->id) }}" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteHero({{ $hero->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
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
                                <i class="fas fa-image text-secondary opacity-6" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Hero</h5>
                            <p class="text-sm text-muted mb-3">Tambahkan hero section untuk homepage</p>
                            <a href="{{ route('adminui.home-hero.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
                                <i class="fas fa-plus me-1"></i> Tambah Hero Pertama
                            </a>
                        </div>
                    @endif
                    
                    @if($heroes->hasPages())
                        <div class="card-footer pt-0">
                            <div class="d-flex justify-content-center">
                                {{ $heroes->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteHero(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Hero akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/home-hero/${id}`, {
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
                        'Hero berhasil dihapus.',
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
                    error.message || 'Terjadi kesalahan saat menghapus hero',
                    'error'
                );
            });
        }
    });
}
</script>
@endsection
