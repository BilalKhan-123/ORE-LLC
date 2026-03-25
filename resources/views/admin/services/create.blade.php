@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.create_service') ?? 'Create Service' }}</h1> --}}
            <h1>Create Service</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label"><strong>Service Name <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label"><strong>Sub title </label>
                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="sub_title" name="sub_title" value="{{ old('sub_title') }}">
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="col-md-12 mb-3">
                        <label for="description" class="form-label"><strong>Description <span class="text-danger">*</span></strong></label>
                        <textarea class="form-control rte-editor" id="description" name="description" rows="5">
                            {{ old('description') }}
                        </textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Main Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    <small class="text-muted">Recommended size: 1920x600px</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo </label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                    {{-- <small class="text-muted">Recommended size: 1920x600px</small> --}}
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input @error('is_featured') is-invalid @enderror" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            <strong>Mark as Featured Service</strong>
                        </label>
                    </div>
                    @error('is_featured')
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
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
