@extends('layouts.admin')

@section('title', 'Media Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Media Gallery</h4>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Upload Media</a>
</div>
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm {{ !$category ? 'btn-admin-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.gallery.index', ['category' => 'photo_gallery']) }}" class="btn btn-sm {{ $category == 'photo_gallery' ? 'btn-admin-primary' : 'btn-outline-secondary' }}">Photos</a>
            <a href="{{ route('admin.gallery.index', ['category' => 'video_gallery']) }}" class="btn btn-sm {{ $category == 'video_gallery' ? 'btn-admin-primary' : 'btn-outline-secondary' }}">Videos</a>
        </div>
    </div>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Preview</th><th>Title</th><th>Type</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($media as $item)
                    <tr>
                        <td>
                            @if($item->file_type == 'image')
                                <img src="{{ asset($item->file_path) }}" style="height:40px;width:60px;object-fit:cover;" class="rounded">
                            @else
                                <div class="d-flex align-items-center justify-content-center rounded bg-secondary" style="height:40px;width:60px;"><i class="bi bi-play-fill text-white"></i></div>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->title, 40) }}</td>
                        <td><span class="badge bg-info">{{ ucfirst($item->file_type) }}</span></td>
                        <td>{{ str_replace('_', ' ', $item->category) }}</td>
                        <td><span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.gallery.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">No media items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $media->links() }}</div>
@endsection
