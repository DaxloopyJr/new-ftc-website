@extends('layouts.admin')

@section('title', 'Download Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Download Statistics</h4>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="content-card">
            <div class="card-header"><i class="bi bi-journal-bookmark me-2"></i>Publication Downloads</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Title</th><th>Category</th><th>Downloads</th></tr></thead>
                        <tbody>
                            @forelse($publications as $pub)
                                <tr>
                                    <td>{{ Str::limit($pub->title, 50) }}</td>
                                    <td><span class="badge bg-secondary">{{ $pub->category_label }}</span></td>
                                    <td>{{ number_format($pub->download_count) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-4 text-muted">No data available.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="content-card">
            <div class="card-header"><i class="bi bi-folder2-open me-2"></i>Info Library Downloads</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Title</th><th>Category</th><th>Downloads</th></tr></thead>
                        <tbody>
                            @forelse($infoLibrary as $item)
                                <tr>
                                    <td>{{ Str::limit($item->title, 50) }}</td>
                                    <td><span class="badge bg-secondary">{{ $item->category_label }}</span></td>
                                    <td>{{ number_format($item->download_count) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-4 text-muted">No data available.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
