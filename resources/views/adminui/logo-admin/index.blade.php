@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Kelola Logo Admin</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.logo-admin.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Upload Logo Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
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

                    @if($logos->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo Preview</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">File Info</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logos as $logo)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('storage/' . $logo->gambar) }}" 
                                                         class="avatar avatar-xl me-3 border-radius-lg" 
                                                         alt="Logo"
                                                         style="object-fit: contain; background: #f8f9fa;">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0">
                                                <strong>File:</strong> {{ basename($logo->gambar) }}
                                            </p>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fas fa-clock me-1"></i>{{ $logo->created_at->diffForHumans() }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($logo->status)
                                                <span class="badge badge-sm bg-gradient-success">
                                                    <i class="fas fa-check-circle me-1"></i>AKTIF
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">
                                                    <i class="fas fa-times-circle me-1"></i>NON-AKTIF
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('adminui.logo-admin.edit', $logo) }}" 
                                               class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" 
                                               onclick="deleteLogo({{ $logo->id }})" 
                                               class="badge badge-sm bg-gradient-danger" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5 mx-4">
                            <i class="fas fa-image fa-3x text-secondary mb-3"></i>
                            <h5 class="text-secondary">Belum ada Logo Admin</h5>
                            <p class="text-sm text-secondary">Silakan upload logo website untuk mulai mengelola branding Anda.</p>
                            <a href="{{ route('adminui.logo-admin.create') }}" class="btn bg-gradient-primary mt-3">
                                <i class="fas fa-plus me-2"></i>Upload Logo Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteLogo(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Logo ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('delete-form');
            form.action = '{{ route("adminui.logo-admin.index") }}/' + id;
            form.submit();
        }
    });
}

setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(function() { alert.remove(); }, 500);
    });
}, 5000);
</script>
@endpush
