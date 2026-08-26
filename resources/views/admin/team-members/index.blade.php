@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Team Members</h4>
    <a href="{{ route('admin.team-members.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Add Member</a>
</div>
<div class="row g-2 mb-3">
    <div class="col-12">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.team-members.index') }}" class="btn btn-sm {{ !$category ? 'btn-admin-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.team-members.index', ['category' => 'tribunal_member']) }}" class="btn btn-sm {{ $category == 'tribunal_member' ? 'btn-admin-primary' : 'btn-outline-secondary' }}">Tribunal Members</a>
            <a href="{{ route('admin.team-members.index', ['category' => 'management']) }}" class="btn btn-sm {{ $category == 'management' ? 'btn-admin-primary' : 'btn-outline-secondary' }}">Management</a>
            <a href="{{ route('admin.team-members.index', ['category' => 'secretariat']) }}" class="btn btn-sm {{ $category == 'secretariat' ? 'btn-admin-primary' : 'btn-outline-secondary' }}">Secretariat</a>
        </div>
    </div>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Photo</th><th>Name</th><th>Title</th><th>Category</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($members as $item)
                    <tr>
                        <td>
                            @if($item->photo)
                                <img src="{{ asset($item->photo) }}" style="height:40px;width:40px;object-fit:cover;" class="rounded-circle">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="height:40px;width:40px;"><i class="bi bi-person text-white"></i></div>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->title }}</td>
                        <td><span class="badge bg-secondary">{{ $item->category_label }}</span></td>
                        <td>{{ $item->display_order }}</td>
                        <td><span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.team-members.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.team-members.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-4 text-muted">No members found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $members->links() }}</div>
@endsection
