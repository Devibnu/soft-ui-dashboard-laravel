@extends('adminui.layouts.auth')

@section('title', 'Detail Contact Message')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Detail Contact Message</h6>
                        <a href="{{ route('adminui.contact-messages.index') }}" class="btn btn-sm btn-outline-secondary mb-0">
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
                                        <div class="col-8 text-sm">{{ $message->name }}</div>
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
                                        <div class="col-4 text-sm font-weight-bold">Subject:</div>
                                        <div class="col-8 text-sm">
                                            <span class="badge bg-gradient-info">{{ $message->subject }}</span>
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
                                        <i class="material-icons text-sm me-1">message</i> Isi Pesan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-sm" style="white-space: pre-wrap;">{{ $message->message }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Reply Section -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="text-sm font-weight-bold">
                                        <i class="material-icons text-sm me-1">reply</i> Balas Pesan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="reply-message" class="form-label">Tulis balasan Anda:</label>
                                        <textarea class="form-control" id="reply-message" rows="5" placeholder="Ketik pesan balasan di sini..."></textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-primary btn-sm" id="reply-email-btn">
                                            <i class="material-icons text-sm me-1">email</i> Balas via Email
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" id="reply-whatsapp-btn">
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
    
    // Update Status
    document.getElementById('status-select').addEventListener('change', function() {
        const status = this.value;
        
        fetch(`/adminui/contact-messages/${messageId}/update-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const badge = document.getElementById('current-status');
                badge.className = `badge badge-sm bg-gradient-${data.badge}`;
                badge.textContent = data.status;
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
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
            text: `Email akan dikirim ke {{ $message->email }}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Mengirim email...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(`/api/adminui/contact-messages/${messageId}/reply-email`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ reply_message: replyMessage })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message || 'Terjadi kesalahan saat mengirim email'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim email'
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

        Swal.fire({
            title: 'Balas via WhatsApp?',
            text: 'Anda akan diarahkan ke WhatsApp',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/adminui/contact-messages/${messageId}/reply-whatsapp`;
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
                
                const messageInput = document.createElement('input');
                messageInput.type = 'hidden';
                messageInput.name = 'reply_message';
                messageInput.value = replyMessage;
                
                form.appendChild(csrfInput);
                form.appendChild(messageInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endsection
