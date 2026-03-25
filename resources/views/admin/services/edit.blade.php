@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.edit_service') ?? 'Edit Service' }}</h1> --}}
            <h1>Edit Service</h1>
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
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label"><strong>Service Name <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="sub_title" class="form-label"><strong>Sub title </label>
                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" name="sub_title" value="{{ old('sub_title',$service->sub_title) }}">
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description <span class="text-danger">*</span></strong></label>
                    <textarea class="form-control rte-editor @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Main Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    <small class="text-muted">Recommended size: 1920x600px. Leave empty to keep current image.</small>
                    @if($service->main_image)
                        <div class="mt-2">
                            <small class="text-muted">Current Image:</small>
                            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/'.$service->main_image) }}"><img src="{{ asset('storage/'.$service->main_image) }}" alt="{{ $service->title }}" width="200" class="rounded d-block mt-1"></a>
                        </div>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                    <small class="text-muted">Leave empty to keep current logo.</small>
                    @if($service->logo)
                        <div class="mt-2">
                            <small class="text-muted">Current Logo:</small>
                            <a target="__BLANK" class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/'.$service->logo) }}"><img src="{{ asset('storage/'.$service->logo) }}" alt="{{ $service->title }}" width="200" class="rounded d-block mt-1"></a>
                        </div>
                    @endif
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input @error('is_featured') is-invalid @enderror" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
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
                        <option value="1" {{ old('is_show', $service->is_show ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_show', $service->is_show ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_show')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
