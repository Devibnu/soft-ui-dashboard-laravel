@extends('adminui.layouts.auth')

@section('title', 'Edit Header Info')

@push('styles')
<style>
.form-label {
    font-weight: 600;
    color: #333;
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #4CAF50;
}

input:checked + .slider:before {
    transform: translateX(26px);
}
</style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Edit Header Info</h6>
                        <a href="{{ route('adminui.header-info.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminui.header-info.update', $headerInfo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Nama Website -->
                                    <div class="form-group mb-3">
                                        <label for="nama_website" class="form-label">Nama Website</label>
                                        <input type="text" class="form-control @error('nama_website') is-invalid @enderror" 
                                               id="nama_website" name="nama_website" 
                                               value="{{ old('nama_website', $headerInfo->nama_website) }}" 
                                               placeholder="Contoh: JasaIbnu">
                                        @error('nama_website')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional - kosongkan jika tidak diperlukan</small>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               value="{{ old('email', $headerInfo->email) }}" required 
                                               placeholder="Contoh: info@jasaibnu.id">
                                        @error('email')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Telepon -->
                                    <div class="form-group mb-3">
                                        <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                               id="telepon" name="telepon" 
                                               value="{{ old('telepon', $headerInfo->telepon) }}" required 
                                               placeholder="Contoh: +62 812 3456 7890">
                                        @error('telepon')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- CTA Text -->
                                    <div class="form-group mb-3">
                                        <label for="cta_text" class="form-label">Teks Tombol CTA <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('cta_text') is-invalid @enderror" 
                                               id="cta_text" name="cta_text" 
                                               value="{{ old('cta_text', $headerInfo->cta_text) }}" required 
                                               placeholder="Contoh: Hubungi Kami">
                                        @error('cta_text')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- CTA Link -->
                                    <div class="form-group mb-3">
                                        <label for="cta_link" class="form-label">Link Tombol CTA <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('cta_link') is-invalid @enderror" 
                                               id="cta_link" name="cta_link" 
                                               value="{{ old('cta_link', $headerInfo->cta_link) }}" required 
                                               placeholder="Contoh: /contact atau https://wa.me/628123456789">
                                        @error('cta_link')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Gunakan path relatif (/) atau URL lengkap (https://)</small>
                                    </div>

                                    <!-- Status Toggle -->
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label d-block">Status</label>
                                        <label class="switch">
                                            <input type="checkbox" id="status" name="status" value="1" {{ old('status', $headerInfo->status) ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                        <span class="ms-2" id="statusLabel">{{ $headerInfo->status ? 'Aktif' : 'Non-Aktif' }}</span>
                                        <div>
                                            <small class="text-muted">Aktifkan untuk menampilkan header info ini di website</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Box -->
                            <div class="alert alert-info text-white mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Catatan:</strong> Jika Anda mengaktifkan header info ini, maka header info lain yang aktif akan otomatis dinonaktifkan. Hanya 1 header info yang dapat aktif di website.
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('adminui.header-info.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Header Info
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Update status label saat toggle switch berubah
document.getElementById('status').addEventListener('change', function() {
    const label = document.getElementById('statusLabel');
    if (this.checked) {
        label.textContent = 'Aktif';
        label.classList.remove('text-danger');
        label.classList.add('text-success');
    } else {
        label.textContent = 'Non-Aktif';
        label.classList.remove('text-success');
        label.classList.add('text-danger');
    }
});

// Set initial label color
window.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('status');
    const label = document.getElementById('statusLabel');
    if (checkbox.checked) {
        label.classList.add('text-success');
    } else {
        label.classList.add('text-danger');
    }
});
</script>
@endpush
