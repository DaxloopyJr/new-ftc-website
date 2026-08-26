@extends('layouts.admin')

@section('title', 'Create Info Library Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create Info Library Item</h4>
    <a href="{{ route('admin.info-library.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.info-library.store') }}" enctype="multipart/form-data">
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
                        <option value="case_digest" {{ old('category') == 'case_digest' ? 'selected' : '' }}>Case Digest</option>
                        <option value="decided_cases" {{ old('category') == 'decided_cases' ? 'selected' : '' }}>Decided Cases</option>
                        <option value="registered_cases" {{ old('category') == 'registered_cases' ? 'selected' : '' }}>Registered Cases</option>
                        <option value="cause_list" {{ old('category') == 'cause_list' ? 'selected' : '' }}>Cause List</option>
                        <option value="brochure" {{ old('category') == 'brochure' ? 'selected' : '' }}>Brochures</option>
                    </select>
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Case Number</label>
                    <input type="text" name="case_number" class="form-control" value="{{ old('case_number') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parties</label>
                    <input type="text" name="parties" class="form-control" value="{{ old('parties') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Decision Date</label>
                    <input type="date" name="decision_date" class="form-control" value="{{ old('decision_date') }}">
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
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" checked>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Create Item</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
