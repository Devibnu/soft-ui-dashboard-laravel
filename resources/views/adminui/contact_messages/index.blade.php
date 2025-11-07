@extends('adminui.layouts.auth')

@section('title', 'Contact Messages')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Contact Messages</h6>
                    </div>
                </div>

                <!-- Status Filter Tabs -->
                <div class="card-body px-0 pt-0 pb-2">
                    <ul class="nav nav-pills ms-3 mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('adminui.contact-messages.index') }}">
                                Semua <span class="badge bg-secondary ms-1">{{ $statusCount['all'] }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'baru' ? 'active' : '' }}" href="{{ route('adminui.contact-messages.index', ['status' => 'baru']) }}">
                                Baru <span class="badge bg-danger ms-1">{{ $statusCount['baru'] }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'dibaca' ? 'active' : '' }}" href="{{ route('adminui.contact-messages.index', ['status' => 'dibaca']) }}">
                                Dibaca <span class="badge bg-warning ms-1">{{ $statusCount['dibaca'] }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'selesai' ? 'active' : '' }}" href="{{ route('adminui.contact-messages.index', ['status' => 'selesai']) }}">
                                Selesai <span class="badge bg-success ms-1">{{ $statusCount['selesai'] }}</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Search Form -->
                    <div class="px-3 mb-3">
                        <form action="{{ route('adminui.contact-messages.index') }}" method="GET" class="d-flex">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama, email, atau subject..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary mb-0">
                                <i class="material-icons text-sm">search</i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('adminui.contact-messages.index', ['status' => request('status')]) }}" class="btn btn-outline-secondary mb-0 ms-2">
                                    <i class="material-icons text-sm">close</i>
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Messages Table -->
                    <div class="table-responsive p-0">
                        @if($messages->count() > 0)
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $message->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{ $message->email }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ Str::limit($message->subject, 40) }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-{{ $message->status_badge }}">
                                            {{ ucfirst($message->status) }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $message->created_at->diffForHumans() }}</span>
                                        <br>
                                        <small class="text-xs text-muted">{{ $message->created_at->format('d M Y H:i') }}</small>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('adminui.contact-messages.show', $message->id) }}" class="btn btn-link text-primary px-2 mb-0" title="Lihat Detail">
                                            <i class="material-icons text-sm">visibility</i>
                                        </a>
                                        <button type="button" class="btn btn-link text-danger px-2 mb-0 delete-btn" data-id="{{ $message->id }}" title="Hapus">
                                            <i class="material-icons text-sm">delete</i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center py-5">
                            <i class="material-icons text-muted" style="font-size: 48px;">inbox</i>
                            <p class="text-muted">Tidak ada pesan ditemukan</p>
                        </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($messages->hasPages())
                    <div class="px-3 mt-3">
                        {{ $messages->appends(request()->query())->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete message
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const messageId = this.dataset.id;
            
            Swal.fire({
                title: 'Hapus Pesan?',
                text: "Pesan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/adminui/contact-messages/${messageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menghapus pesan'
                        });
                    });
                }
            });
        });
    });
});
</script>
@endsection
