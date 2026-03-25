@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.edit_about') ?? 'Edit About Section' }}</h1> --}}
            <h1>Edit About Section</h1>
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

     @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label"><strong>Title <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $about->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="subtitle" class="form-label"><strong>Subtitle</strong></label>
                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="subtitle" name="sub_title" value="{{ old('sub_title', $about->sub_title) }}">
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description</strong></label>
                    <textarea class="form-control rte-editor @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $about->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label"><strong>Image</strong></label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @if($about->main_image)
                            <div class="mt-2">
                                <small class="text-muted">Current Image:</small>
                                <a target="__BLANK" class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/'.$about->main_image) }}"><img src="{{ asset('storage/'.$about->main_image) }}" alt="{{ $about->title }}" width="200" class="rounded d-block mt-1"></a>
                            </div>
                        @endif
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="video_url" class="form-label"><strong>Video URL</strong></label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', $about->video_url) }}">
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="is_show" class="form-label"><strong>Show on Website</strong></label>
                    <select class="form-control @error('is_show') is-invalid @enderror" id="is_show" name="is_show">
                        <option value="">-- Select --</option>
                        <option value="1" {{ old('is_show', $about->is_show ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_show', $about->is_show ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_show')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
