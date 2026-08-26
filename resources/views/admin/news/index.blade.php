@extends('layouts.admin')

@section('title', 'News & Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">News & Events</h4>
    <a href="{{ route('admin.news.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Title</th><th>Date</th><th>Location</th><th>Status</th><th>Views</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>{{ Str::limit($item->title, 50) }}</td>
                        <td>{{ $item->event_date ? $item->event_date->format('M j, Y') : '-' }}</td>
                        <td>{{ $item->location ?? '-' }}</td>
                        <td><span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>{{ number_format($item->view_count) }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">No news items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $news->links() }}</div>
@endsection