@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Edit Contact Section</h1>
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
            <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label"><strong>Address</strong><span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $contact->address) }}" required>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="map" class="form-label"><strong>Iframe (map) URL</strong><span class="text-danger">*</span></label>
                        <input required type="url" class="form-control @error('map') is-invalid @enderror" id="map" name="map" value="{{ old('map', $contact->map) }}">
                        @error('map') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                     <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
                       
                       <iframe style="border:0; width: 100%; height: 370px;" src="{{ old('map', $contact->map) }}" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="phone_1" class="form-label"><strong>Phone 1</strong><span class="text-danger">*</span></label>
                        <input required type="text" class="form-control @error('phone_1') is-invalid @enderror" id="phone_1" name="phone_1" value="{{ old('phone_1', $contact->phone_1) }}">
                        @error('phone_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone_2" class="form-label"><strong>Phone 2</strong></label>
                        <input type="text" class="form-control @error('phone_2') is-invalid @enderror" id="phone_2" name="phone_2" value="{{ old('phone_2', $contact->phone_2) }}">
                        @error('phone_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone_3" class="form-label"><strong>Phone 3</strong></label>
                        <input type="text" class="form-control @error('phone_3') is-invalid @enderror" id="phone_3" name="phone_3" value="{{ old('phone_3', $contact->phone_3) }}">
                        @error('phone_3') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="email_1" class="form-label"><strong>Email 1</strong><span class="text-danger">*</span></label>
                        <input required type="email" class="form-control @error('email_1') is-invalid @enderror" id="email_1" name="email_1" value="{{ old('email_1', $contact->email_1) }}">
                        @error('email_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email_2" class="form-label"><strong>Email 2</strong></label>
                        <input type="email" class="form-control @error('email_2') is-invalid @enderror" id="email_2" name="email_2" value="{{ old('email_2', $contact->email_2) }}">
                        @error('email_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email_3" class="form-label"><strong>Email 3</strong></label>
                        <input type="email" class="form-control @error('email_3') is-invalid @enderror" id="email_3" name="email_3" value="{{ old('email_3', $contact->email_3) }}">
                        @error('email_3') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description</strong></label>
                    <textarea class="form-control rte-editor @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description', $contact->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                {{-- <div class="mb-3">
                    <label for="all_text" class="form-label"><strong>Additional Text</strong></label>
                    <textarea class="form-control @error('all_text') is-invalid @enderror" id="all_text" name="all_text" rows="4">{{ old('all_text', $contact->all_text) }}</textarea>
                    @error('all_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                {{-- <div class="mb-3">
                    <label for="image" class="form-label"><strong>Main Image</strong></label>
                    <input type="file" class="form-control @error('main_image') is-invalid @enderror" id="image" name="main_image" accept="image/*">
                    @if($contact->main_image)
                        <div class="mt-2">
                            <small class="text-muted">Current Image:</small>
                            <a target="__BLANK" class="glightbox" data-gallery="images-gallery" href="{{ asset($contact->main_image) }}">
                                <img src="{{ asset($contact->main_image) }}" alt="{{ $contact->title }}" width="200" class="rounded d-block mt-1">
                            </a>
                        </div>
                    @endif
                    @error('main_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="is_show" class="form-label"><strong>Show on Website</strong></label>
                    <select class="form-control @error('is_show') is-invalid @enderror" id="is_show" name="is_show">
                        <option value="1" {{ old('is_show', $contact->is_show ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_show', $contact->is_show ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_show') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
