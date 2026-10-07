@extends('layouts.admin')

@section('title', 'Create News')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create News</h4>
    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="10">{{ old('content') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" checked>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                                                <div class="col-12 form-check ms-2">
                    <input type="hidden" name="is_announcement" value="0">
                    <input type="checkbox" name="is_announcement" value="1" class="form-check-input" id="is_announcement" {{ old('is_announcement') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_announcement">Announcement (shows in the Announcements card &amp; sidebar)</label>
                </div>

                {{-- Swahili (Kiswahili) fields --}}
                <div class="col-12 mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-0"><i class="bi bi-translate me-1"></i> Kiswahili (hiari — English itaonyeshwa kama wazi)</h6>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Kichwa (Kiswahili)</label>
                    <input type="text" name="title_sw" class="form-control" value="{{ old('title_sw') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mahali (Kiswahili)</label>
                    <input type="text" name="location_sw" class="form-control" value="{{ old('location_sw') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Muhtasari (Kiswahili)</label>
                    <textarea name="excerpt_sw" class="form-control" rows="2">{{ old('excerpt_sw') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Yaliyomo (Kiswahili)</label>
                    <textarea name="content_sw" class="form-control" rows="10">{{ old('content_sw') }}</textarea>
                </div>
<div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Create News</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection