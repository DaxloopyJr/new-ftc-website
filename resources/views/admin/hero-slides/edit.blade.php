@extends('layouts.admin')

@section('title', 'Edit Hero Slide')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Hero Slide</h4>
    <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.hero-slides.update', $slide->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $slide->title) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slide->subtitle) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image <small class="text-muted">(leave blank to keep current)</small></label>
                    @if($slide->image_path)<div class="mb-2"><img src="{{ asset($slide->image_path) }}" style="height:60px;" class="rounded"></div>@endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $slide->button_text) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $slide->button_link) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slide->sort_order) }}">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                                {{-- Swahili (Kiswahili) fields --}}
                <div class="col-12 mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-0"><i class="bi bi-translate me-1"></i> Kiswahili (hiari — English itaonyeshwa kama wazi)</h6>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Kichwa (Kiswahili)</label>
                    <input type="text" name="title_sw" class="form-control" value="{{ old('title_sw', $slide->title_sw ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kichwa Kidogo (Kiswahili)</label>
                    <input type="text" name="subtitle_sw" class="form-control" value="{{ old('subtitle_sw', $slide->subtitle_sw ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Maelezo ya Kitufe (Kiswahili)</label>
                    <input type="text" name="button_text_sw" class="form-control" value="{{ old('button_text_sw', $slide->button_text_sw ?? '') }}">
                </div>
<div class="col-12"><button type="submit" class="btn btn-admin-primary">Update Slide</button></div>
            </div>
        </form>
    </div>
</div>
@endsection
