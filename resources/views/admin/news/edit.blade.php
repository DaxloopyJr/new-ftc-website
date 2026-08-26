@extends('layouts.admin')

@section('title', 'Edit News')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit News</h4>
    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.news.update', $newsItem->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $newsItem->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $newsItem->slug) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $newsItem->event_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $newsItem->location) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $newsItem->excerpt) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="10">{{ old('content', $newsItem->content) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Featured Image</label>
                    @if($newsItem->featured_image)
                        <div class="mb-2"><img src="{{ asset($newsItem->featured_image) }}" style="height:80px;" class="rounded"></div>
                    @endif
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" {{ old('is_published', $newsItem->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Update News</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection