@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.create_banner') ?? 'Create Banner' }}</h1> --}}
            <h1>Create Banner</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="5"
                    >{{ old('description') }}</textarea>

                    <small id="wordCount" class="text-muted">0 / 200 words</small>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    <small class="text-muted">Recommended size: 1920x600px</small>
                    @error('image')
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
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



<script>
document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.getElementById("description");
    const wordCountDisplay = document.getElementById("wordCount");
    const maxWords = 200;

    textarea.addEventListener("input", function () {
        // Count words (split by spaces, filter out empty strings)
        let words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
        let count = words.length;

        // Update counter
        wordCountDisplay.textContent = count + " / " + maxWords + " words";

        // Enforce limit
        if (count > maxWords) {
            // Trim to max words
            textarea.value = words.slice(0, maxWords).join(" ");
            wordCountDisplay.textContent = maxWords + " / " + maxWords + " words";
        }
    });
});
</script>