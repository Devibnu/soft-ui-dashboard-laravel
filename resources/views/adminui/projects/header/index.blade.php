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
                                <h6 class="text-white text-capitalize ps-3">Header Projects (Our Recent Projects)</h6>
                                <p class="text-white text-xs ps-3 mb-0">Kelola judul dan deskripsi section projects di homepage</p>
                            </div>
                            @if(!$headerProjects)
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.projects.header.create') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Header
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    @if(session('success'))
                        <div class="alert alert-success text-white font-weight-bold">
                            <i class="fas fa-check me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger text-white font-weight-bold">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @if($headerProjects)
                        <div class="card mt-3">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Data Header Projects</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('adminui.projects.header.edit', $headerProjects->id) }}" class="btn btn-sm bg-gradient-info mb-0">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('adminui.projects.header.destroy', $headerProjects->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus header ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-gradient-danger mb-0">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-weight-bold">Judul Section:</label>
                                            <p class="text-sm mb-0">{{ $headerProjects->judul_section }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-weight-bold">Deskripsi Section:</label>
                                            <p class="text-sm mb-0">{{ $headerProjects->deskripsi_section ?: '-' }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-weight-bold">Status:</label>
                                            @if($headerProjects->status_aktif)
                                                <span class="badge bg-gradient-success">
                                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-gradient-secondary">
                                                    <i class="fas fa-times-circle me-1"></i>Nonaktif
                                                </span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-secondary">Dibuat: {{ $headerProjects->created_at->format('d M Y H:i') }}</small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-secondary">Diupdate: {{ $headerProjects->updated_at->format('d M Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="card mt-3">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Preview di Homepage</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="text-center">
                                    <h2 class="mb-3" style="color: #333;">{{ $headerProjects->judul_section }}</h2>
                                    <p class="text-muted">{{ $headerProjects->deskripsi_section }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info text-white font-weight-bold text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            Belum ada header projects. Silakan tambah header terlebih dahulu.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
