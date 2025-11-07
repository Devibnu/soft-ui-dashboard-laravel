@extends('adminui.layouts.auth')

@section('title', 'Detail Quote Request')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Detail Quote Request</h6>
                        <a href="{{ route('adminui.request-quote.inbox.index') }}" class="btn btn-sm btn-outline-secondary mb-0">
                            <i class="material-icons text-sm">arrow_back</i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Customer Information -->
                        <div class="col-md-6 mb-3">
                            <div class="card bg-gray-100">
                                <div class="card-body">
                                    <h6 class="text-sm font-weight-bold mb-3">
                                        <i class="material-icons text-sm me-1">person</i> Informasi Customer
                                    </h6>
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Nama:</div>
                                        <div class="col-8 text-sm">{{ $message->full_name }}</div>
                                    </div>
                                    <hr class="horizontal dark my-2">
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Email:</div>
                                        <div class="col-8 text-sm">
                                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-2">
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Telepon:</div>
                                        <div class="col-8 text-sm">
                                            <a href="tel:{{ $message->nomor_telepon }}">{{ $message->nomor_telepon }}</a>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-2">
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Service:</div>
                                        <div class="col-8 text-sm">
                                            <span class="badge bg-gradient-info">
                                                {{ $message->service->nama_service ?? $message->service_slug }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message Status -->
                        <div class="col-md-6 mb-3">
                            <div class="card bg-gray-100">
                                <div class="card-body">
                                    <h6 class="text-sm font-weight-bold mb-3">
                                        <i class="material-icons text-sm me-1">info</i> Status & Tanggal
                                    </h6>
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Status:</div>
                                        <div class="col-8">
                                            <span class="badge badge-sm bg-gradient-{{ $message->status_badge }}" id="current-status">
                                                {{ ucfirst($message->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-2">
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Diterima:</div>
                                        <div class="col-8 text-sm">
                                            {{ $message->created_at->format('d M Y H:i') }}
                                            <br>
                                            <small class="text-muted">({{ $message->created_at->diffForHumans() }})</small>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-2">
                                    <div class="row">
                                        <div class="col-4 text-sm font-weight-bold">Ubah Status:</div>
                                        <div class="col-8">
                                            <select class="form-select form-select-sm" id="status-select">
                                                <option value="baru" {{ $message->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                                <option value="dibaca" {{ $message->status == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                                                <option value="selesai" {{ $message->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message Content -->
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="text-sm font-weight-bold">
                                        <i class="material-icons text-sm me-1">message</i> Pesan dari Customer
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 bg-gray-100 border-radius-lg">
                                        <p class="text-sm mb-0" style="white-space: pre-wrap;">{{ $message->pesan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reply Actions -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="text-sm font-weight-bold">
                                        <i class="material-icons text-sm me-1">reply</i> Balas Pesan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @php
                                        $mailConfigured = !empty(env('MAIL_HOST')) && !empty(env('MAIL_USERNAME')) && env('MAIL_HOST') !== 'mailpit';
                                    @endphp
                                    
                                    @if(!$mailConfigured)
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <span class="alert-icon"><i class="material-icons">info</i></span>
                                        <span class="alert-text"><strong>Info:</strong> Email belum dikonfigurasi. Gunakan tombol <strong>WhatsApp</strong> untuk membalas pesan.</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    
                                    <div class="form-group">
                                        <label class="form-label text-sm">Tulis Balasan Anda:</label>
                                        <textarea class="form-control" id="reply-message" rows="5" placeholder="Ketik balasan Anda di sini..."></textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-primary" id="reply-email-btn">
                                            <i class="material-icons text-sm me-1">email</i> Balas via Email
                                        </button>
                                        <button type="button" class="btn btn-success" id="reply-whatsapp-btn">
                                            <i class="material-icons text-sm me-1">chat</i> Balas via WhatsApp
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageId = {{ $message->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Status change
    document.getElementById('status-select').addEventListener('change', function() {
        const newStatus = this.value;
        
        fetch(`/adminui/request-quote/inbox/${messageId}/update-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update badge
                const badge = document.getElementById('current-status');
                badge.className = `badge badge-sm bg-gradient-${data.badge}`;
                badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui status'
            });
        });
    });

    // Reply via Email
    document.getElementById('reply-email-btn').addEventListener('click', function() {
        const replyMessage = document.getElementById('reply-message').value.trim();
        
        if (!replyMessage) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Silakan tulis balasan terlebih dahulu'
            });
            return;
        }

        Swal.fire({
            title: 'Kirim Email?',
            text: `Email akan dikirim ke ${`{{ $message->email }}`}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Mengirim email...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const url = `/api/adminui/request-quote/inbox/${messageId}/reply-email`;
                console.log('Sending request to:', url);
                console.log('Message ID:', messageId);
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ reply_message: replyMessage })
                })
                .then(async response => {
                    const contentType = response.headers.get('content-type');
                    console.log('Response status:', response.status);
                    console.log('Content-Type:', contentType);
                    
                    // Check if response is JSON
                    if (contentType && contentType.includes('application/json')) {
                        const data = await response.json();
                        console.log('Response data:', data);
                        
                        if (response.ok && data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Informasi',
                                html: data.message || 'Email belum dapat dikirim. Silakan gunakan WhatsApp.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    } else {
                        // Response is HTML (likely error page or redirect)
                        const text = await response.text();
                        console.error('HTML Response received:');
                        console.error('Status:', response.status);
                        console.error('Content:', text.substring(0, 500));
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: 'Server tidak mengembalikan JSON response yang benar.<br>Status: ' + response.status + '<br><br>Silakan cek:<br>1. Permission user untuk fitur ini<br>2. CSRF token masih valid<br>3. Console browser untuk detail',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        html: 'Terjadi kesalahan jaringan. Error: ' + error.message,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    });
                });
            }
        });
    });

    // Reply via WhatsApp
    document.getElementById('reply-whatsapp-btn').addEventListener('click', function() {
        const replyMessage = document.getElementById('reply-message').value.trim();
        
        if (!replyMessage) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Silakan tulis balasan terlebih dahulu'
            });
            return;
        }

        fetch(`/adminui/request-quote/inbox/${messageId}/reply-whatsapp`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ reply_message: replyMessage })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Open WhatsApp in new tab
                window.open(data.whatsapp_url, '_blank');
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'WhatsApp akan dibuka di tab baru'
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan'
            });
        });
    });
});
</script>
@endsection
