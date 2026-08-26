@extends('layouts.admin')

@section('title', 'Page View Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Most Visited Pages</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.reports.page-views', ['days' => 7]) }}" class="btn btn-sm {{ $days == 7 ? 'btn-admin-primary' : 'btn-outline-secondary' }}">7 Days</a>
        <a href="{{ route('admin.reports.page-views', ['days' => 30]) }}" class="btn btn-sm {{ $days == 30 ? 'btn-admin-primary' : 'btn-outline-secondary' }}">30 Days</a>
        <a href="{{ route('admin.reports.page-views', ['days' => 90]) }}" class="btn btn-sm {{ $days == 90 ? 'btn-admin-primary' : 'btn-outline-secondary' }}">90 Days</a>
    </div>
</div>

<div class="content-card">
    <div class="card-header"><i class="bi bi-eye me-2"></i>Page Views (Last {{ $days }} Days)</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Page</th><th>Views</th></tr></thead>
                <tbody>
                    @forelse($pageViews as $index => $pv)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><code>{{ $pv->page_visited }}</code></td>
                            <td><span class="badge bg-primary">{{ number_format($pv->views) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center py-4 text-muted">No data available for the selected period.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
