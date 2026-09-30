@extends('layouts.admin')

@section('title', 'Upload Media')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Upload Media</h4>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">File *</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="image/*,video/*" required>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">File Type *</label>
                    <select name="file_type" class="form-select" required>
                        <option value="image" {{ old('file_type') == 'image' ? 'selected' : '' }}>Image</option>
                        <option value="video" {{ old('file_type') == 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-select" required>
                        <option value="photo_gallery" {{ old('category') == 'photo_gallery' ? 'selected' : '' }}>Photo Gallery</option>
                        <option value="video_gallery" {{ old('category') == 'video_gallery' ? 'selected' : '' }}>Video Gallery</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1">
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" checked>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                                {{-- Swahili (Kiswahili) fields --}}
                <div class="col-12 mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-0"><i class="bi bi-translate me-1"></i> Kiswahili (hiari — English itaonyeshwa kama wazi)</h6>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Kichwa (Kiswahili)</label>
                    <input type="text" name="title_sw" class="form-control" value="{{ old('title_sw') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Maelezo (Kiswahili)</label>
                    <textarea name="description_sw" class="form-control" rows="3">{{ old('description_sw') }}</textarea>
                </div>
<div class="col-12"><button type="submit" class="btn btn-admin-primary">Upload Media</button></div>
            </div>
        </form>
    </div>
</div>
@endsection
