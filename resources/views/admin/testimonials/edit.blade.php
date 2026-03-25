@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ __('messages.edit_testimonial') ?? 'Edit Testimonial' }}</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name <span class="text-danger">*</span></strong></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description <span class="text-danger">*</span></strong></label>
                    <textarea class="form-control rte-editor @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description', $testimonial->description) }}</textarea>
                    <small class="text-muted">Enter the testimonial message</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label"><strong>Designation / Position</strong></label>
                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $testimonial->designation) }}" placeholder="e.g., CEO, Manager">
                    @error('designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="company" class="form-label"><strong>Company / Organization</strong></label>
                    <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company', $testimonial->company) }}" placeholder="e.g., ABC Company">
                    @error('company')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_show" name="is_show" value="1" {{ old('is_show', $testimonial->is_show) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_show">
                        <strong>Show this testimonial on website</strong>
                    </label>
                </div>

                <div class="mb-3">
                    <label for="is_show" class="form-label"><strong>Show on Website</strong></label>
                    <select class="form-control @error('is_show') is-invalid @enderror" id="is_show" name="is_show">
                        <option value="">-- Select --</option>
                        <option value="1" {{ old('is_show', $testimonial->is_show ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_show', $testimonial->is_show ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_show')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
