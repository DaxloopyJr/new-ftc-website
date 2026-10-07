@extends('layouts.admin')

@section('title', 'Advertisements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Advertisements</h4>
    <a href="{{ route('admin.advertisements.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Title</th><th>Position</th><th>Image</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($advertisements as $ad)
                    <tr>
                        <td>{{ Str::limit($ad->title, 50) }}</td>
                        <td><span class="badge bg-light text-dark">{{ $ad->position ?? '-' }}</span></td>
                        <td>
                            @if($ad->image_path)
                                <img src="{{ asset($ad->image_path) }}" alt="" style="height:36px;" class="rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td><span class="badge {{ $ad->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $ad->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.advertisements.edit', $ad->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.advertisements.destroy', $ad->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">No advertisements found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $advertisements->links() }}</div>
@endsection
