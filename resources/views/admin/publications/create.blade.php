@extends('layouts.admin')

@section('title', 'Create Publication')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create Publication</h4>
    <a href="{{ route('admin.publications.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.publications.store') }}" enctype="multipart/form-data">
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
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="acts_and_rules" {{ old('category') == 'acts_and_rules' ? 'selected' : '' }}>Acts and Rules</option>
                        <option value="strategic_plan" {{ old('category') == 'strategic_plan' ? 'selected' : '' }}>Strategic Plan</option>
                        <option value="client_service_charter" {{ old('category') == 'client_service_charter' ? 'selected' : '' }}>Client Service Charter</option>
                        <option value="annual_report" {{ old('category') == 'annual_report' ? 'selected' : '' }}>Annual Report</option>
                    </select>
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Year</label>
                    <input type="number" name="year" class="form-control" value="{{ old('year') }}" min="2000" max="{{ date('Y') + 1 }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">File (PDF/DOC) *</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx" required>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" checked>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Create Publication</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
