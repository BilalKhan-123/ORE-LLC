@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ __('messages.testimonials') ?? 'Testimonials' }}</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
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
                        <th width="50">ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th width="80">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials ?? [] as $testimonial)
                        <tr>
                            <td>{{ $testimonial->id }}</td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ Str::limit($testimonial->description, 50) }}</td>
                            <td>
                                @if($testimonial->is_show)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No records found. <a href="{{ route('admin.testimonials.create') }}">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($testimonials instanceof \Illuminate\Pagination\Paginator)
        <div class="mt-4">
            {{ $testimonials->links() }}
        </div>
    @endif
</div>
@endsection
