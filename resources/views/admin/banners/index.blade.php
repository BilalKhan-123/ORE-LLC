@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.banners') ?? 'Banners' }}</h1> --}}
            <h1>Banners</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
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
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners ?? [] as $banner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($banner->title, 50) }}</td>
                            <td>
                                @if($banner->main_image)
                                    <img src="{{ asset('storage/'.$banner->main_image) }}" alt="{{ $banner->title }}" width="80" height="50" class="rounded" style="object-fit: cover;">
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if($banner->is_show)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST">
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
                            <td colspan="4" class="text-center text-muted py-4">
                                No records found. <a href="{{ route('admin.banners.create') }}">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($banners->hasPages())
            <div class="card-footer px-5">
                <div class="d-flex justify-content-center">
                    {{ $banners->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
