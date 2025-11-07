@extends('adminui.layouts.auth')

@section('title', 'Service List')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Service Quote List</h6>
                        <a href="{{ route('adminui.request-quote.services.create') }}" class="btn btn-primary btn-sm mb-0">
                            <i class="material-icons text-sm">add</i> Add New Service
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if(session('success'))
                    <div class="alert alert-success mx-4 mt-3" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if($services->count() > 0)
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Slug</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $service->nama_service }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{ $service->slug }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <input class="form-check-input status-toggle" type="checkbox" 
                                                   data-id="{{ $service->id }}" 
                                                   {{ $service->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('adminui.request-quote.services.edit', $service->id) }}" 
                                           class="btn btn-link text-secondary px-2 mb-0" title="Edit">
                                            <i class="material-icons text-sm">edit</i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-link text-danger px-2 mb-0 delete-btn" 
                                                data-id="{{ $service->id }}" title="Delete">
                                            <i class="material-icons text-sm">delete</i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center py-5">
                            <i class="material-icons text-muted" style="font-size: 48px;">list_alt</i>
                            <p class="text-muted">No services found</p>
                            <a href="{{ route('adminui.request-quote.services.create') }}" class="btn btn-primary btn-sm">
                                <i class="material-icons text-sm">add</i> Add New Service
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle
    document.querySelectorAll('.status-toggle').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const serviceId = this.dataset.id;
            const isChecked = this.checked;
            
            fetch(`/adminui/request-quote/services/${serviceId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                // Revert checkbox if error
                checkbox.checked = !isChecked;
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update status'
                });
            });
        });
    });

    // Delete service
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const serviceId = this.dataset.id;
            
            Swal.fire({
                title: 'Delete Service?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/adminui/request-quote/services/${serviceId}`, {
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
                                title: 'Deleted!',
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
                            text: 'Failed to delete service'
                        });
                    });
                }
            });
        });
    });
});
</script>
@endsection