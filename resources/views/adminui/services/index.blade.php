@extends('adminui.layouts.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Kelola Halaman Services</h6>
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

                    @if($errors->any())
                        <div class="alert alert-danger mx-4 text-white font-weight-bold">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs px-4 pt-3" id="servicesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="header-layanan-tab" data-bs-toggle="tab" data-bs-target="#header-layanan" type="button" role="tab">
                                <i class="fas fa-heading me-2"></i>Header Layanan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fitur-utama-tab" data-bs-toggle="tab" data-bs-target="#fitur-utama" type="button" role="tab">
                                <i class="fas fa-star me-2"></i>Fitur Utama
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="daftar-layanan-tab" data-bs-toggle="tab" data-bs-target="#daftar-layanan" type="button" role="tab">
                                <i class="fas fa-list me-2"></i>Daftar Layanan
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content px-4 mt-3" id="servicesTabContent">
                        <!-- Header Layanan Tab -->
                        <div class="tab-pane fade show active" id="header-layanan" role="tabpanel">
                            <div class="card border">
                                <div class="card-header bg-transparent">
                                    <h5 class="card-title mb-0">Header Layanan</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('adminui.services.header-layanan') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- SECTION 1: HEADER HERO (Bagian atas halaman dengan foto) -->
                                        <div class="alert alert-info mb-4">
                                            <h6 class="mb-2"><i class="fas fa-image me-2"></i><strong>SECTION 1: HEADER HERO</strong></h6>
                                            <small>Bagian atas halaman dengan latar belakang foto</small>
                                        </div>
                                        
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="judul_utama" class="form-label"><strong>Judul Utama Hero</strong></label>
                                                    <input type="text" class="form-control" id="judul_utama" name="judul_utama" 
                                                           value="{{ $headerLayanan->judul_utama ?? 'Layanan Kami' }}" required>
                                                    <small class="text-muted">Contoh: "Solusi Terbaik untuk Kebutuhan Bisnis Anda"</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="subjudul" class="form-label"><strong>Sub Judul Hero</strong></label>
                                                    <input type="text" class="form-control" id="subjudul" name="subjudul" 
                                                           value="{{ $headerLayanan->subjudul ?? 'Solusi Terbaik untuk Kebutuhan Anda' }}" required>
                                                    <small class="text-muted">Sub judul di bawah judul utama</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label"><strong>Deskripsi Hero</strong></label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $headerLayanan->deskripsi ?? 'Kami menyediakan berbagai layanan berkualitas tinggi untuk memenuhi kebutuhan bisnis Anda.' }}</textarea>
                                                    <small class="text-muted">Deskripsi pada bagian hero dengan foto latar</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="gambar_latar" class="form-label"><strong>Gambar Latar Hero</strong></label>
                                                    <input type="file" class="form-control" id="gambar_latar" name="gambar_latar" accept="image/*">
                                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Untuk latar belakang hero section.</small>
                                                </div>
                                                @if($headerLayanan && $headerLayanan->gambar_latar)
                                                    <div class="mt-3">
                                                        <label class="form-label">Gambar Saat Ini:</label>
                                                        <div>
                                                            <img src="{{ Storage::url($headerLayanan->gambar_latar) }}" 
                                                                 alt="Header Background" class="img-thumbnail" style="max-width: 300px;">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- SECTION 2: MAIN FEATURES (Bagian Our Main Features tanpa foto) -->
                                        <hr class="my-4">
                                        <div class="alert alert-success mb-4">
                                            <h6 class="mb-2"><i class="fas fa-star me-2"></i><strong>SECTION 2: OUR MAIN FEATURES</strong></h6>
                                            <small>Bagian "Our Main Features" di bawah hero section (tanpa foto latar)</small>
                                        </div>
                                        
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="judul_main_features" class="form-label"><strong>Judul Main Features</strong></label>
                                                    <input type="text" class="form-control" id="judul_main_features" name="judul_main_features" 
                                                           value="{{ $headerLayanan->judul_main_features ?? 'Our Main Features' }}" required>
                                                    <small class="text-muted">Contoh: "Our Main Features"</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi_main_features" class="form-label"><strong>Deskripsi Main Features</strong></label>
                                                    <textarea class="form-control" id="deskripsi_main_features" name="deskripsi_main_features" rows="3" required>{{ $headerLayanan->deskripsi_main_features ?? 'Kami menyediakan berbagai layanan berkualitas tinggi dengan teknologi terdepan dan tim berpengalaman untuk membantu mengembangkan bisnis Anda. alda' }}</textarea>
                                                    <small class="text-muted">Deskripsi untuk section "Our Main Features" (BEDA dengan deskripsi hero)</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Status dan Submit -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" 
                                                               {{ ($headerLayanan->status_aktif ?? true) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_aktif">
                                                            <strong>Status Aktif</strong>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn bg-gradient-primary btn-lg">
                                            <i class="fas fa-save me-2"></i>Save Service Header
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Fitur Utama Tab -->
                        <div class="tab-pane fade" id="fitur-utama" role="tabpanel">
                            <div class="row">
                                <!-- Form Tambah Fitur -->
                                <div class="col-md-4">
                                    <div class="card border">
                                        <div class="card-header bg-transparent">
                                            <h5 class="card-title mb-0">Tambah Fitur Utama</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('adminui.services.fitur-utama') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="judul_fitur" class="form-label">Judul Fitur</label>
                                                    <input type="text" class="form-control" id="judul_fitur" name="judul_fitur" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi_fitur" class="form-label">Deskripsi Fitur</label>
                                                    <textarea class="form-control" id="deskripsi_fitur" name="deskripsi_fitur" rows="3" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ikon_fitur" class="form-label">Ikon Fitur</label>
                                                    <input type="file" class="form-control" id="ikon_fitur" name="ikon_fitur" accept="image/*">
                                                    <small class="form-text text-muted">Format: JPG, PNG, GIF, SVG. Maksimal 2MB.</small>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="status_aktif_fitur" name="status_aktif" checked>
                                                        <label class="form-check-label" for="status_aktif_fitur">
                                                            Status Aktif
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn bg-gradient-primary">
                                                    <i class="fas fa-plus me-2"></i>Add Feature
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- List Fitur -->
                                <div class="col-md-8" id="daftar-fitur-utama">
                                    <div class="card border">
                                        <div class="card-header bg-transparent">
                                            <h5 class="card-title mb-0">Daftar Fitur Utama</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($fiturUtamas->count() > 0)
                                                <div class="row">
                                                    @foreach($fiturUtamas as $fitur)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card h-100">
                                                                <div class="card-body">
                                                                    @if($fitur->ikon_fitur)
                                                                        <div class="text-center mb-3">
                                                                            <img src="{{ Storage::url($fitur->ikon_fitur) }}" 
                                                                                 alt="Icon" class="img-thumbnail" style="max-width: 80px;">
                                                                        </div>
                                                                    @endif
                                                                    <h6 class="card-title">{{ $fitur->judul_fitur }}</h6>
                                                                    <p class="card-text">{{ $fitur->deskripsi_fitur }}</p>
                                                                    <div class="mb-2">
                                                                        <span class="badge badge-sm {{ $fitur->status_aktif ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                                            <i class="fas {{ $fitur->status_aktif ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                                            {{ $fitur->status_aktif ? 'AKTIF' : 'TIDAK AKTIF' }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <a href="javascript:;" class="badge badge-sm bg-gradient-dark" 
                                                                           data-bs-toggle="modal" data-bs-target="#editFiturModal{{ $fitur->id }}" title="Edit">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </a>
                                                                        <a href="javascript:;" class="badge badge-sm bg-gradient-danger" 
                                                                           onclick="deleteFitur({{ $fitur->id }})" title="Hapus">
                                                                            <i class="fas fa-trash"></i> Hapus
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Edit Modal for Fitur -->
                                                        <div class="modal fade" id="editFiturModal{{ $fitur->id }}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Fitur Utama</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <form action="{{ route('adminui.services.fitur-utama.update', $fitur->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label for="edit_judul_fitur{{ $fitur->id }}" class="form-label">Judul Fitur</label>
                                                                                <input type="text" class="form-control" id="edit_judul_fitur{{ $fitur->id }}" 
                                                                                       name="judul_fitur" value="{{ $fitur->judul_fitur }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_deskripsi_fitur{{ $fitur->id }}" class="form-label">Deskripsi Fitur</label>
                                                                                <textarea class="form-control" id="edit_deskripsi_fitur{{ $fitur->id }}" 
                                                                                          name="deskripsi_fitur" rows="3" required>{{ $fitur->deskripsi_fitur }}</textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_ikon_fitur{{ $fitur->id }}" class="form-label">Ikon Fitur</label>
                                                                                <input type="file" class="form-control" id="edit_ikon_fitur{{ $fitur->id }}" 
                                                                                       name="ikon_fitur" accept="image/*">
                                                                                @if($fitur->ikon_fitur)
                                                                                    <div class="mt-2">
                                                                                        <img src="{{ Storage::url($fitur->ikon_fitur) }}" 
                                                                                             alt="Current Icon" class="img-thumbnail" style="max-width: 100px;">
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" 
                                                                                           id="edit_status_aktif_fitur{{ $fitur->id }}" name="status_aktif" 
                                                                                           {{ $fitur->status_aktif ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="edit_status_aktif_fitur{{ $fitur->id }}">
                                                                                        Status Aktif
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn bg-gradient-primary">
                                                                                <i class="fas fa-save me-2"></i>Save Changes
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-5">
                                                    <div class="mb-3">
                                                        <i class="fas fa-star text-secondary opacity-6" style="font-size: 4rem;"></i>
                                                    </div>
                                                    <h5 class="text-muted mb-2">Belum Ada Fitur Utama</h5>
                                                    <p class="text-sm text-muted">Tambahkan fitur utama untuk layanan Anda</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Layanan Tab -->
                        <div class="tab-pane fade" id="daftar-layanan" role="tabpanel">
                            <div class="row">
                                <!-- Form Tambah Layanan -->
                                <div class="col-md-4">
                                    <div class="card border">
                                        <div class="card-header bg-transparent">
                                            <h5 class="card-title mb-0">Tambah Daftar Layanan</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('adminui.services.daftar-layanan') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nama_layanan" class="form-label">Nama Layanan</label>
                                                    <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi_layanan" class="form-label">Deskripsi Layanan</label>
                                                    <textarea class="form-control" id="deskripsi_layanan" name="deskripsi_layanan" rows="3" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga_layanan" class="form-label">Harga Layanan</label>
                                                    <input type="text" class="form-control" id="harga_layanan" name="harga_layanan" 
                                                           placeholder="Contoh: Rp 500.000 atau Gratis Konsultasi">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar_layanan" class="form-label">Gambar Layanan</label>
                                                    <input type="file" class="form-control" id="gambar_layanan" name="gambar_layanan" 
                                                           accept="image/*" onchange="checkFileSize(this, 0.3)">
                                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. <strong>Maksimal 300KB</strong>.</small>
                                                    <div class="invalid-feedback" id="gambar_layanan_error"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="status_aktif_layanan" name="status_aktif" checked>
                                                        <label class="form-check-label" for="status_aktif_layanan">
                                                            Status Aktif
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn bg-gradient-primary">
                                                    <i class="fas fa-plus me-2"></i>Add Service
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- List Layanan -->
                                <div class="col-md-8" id="daftar-layanan-list">
                                    <div class="card border">
                                        <div class="card-header bg-transparent">
                                            <h5 class="card-title mb-0">Daftar Layanan</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($daftarLayanans->count() > 0)
                                                <div class="row">
                                                    @foreach($daftarLayanans as $layanan)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card h-100">
                                                                @if($layanan->gambar_layanan)
                                                                    <img src="{{ Storage::url($layanan->gambar_layanan) }}" 
                                                                         class="card-img-top" alt="Service Image" style="height: 150px; object-fit: cover;">
                                                                @endif
                                                                <div class="card-body">
                                                                    <h6 class="card-title">{{ $layanan->nama_layanan }}</h6>
                                                                    <p class="card-text">{{ $layanan->deskripsi_layanan }}</p>
                                                                    @if($layanan->harga_layanan)
                                                                        <p class="text-primary fw-bold">{{ $layanan->harga_layanan }}</p>
                                                                    @endif
                                                                    <div class="mb-2">
                                                                        <span class="badge badge-sm {{ $layanan->status_aktif ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                                            <i class="fas {{ $layanan->status_aktif ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                                            {{ $layanan->status_aktif ? 'AKTIF' : 'TIDAK AKTIF' }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <a href="javascript:;" class="badge badge-sm bg-gradient-dark" 
                                                                           data-bs-toggle="modal" data-bs-target="#editLayananModal{{ $layanan->id }}" title="Edit">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </a>
                                                                        <a href="javascript:;" class="badge badge-sm bg-gradient-danger" 
                                                                           onclick="deleteLayanan({{ $layanan->id }})" title="Hapus">
                                                                            <i class="fas fa-trash"></i> Hapus
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Edit Modal for Layanan -->
                                                        <div class="modal fade" id="editLayananModal{{ $layanan->id }}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Daftar Layanan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <form action="{{ route('adminui.services.daftar-layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label for="edit_nama_layanan{{ $layanan->id }}" class="form-label">Nama Layanan</label>
                                                                                <input type="text" class="form-control" id="edit_nama_layanan{{ $layanan->id }}" 
                                                                                       name="nama_layanan" value="{{ $layanan->nama_layanan }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_deskripsi_layanan{{ $layanan->id }}" class="form-label">Deskripsi Layanan</label>
                                                                                <textarea class="form-control" id="edit_deskripsi_layanan{{ $layanan->id }}" 
                                                                                          name="deskripsi_layanan" rows="3" required>{{ $layanan->deskripsi_layanan }}</textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_harga_layanan{{ $layanan->id }}" class="form-label">Harga Layanan</label>
                                                                                <input type="text" class="form-control" id="edit_harga_layanan{{ $layanan->id }}" 
                                                                                       name="harga_layanan" value="{{ $layanan->harga_layanan }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_gambar_layanan{{ $layanan->id }}" class="form-label">Gambar Layanan</label>
                                                                                <input type="file" class="form-control" id="edit_gambar_layanan{{ $layanan->id }}" 
                                                                                       name="gambar_layanan" accept="image/*" 
                                                                                       onchange="checkFileSize(this, 0.3)">
                                                                                <small class="form-text text-muted">Format: JPG, PNG, GIF. <strong>Maksimal 300KB</strong>.</small>
                                                                                <div class="invalid-feedback" id="edit_gambar_layanan{{ $layanan->id }}_error"></div>
                                                                                @if($layanan->gambar_layanan)
                                                                                    <div class="mt-2">
                                                                                        <img src="{{ Storage::url($layanan->gambar_layanan) }}" 
                                                                                             alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" 
                                                                                           id="edit_status_aktif_layanan{{ $layanan->id }}" name="status_aktif" 
                                                                                           {{ $layanan->status_aktif ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="edit_status_aktif_layanan{{ $layanan->id }}">
                                                                                        Status Aktif
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn bg-gradient-primary">
                                                                                <i class="fas fa-save me-2"></i>Save Changes
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-5">
                                                    <div class="mb-3">
                                                        <i class="fas fa-list text-secondary opacity-6" style="font-size: 4rem;"></i>
                                                    </div>
                                                    <h5 class="text-muted mb-2">Belum Ada Daftar Layanan</h5>
                                                    <p class="text-sm text-muted">Tambahkan layanan yang Anda tawarkan</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Information Card -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-lg me-3">
                                <i class="fas fa-info-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Informasi Services</h6>
                                <p class="text-sm mb-0">
                                    Kelola seluruh konten halaman layanan Anda di sini. Gunakan Header Layanan untuk mengatur tampilan hero section, 
                                    Fitur Utama untuk menampilkan keunggulan layanan, dan Daftar Layanan untuk menampilkan semua layanan yang Anda tawarkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden forms for delete operations -->
<div id="deleteFormsContainer" style="display: none;"></div>

<script>
// Function to delete Fitur Utama
function deleteFitur(id) {
    if (confirm('Apakah Anda yakin ingin menghapus fitur ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ url("adminui/services/fitur-utama") }}/' + id;
        form.innerHTML = '@csrf @method("DELETE")';
        form.style.display = 'none';
        
        document.getElementById('deleteFormsContainer').appendChild(form);
        form.submit();
    }
}

// Function to delete Daftar Layanan
function deleteLayanan(id) {
    if (confirm('Apakah Anda yakin ingin menghapus layanan ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ url("adminui/services/daftar-layanan") }}/' + id;
        form.innerHTML = '@csrf @method("DELETE")';
        form.style.display = 'none';
        
        document.getElementById('deleteFormsContainer').appendChild(form);
        form.submit();
    }
}

// Function to check file size before upload
function checkFileSize(input, maxSizeMB) {
    const file = input.files[0];
    const errorDiv = document.getElementById(input.id + '_error');
    
    if (file) {
        const fileSizeKB = file.size / 1024;
        const fileSizeMB = file.size / (1024 * 1024);
        
        if (fileSizeMB > maxSizeMB) {
            input.classList.add('is-invalid');
            if (maxSizeMB < 1) {
                const maxKB = maxSizeMB * 1024;
                errorDiv.textContent = `File terlalu besar! Maksimal ${maxKB}KB. Ukuran file Anda: ${fileSizeKB.toFixed(0)}KB. Silakan compress gambar terlebih dahulu.`;
            } else {
                errorDiv.textContent = `File terlalu besar! Maksimal ${maxSizeMB}MB. Ukuran file Anda: ${fileSizeMB.toFixed(2)}MB. Silakan compress gambar terlebih dahulu.`;
            }
            errorDiv.style.display = 'block';
            input.value = ''; // Clear the file input
            
            // Show suggestion for compression
            setTimeout(() => {
                alert('Tips: Gunakan tools online seperti tinypng.com atau compressor.io untuk mengecilkan ukuran gambar.');
            }, 500);
            
            return false;
        } else {
            input.classList.remove('is-invalid');
            errorDiv.style.display = 'none';
            return true;
        }
    }
}

@push('js')
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Check hash on page load
    if (window.location.hash) {
        const hash = window.location.hash.replace('#', '');
        
        // Activate the correct tab
        const tabButton = document.getElementById(hash + '-tab');
        
        if (tabButton) {
            // Click the tab to activate
            tabButton.click();
            
            // Wait for tab animation, then scroll
            setTimeout(function() {
                let targetId = null;
                
                if (hash === 'fitur-utama') {
                    targetId = 'daftar-fitur-utama';
                } else if (hash === 'daftar-layanan') {
                    targetId = 'daftar-layanan-list';
                }
                
                if (targetId) {
                    const target = document.getElementById(targetId);
                    
                    if (target) {
                        // Scroll dengan offset yang lebih besar
                        const yOffset = -150; // 150px dari top
                        const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
                        
                        window.scrollTo({
                            top: y,
                            behavior: 'smooth'
                        });
                        
                        // Flash effect untuk highlight section
                        target.style.transition = 'all 0.3s ease';
                        target.style.backgroundColor = '#f8f9fa';
                        setTimeout(function() {
                            target.style.backgroundColor = '';
                        }, 1000);
                    }
                }
            }, 600);
        }
    }
    
    // Listen for hash changes
    window.addEventListener('hashchange', function() {
        location.reload();
    });
});
</script>
@endpush
@endsection