@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create Page</h4>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug <small class="text-muted">(auto-generated)</small></label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parent Page</label>
                    <select name="parent_id" class="form-select">
                        <option value="">None (Top Level)</option>
                        @foreach($parentPages as $pp)
                            <option value="{{ $pp->id }}" {{ old('parent_id') == $pp->id ? 'selected' : '' }}>{{ $pp->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="10">{{ old('content') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <textarea name="meta_keywords" class="form-control" rows="2">{{ old('meta_keywords') }}</textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" checked>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                                                {{-- Organisation structure chart --}}
                <div class="col-12">
                    <label class="form-label">Organisation Structure Chart (image)</label>
                    <input type="file" name="org_chart_image" class="form-control" accept="image/*">
                    <small class="text-muted">Displayed on the page (e.g. organisation-structure). Optional.</small>
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
                    <label class="form-label">Yaliyomo (Kiswahili)</label>
                    <textarea name="content_sw" class="form-control" rows="10">{{ old('content_sw') }}</textarea>
                </div>
<div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Create Page</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
