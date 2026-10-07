@extends('layouts.admin')

@section('title', 'Edit Info Library Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Info Library Item</h4>
    <a href="{{ route('admin.info-library.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.info-library.update', $item->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $item->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $item->slug) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="case_digest" {{ old('category', $item->category) == 'case_digest' ? 'selected' : '' }}>Case Digest</option>
                        <option value="decided_cases" {{ old('category', $item->category) == 'decided_cases' ? 'selected' : '' }}>Decided Cases</option>
                        <option value="registered_cases" {{ old('category', $item->category) == 'registered_cases' ? 'selected' : '' }}>Registered Cases</option>
                        <option value="cause_list" {{ old('category', $item->category) == 'cause_list' ? 'selected' : '' }}>Cause List</option>
                        <option value="brochure" {{ old('category', $item->category) == 'brochure' ? 'selected' : '' }}>Brochures</option>
                    </select>
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Case Title / Allocation No. (e.g. 20/2026)</label>
                    <input type="text" name="case_number" class="form-control" value="{{ old('case_number', $item->case_number) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parties</label>
                    <input type="text" name="parties" class="form-control" value="{{ old('parties', $item->parties) }}">
                </div>
                <div class="col-md-6 js-decided">
                    <label class="form-label">Date of Decision</label>
                    <input type="date" name="decision_date" class="form-control" value="{{ old('decision_date', $item->decision_date) }}">
                </div>
                <div class="col-md-6 js-case-type">
                    <label class="form-label">Case Type</label>
                    <select name="case_type" class="form-select">
                        <option value="">-- Select --</option>
                        <option value="appeal" {{ old('case_type', $item->case_type ?? '') == 'appeal' ? 'selected' : '' }}>Appeal</option>
                        <option value="application" {{ old('case_type', $item->case_type ?? '') == 'application' ? 'selected' : '' }}>Application</option>
                    </select>
                </div>
                <div class="col-md-6 js-registered">
                    <label class="form-label">Date of Registration</label>
                    <input type="date" name="registration_date" class="form-control" value="{{ old('registration_date', $item->registration_date ?? '') }}">
                </div>
                <div class="col-md-6 js-registered">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">-- Select --</option>
                        <option value="Hearing" {{ old('status', $item->status ?? '') == 'Hearing' ? 'selected' : '' }}>Hearing</option>
                        <option value="Mention" {{ old('status', $item->status ?? '') == 'Mention' ? 'selected' : '' }}>Mention</option>
                        <option value="Judgement" {{ old('status', $item->status ?? '') == 'Judgement' ? 'selected' : '' }}>Judgement</option>
                    </select>
                </div>
                <div class="col-12 js-registered">
                    <label class="form-label">Issue (e.g. Stay of Execution)</label>
                    <input type="text" name="issue" class="form-control" value="{{ old('issue', $item->issue ?? '') }}" maxlength="255">
                </div>
                <div class="col-12">
                    <label class="form-label">Description / Outcome</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">File (PDF/DOC) <small class="text-muted">(leave blank to keep current)</small></label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx">
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" {{ old('is_published', $item->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                                {{-- Swahili (Kiswahili) fields --}}
                <div class="col-12 mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-0"><i class="bi bi-translate me-1"></i> Kiswahili (hiari — English itaonyeshwa kama wazi)</h6>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Kichwa (Kiswahili)</label>
                    <input type="text" name="title_sw" class="form-control" value="{{ old('title_sw', $item->title_sw ?? '') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Maelezo (Kiswahili)</label>
                    <textarea name="description_sw" class="form-control" rows="3">{{ old('description_sw', $item->description_sw ?? '') }}</textarea>
                </div>
<div class="col-12">
                    <button type="submit" class="btn btn-admin-primary">Update Item</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var cat = document.querySelector('select[name="category"]');
    if (!cat) return;
    var ct = document.querySelectorAll('.js-case-type');
    var rg = document.querySelectorAll('.js-registered');
    var dc = document.querySelectorAll('.js-decided');
    function apply() {
        var v = cat.value;
        ct.forEach(function (el) { el.classList.toggle('d-none', !(v === 'decided_cases' || v === 'registered_cases')); });
        rg.forEach(function (el) { el.classList.toggle('d-none', v !== 'registered_cases'); });
        dc.forEach(function (el) { el.classList.toggle('d-none', v !== 'decided_cases'); });
    }
    cat.addEventListener('change', apply);
    apply();
});
</script>
@endpush
