@extends('layouts.admin')

@section('title', 'Office Locations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Office Locations</h4>
    <a href="{{ route('admin.office-locations.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-1"></i>Add Location</a>
</div>
<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Name</th><th>Address</th><th>Coordinates</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($locations as $loc)
                    <tr>
                        <td>{{ $loc->name }}</td>
                        <td>{{ Str::limit($loc->address, 50) }}</td>
                        <td>
                            @if($loc->latitude && $loc->longitude)
                                <a href="https://www.google.com/maps?q={{ $loc->latitude }},{{ $loc->longitude }}" target="_blank" rel="noopener noreferrer" class="small">{{ $loc->latitude }}, {{ $loc->longitude }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td><span class="badge {{ $loc->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $loc->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.office-locations.edit', $loc->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.office-locations.destroy', $loc->id) }}" onsubmit="return confirm('Are you sure?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">No office locations found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">{{ $locations->links() }}</div>
@endsection
