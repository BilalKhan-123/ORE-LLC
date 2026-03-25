@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.services') ?? 'Services' }}</h1> --}}
            <h1>Services</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __('messages.add_new') ?? 'Add New' }}
            </a>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th width="100">Featured</th>
                        <th width="150">Show on website</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services ?? [] as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $service->title }}</td>
                            <td> 
                                @if($service->logo)
                                    <img src="{{ asset('storage/'.$service->logo) }}" 
                                         alt="{{ $service->title }}" 
                                         width="80" height="60" 
                                         class="rounded" 
                                         style="object-fit: cover;">
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if($service->is_featured)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                                    
                            <td>
                                @if($service->is_show)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                 </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No records found. <a href="{{ route('admin.services.create') }}">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
            <div class="card-footer px-5">
                <div class="d-flex justify-content-center">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
