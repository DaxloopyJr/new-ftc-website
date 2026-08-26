@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Roles</h4>
    <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal"><i class="bi bi-plus-lg me-1"></i>Add Role</button>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Name</th><th>Display Name</th><th>Users</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>{{ $role->users_count }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-4 text-muted">No roles found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Create Role</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Display Name *</label><input type="text" name="display_name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
                    <div class="mb-3"><label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions as $perm)
                                <div class="col-6"><div class="form-check"><input type="checkbox" name="permissions[]" value="{{ $perm }}" class="form-check-input" id="perm_{{ $loop->index }}"><label class="form-check-label" for="perm_{{ $loop->index }}" style="font-size:0.8rem;">{{ $perm }}</label></div></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary btn-sm">Create</button></div>
            </form>
        </div>
    </div>
</div>

@foreach($roles as $role)
<div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                @csrf @method('PUT')
                <div class="modal-header"><h5 class="modal-title">Edit Role</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Display Name *</label><input type="text" name="display_name" class="form-control" required value="{{ $role->display_name }}"></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2">{{ $role->description }}</textarea></div>
                    <div class="mb-3"><label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions as $perm)
                                <div class="col-6"><div class="form-check"><input type="checkbox" name="permissions[]" value="{{ $perm }}" class="form-check-input" id="edit_perm_{{ $role->id }}_{{ $loop->index }}" {{ in_array($perm, $role->permissions ?? []) ? 'checked' : '' }}><label class="form-check-label" for="edit_perm_{{ $role->id }}_{{ $loop->index }}" style="font-size:0.8rem;">{{ $perm }}</label></div></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary btn-sm">Update</button></div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection