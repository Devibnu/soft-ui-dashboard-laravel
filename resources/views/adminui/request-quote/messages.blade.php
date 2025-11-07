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
                                <h6 class="text-white text-capitalize ps-3">Request Quote Messages</h6>
                                <p class="text-white text-xs ps-3 mb-0">Manage incoming quote requests</p>
                            </div>
                            <div class="col-auto pe-3">
                                <a href="{{ route('adminui.request-quote.index') }}" class="btn btn-outline-light btn-sm mb-0">
                                    <i class="fas fa-cog"></i>&nbsp;&nbsp;Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    @if(session('success'))
                        <div class="alert alert-success mx-4 text-white font-weight-bold">
                            <i class="fas fa-check me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if($messages->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <div class="avatar avatar-sm me-3 bg-gradient-primary">
                                                        <span class="text-white text-xs">{{ substr($message->first_name, 0, 1) }}{{ substr($message->last_name, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $message->first_name }} {{ $message->last_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($message->message, 50) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $message->phone }}</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-info">{{ $message->service }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $message->created_at->format('d M Y') }}<br>
                                                <small>{{ $message->created_at->diffForHumans() }}</small>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button type="button" class="badge badge-sm bg-gradient-info me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}" title="View">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <form action="{{ route('adminui.request-quote.messages.destroy', $message->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this message?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm bg-gradient-danger" title="Delete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal for message details -->
                                    <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Quote Request Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-2">
                                                        <div class="col-4"><strong>Name:</strong></div>
                                                        <div class="col-8">{{ $message->first_name }} {{ $message->last_name }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4"><strong>Phone:</strong></div>
                                                        <div class="col-8">{{ $message->phone }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4"><strong>Service:</strong></div>
                                                        <div class="col-8">{{ $message->service }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4"><strong>Date:</strong></div>
                                                        <div class="col-8">{{ $message->created_at->format('d M Y, H:i') }}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><strong>Message:</strong></div>
                                                        <div class="col-12 mt-2">
                                                            <p class="text-sm">{{ $message->message }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="alert alert-info mx-4 text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            No messages received yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
