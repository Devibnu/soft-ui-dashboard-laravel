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
                                <h6 class="text-white text-capitalize ps-3">Kelola Konten About</h6>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.about.testimonial.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Konten
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

                    @if($testimonials->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Konten</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                                                <tbody>
                                    @foreach($testimonials as $testimonial)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($testimonial->photo_path)
                                                        <img src="{{ asset('storage/' . $testimonial->photo_path) }}" class="avatar avatar-lg me-3 border-radius-lg" alt="{{ $testimonial->name }}">
                                                    @else
                                                        <div class="avatar avatar-lg me-3 border-radius-lg bg-gradient-secondary">
                                                            <i class="ni ni-single-02 text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ Str::limit($testimonial->name, 40) }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($testimonial->message, 60) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($testimonial->is_active)
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
                                                {{ $testimonial->created_at->format('d M Y') }}<br>
                                                <small>{{ $testimonial->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('adminui.about.testimonial.edit', $testimonial) }}" class="badge badge-sm bg-gradient-dark me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;" onclick="deleteTestimonial({{ $testimonial->id }})" class="badge badge-sm bg-gradient-danger" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mx-4">
                            <i class="ni ni-bell-55 me-2"></i>Belum ada testimonial. Silakan tambahkan testimonial baru.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function deleteTestimonial(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Testimonial akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/about/testimonial/${id}`, {
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
                        'Testimonial berhasil dihapus.',
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
                    error.message || 'Terjadi kesalahan saat menghapus testimonial',
                    'error'
                );
            });
        }
    });
}
</script>
@endpush
