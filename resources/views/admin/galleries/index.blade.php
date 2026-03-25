@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.galleries') ?? 'Galleries' }}</h1> --}}
            <h1>Gallery Images</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
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
                        <th>Title</th>
                        <th>Image</th>
                        <th>Show on website</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleries ?? [] as $gallery)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gallery->title }}</td>
                            <td>
                                @if($gallery->main_image)
                                    <a target="__BLANK" class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/'.$gallery->main_image) }}"><img width="200" src="{{ asset('storage/'.$gallery->main_image) }}" 
                                         alt="{{ $gallery->title }}" 
                                         width="80" height="60" 
                                         class="rounded" 
                                         style="object-fit: cover;">
                                    </a>
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if($gallery->is_show)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" 
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No records found. <a href="{{ route('admin.galleries.create') }}">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Proper Bootstrap 5 pagination --}}
        @if($galleries->hasPages())
            <div class="card-footer px-5">
                <div class="d-flex justify-content-center">
                    {{ $galleries->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
