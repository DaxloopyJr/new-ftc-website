@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Pages</h4>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Title</th><th>Slug</th><th>Parent</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($pages as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td><code>{{ $item->slug }}</code></td>
                        <td>{{ $item->parent->title ?? '-' }}</td>
                        <td><span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.pages.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.pages.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">No items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $pages->links() }}</div>
@endsection
