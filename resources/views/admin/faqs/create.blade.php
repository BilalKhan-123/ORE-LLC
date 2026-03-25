@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.create_faq') ?? 'Create FAQ' }}</h1> --}}
            <h1>Create FAQ</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Validation Errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="question" class="form-label"><strong>Question <span class="text-danger">*</span></strong></label>
                    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" required>
                    @error('question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="short_answer" class="form-label"><strong>Short Answer <span class="text-danger">*</span></strong></label>
                    <textarea class="form-control @error('short_answer') is-invalid @enderror" id="short_answer" name="short_answer" rows="5" required>{{ old('short_answer') }}</textarea>
                    @error('short_answer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="long_answer" class="form-label"><strong>Long Answer</strong></label>
                    <textarea class="form-control   @error('long_answer') is-invalid @enderror" id="long_answer" name="long_answer" rows="10">{{ old('long_answer') }}</textarea>
                    @error('long_answer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_show" class="form-label"><strong>Show on Website</strong></label>
                    <select class="form-control @error('is_show') is-invalid @enderror" id="is_show" name="is_show">
                        <option value="">-- Select --</option>
                        <option value="1" {{ old('is_show', 0) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_show', 0) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_show')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create
                    </button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
