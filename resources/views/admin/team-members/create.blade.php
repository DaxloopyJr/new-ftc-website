@extends('layouts.admin')

@section('title', 'Create Team Member')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create Team Member</h4>
    <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}" placeholder="e.g. Chairperson, Registrar">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Designation *</label>
                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" required value="{{ old('designation') }}">
                    @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-select" required>
                        <option value="tribunal_member" {{ old('category') == 'tribunal_member' ? 'selected' : '' }}>Tribunal Member</option>
                        <option value="management" {{ old('category') == 'management' ? 'selected' : '' }}>Management</option>
                        <option value="secretariat" {{ old('category') == 'secretariat' ? 'selected' : '' }}>Secretariat</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4">{{ old('bio') }}</textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                                {{-- Swahili (Kiswahili) fields --}}
                <div class="col-12 mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-0"><i class="bi bi-translate me-1"></i> Kiswahili (hiari — English itaonyeshwa kama wazi)</h6>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jina (Kiswahili)</label>
                    <input type="text" name="name_sw" class="form-control" value="{{ old('name_sw') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cheo (Kiswahili)</label>
                    <input type="text" name="title_sw" class="form-control" value="{{ old('title_sw') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nafasi (Kiswahili)</label>
                    <input type="text" name="designation_sw" class="form-control" value="{{ old('designation_sw') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Wasifu (Kiswahili)</label>
                    <textarea name="bio_sw" class="form-control" rows="4">{{ old('bio_sw') }}</textarea>
                </div>
<div class="col-12"><button type="submit" class="btn btn-admin-primary">Create Member</button></div>
            </div>
        </form>
    </div>
</div>
@endsection
