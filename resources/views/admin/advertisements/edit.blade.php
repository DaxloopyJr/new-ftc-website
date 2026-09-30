@extends('layouts.admin')

@section('title', 'Edit Advertisement')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Advertisement</h4>
    <a href="{{ route('admin.advertisements.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.advertisements.update', $ad->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $ad->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image <small class="text-muted">(leave blank to keep current)</small></label>
                    @if($ad->image_path)<div class="mb-2"><img src="{{ asset($ad->image_path) }}" style="height:60px;" class="rounded"></div>@endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link URL</label>
                    <input type="url" name="link_url" class="form-control" value="{{ old('link_url', $ad->link_url) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Position *</label>
                    <select name="position" class="form-select" required>
                        <option value="home_top" {{ old('position', $ad->position) == 'home_top' ? 'selected' : '' }}>Home Top</option>
                        <option value="home_middle" {{ old('position', $ad->position) == 'home_middle' ? 'selected' : '' }}>Home Middle</option>
                        <option value="home_bottom" {{ old('position', $ad->position) == 'home_bottom' ? 'selected' : '' }}>Home Bottom</option>
                        <option value="sidebar" {{ old('position', $ad->position) == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Start Date *</label>
                    <input type="date" name="start_date" class="form-control" required value="{{ old('start_date', $ad->start_date->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">End Date *</label>
                    <input type="date" name="end_date" class="form-control" required value="{{ old('end_date', $ad->end_date->format('Y-m-d')) }}">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $ad->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                                {{-- Swahili (Kiswahili) fields --}}
                <div class="col-12 mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-0"><i class="bi bi-translate me-1"></i> Kiswahili (hiari — English itaonyeshwa kama wazi)</h6>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Kichwa (Kiswahili)</label>
                    <input type="text" name="title_sw" class="form-control" value="{{ old('title_sw', $ad->title_sw ?? '') }}">
                </div>
<div class="col-12"><button type="submit" class="btn btn-admin-primary">Update Ad</button></div>
            </div>
        </form>
    </div>
</div>
@endsection
