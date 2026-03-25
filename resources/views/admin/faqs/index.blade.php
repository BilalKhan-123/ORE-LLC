@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.faqs') ?? 'FAQs' }}</h1> --}}
            <h1>Frequently Asked Questions</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
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
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Show on website</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs ?? [] as $faq)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($faq->question, 100) }}</td>
                            <td><p title="{{ $faq->short_answer }}">{{ Str::limit($faq->short_answer, 300) }}</p></td>
                            <td>
                                @if($faq->is_show)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="3" class="text-center text-muted py-4">
                                No records found. <a href="{{ route('admin.faqs.create') }}">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
