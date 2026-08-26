@extends('layouts.admin')

@section('title', 'Edit Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Page</h4>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $page->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parent Page</label>
                    <select name="parent_id" class="form-select">
                        <option value="">None (Top Level)</option>
                        @foreach($parentPages as $pp)
                            <option value="{{ $pp->id }}" {{ old('parent_id', $page->parent_id) == $pp->id ? 'selected' : '' }}>{{ $pp->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $page->sort_order) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="10">{{ old('content', $page->content) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <textarea name="meta_keywords" class="form-control" rows="2">{{ old('meta_keywords', $page->meta_keywords) }}</textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Update Page</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
