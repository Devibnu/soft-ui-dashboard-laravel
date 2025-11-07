@extends('adminui.layouts.auth')

@section('title', 'Komentar Artikel - ' . $artikel->judul)

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Komentar untuk Artikel</h6>
                            <p class="text-sm mb-0">{{ $artikel->judul }}</p>
                        </div>
                        <a href="{{ route('adminui.blog.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if($komentars->count() > 0)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengirim</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                            <th class="text-secondary opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($komentars as $komentar)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $komentar->nama }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $komentar->email }}</p>
                                                            @if($komentar->parent_id)
                                                                <small class="text-muted">
                                                                    <i class="fas fa-reply"></i> Balasan untuk: {{ $komentar->parent->nama }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if($komentar->status == 'approved')
                                                        <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                                    @elseif($komentar->status == 'pending')
                                                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $komentar->created_at->format('d/m/Y H:i') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" 
                                                       class="badge badge-sm bg-gradient-info me-1 btn-lihat-komentar" 
                                                       data-id="{{ $komentar->id }}"
                                                       data-nama="{{ $komentar->nama }}"
                                                       data-tanggal="{{ $komentar->created_at->format('d/m/Y H:i') }}"
                                                       title="Lihat">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    
                                                    <!-- Hidden div untuk menyimpan komentar -->
                                                    <div id="komentar-content-{{ $komentar->id }}" style="display:none;">{{ $komentar->isi }}</div>
                                                    
                                                    @if($komentar->status == 'pending')
                                                        <a href="javascript:;" onclick="approveKomentar({{ $komentar->id }})" 
                                                           class="badge badge-sm bg-gradient-success me-1" title="Setujui">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </a>
                                                        <a href="javascript:;" onclick="rejectKomentar({{ $komentar->id }})" 
                                                           class="badge badge-sm bg-gradient-danger me-1" title="Tolak">
                                                            <i class="fas fa-times"></i> Tolak
                                                        </a>
                                                    @endif
                                                    
                                                    @if(!$komentar->parent_id)
                                                        <a href="javascript:;" onclick="showReplyModal({{ $komentar->id }}, '{{ $komentar->nama }}')" 
                                                           class="badge badge-sm bg-gradient-primary me-1" title="Balas">
                                                            <i class="fas fa-reply"></i> Balas
                                                        </a>
                                                    @endif
                                                    
                                                    <a href="javascript:;" onclick="deleteKomentar({{ $komentar->id }})" 
                                                       class="badge badge-sm bg-gradient-dark" title="Hapus">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                            
                                            {{-- Tampilkan balasan jika ada --}}
                                            @if($komentar->balasan->count() > 0)
                                                @foreach($komentar->balasan as $balasan)
                                                    <tr class="bg-light">
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="ms-4">
                                                                    <i class="fas fa-reply text-secondary"></i>
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center ms-2">
                                                                    <h6 class="mb-0 text-sm">{{ $balasan->nama }}</h6>
                                                                    <p class="text-xs text-secondary mb-0">{{ $balasan->email }}</p>
                                                                    <small class="text-muted">Balasan</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @if($balasan->status == 'approved')
                                                                <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                                            @elseif($balasan->status == 'pending')
                                                                <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                                            @else
                                                                <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                                                            @endif
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                                {{ $balasan->created_at->format('d/m/Y H:i') }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a href="javascript:;" 
                                                               class="badge badge-sm bg-gradient-info me-1 btn-lihat-komentar" 
                                                               data-id="{{ $balasan->id }}"
                                                               data-nama="{{ $balasan->nama }}"
                                                               data-tanggal="{{ $balasan->created_at->format('d/m/Y H:i') }}"
                                                               title="Lihat">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                            
                                                            <!-- Hidden div untuk menyimpan komentar -->
                                                            <div id="komentar-content-{{ $balasan->id }}" style="display:none;">{{ $balasan->isi }}</div>
                                                            
                                                            <a href="javascript:;" onclick="deleteKomentar({{ $balasan->id }})" 
                                                               class="badge badge-sm bg-gradient-dark" title="Hapus">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            {{-- Pagination --}}
                            @if($komentars->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $komentars->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-comments text-muted mb-3" style="font-size: 4rem;"></i>
                                <h5 class="text-muted">Belum Ada Komentar</h5>
                                <p class="text-muted">Artikel ini belum memiliki komentar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail Komentar --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Komentar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Pengirim</label>
                        <h6 id="detail_nama"></h6>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Tanggal</label>
                        <p id="detail_tanggal" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Isi Komentar</label>
                        <div id="detail_komentar" class="p-3 bg-light rounded"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Balas Komentar --}}
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Balas Komentar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="replyForm">
                    <div class="modal-body">
                        <input type="hidden" id="parent_id" name="parent_id">
                        <input type="hidden" id="artikel_id" name="artikel_id" value="{{ $artikel->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Balas ke: <strong id="replyToName"></strong></label>
                        </div>
                        
                        <div class="mb-3">
                            <label for="reply_nama" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="reply_nama" name="nama" value="Admin" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="reply_email" class="form-label">Email Anda</label>
                            <input type="email" class="form-control" id="reply_email" name="email" value="{{ auth()->user()->email ?? 'admin@jasaibnu.id' }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="reply_komentar" class="form-label">Balasan</label>
                            <textarea class="form-control" id="reply_komentar" name="komentar" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Balasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Event listener untuk semua tombol lihat komentar
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn-lihat-komentar');
    
    buttons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const tanggal = this.getAttribute('data-tanggal');
            const komentarContent = document.getElementById('komentar-content-' + id);
            const komentar = komentarContent ? komentarContent.textContent : 'Komentar tidak ditemukan';
            
            document.getElementById('detail_nama').textContent = nama;
            document.getElementById('detail_tanggal').textContent = tanggal;
            document.getElementById('detail_komentar').textContent = komentar;
            
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
    });
});

function approveKomentar(id) {
    Swal.fire({
        title: 'Setujui Komentar?',
        text: "Komentar akan ditampilkan di website",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/komentar/${id}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire('Error!', error.message, 'error');
            });
        }
    });
}

function rejectKomentar(id) {
    Swal.fire({
        title: 'Tolak Komentar?',
        text: "Komentar tidak akan ditampilkan di website",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tolak!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/komentar/${id}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire('Error!', error.message, 'error');
            });
        }
    });
}

function deleteKomentar(id) {
    Swal.fire({
        title: 'Hapus Komentar?',
        text: "Komentar akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/adminui/komentar/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Terhapus!', data.message, 'success').then(() => location.reload());
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire('Error!', error.message, 'error');
            });
        }
    });
}

function showReplyModal(parentId, nama) {
    document.getElementById('parent_id').value = parentId;
    document.getElementById('replyToName').textContent = nama;
    document.getElementById('replyForm').reset();
    document.getElementById('reply_nama').value = 'Admin';
    document.getElementById('reply_email').value = '{{ auth()->user()->email ?? "admin@jasaibnu.id" }}';
    
    const modal = new bootstrap.Modal(document.getElementById('replyModal'));
    modal.show();
}

// Handle reply form submission
document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const parentId = document.getElementById('parent_id').value;
    const formData = new FormData(this);
    
    fetch(`/adminui/komentar/${parentId}/reply`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('replyModal')).hide();
            Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
        } else {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        Swal.fire('Error!', error.message, 'error');
    });
});

@if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
