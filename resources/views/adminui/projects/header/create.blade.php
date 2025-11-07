@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="text-white text-capitalize ps-3 mb-0">Tambah Header Projects</h6>
                                <p class="text-white text-xs ps-3 mb-0">Tambah judul dan deskripsi section projects</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    @if ($errors->any())
                        <div class="alert alert-danger text-white">
                            <strong>Error!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('adminui.projects.header.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="judul_section" class="form-label">Judul Section <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul_section" name="judul_section" 
                                       value="{{ old('judul_section', 'Projek Terbaru Kami') }}" required>
                                @error('judul_section')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_section" class="form-label">Deskripsi Section</label>
                                <textarea class="form-control" id="deskripsi_section" name="deskripsi_section" rows="4">{{ old('deskripsi_section', 'Kami telah menyelesaikan berbagai projek IT dengan kualitas terbaik. Berikut adalah beberapa projek terbaru yang telah kami kerjakan dengan profesional dan tepat waktu.') }}</textarea>
                                @error('deskripsi_section')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" checked>
                                    <label class="form-check-label" for="status_aktif">Status Aktif</label>
                                </div>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border mt-3">
                                    <div class="card-header pb-0">
                                        <h6 class="mb-0"><i class="fas fa-eye me-2"></i>Preview di Homepage</h6>
                                    </div>
                                    <div class="card-body text-center py-4">
                                        <h2 class="mb-3" id="preview-judul" style="color: #344767;">Projek Terbaru Kami</h2>
                                        <p class="text-muted mb-0" id="preview-deskripsi">Kami telah menyelesaikan berbagai projek IT dengan kualitas terbaik. Berikut adalah beberapa projek terbaru yang telah kami kerjakan dengan profesional dan tepat waktu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <a href="{{ route('adminui.projects.header.index') }}" class="btn btn-light">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn bg-gradient-primary">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const judulInput = document.getElementById('judul_section');
    const deskripsiInput = document.getElementById('deskripsi_section');
    const previewJudul = document.getElementById('preview-judul');
    const previewDeskripsi = document.getElementById('preview-deskripsi');

    judulInput.addEventListener('input', function() {
        previewJudul.textContent = this.value || 'Projek Terbaru Kami';
    });

    deskripsiInput.addEventListener('input', function() {
        previewDeskripsi.textContent = this.value || '';
    });
});
</script>
@endsection
