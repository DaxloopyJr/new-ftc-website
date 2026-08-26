@extends('layouts.admin')

@section('title', 'Publications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Publications</h4>
    <a href="{{ route('admin.publications.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Title</th><th>Category</th><th>Year</th><th>Downloads</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($publications as $item)
                    <tr>
                        <td>{{ Str::limit($item->title, 45) }}</td>
                        <td><span class="badge bg-secondary">{{ $item->category_label }}</span></td>
                        <td>{{ $item->year ?? '-' }}</td>
                        <td>{{ number_format($item->download_count) }}</td>
                        <td><span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.publications.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.publications.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">No publications found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $publications->links() }}</div>
@endsection