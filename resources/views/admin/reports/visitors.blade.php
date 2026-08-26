@extends('layouts.admin')

@section('title', 'Visitor Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Visitor Statistics</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.reports.visitors', ['days' => 7]) }}" class="btn btn-sm {{ $days == 7 ? 'btn-admin-primary' : 'btn-outline-secondary' }}">7 Days</a>
        <a href="{{ route('admin.reports.visitors', ['days' => 30]) }}" class="btn btn-sm {{ $days == 30 ? 'btn-admin-primary' : 'btn-outline-secondary' }}">30 Days</a>
        <a href="{{ route('admin.reports.visitors', ['days' => 90]) }}" class="btn btn-sm {{ $days == 90 ? 'btn-admin-primary' : 'btn-outline-secondary' }}">90 Days</a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($totalStats['total_visits']) }}</div>
                    <div class="stat-label">Total Visits</div>
                </div>
                <i class="bi bi-graph-up stat-icon text-primary"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($totalStats['total_unique']) }}</div>
                    <div class="stat-label">Unique Visitors</div>
                </div>
                <i class="bi bi-people stat-icon text-success"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($totalStats['total_views']) }}</div>
                    <div class="stat-label">Page Views</div>
                </div>
                <i class="bi bi-eye stat-icon text-info"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalStats['avg_daily'] }}</div>
                    <div class="stat-label">Avg. Daily Visits</div>
                </div>
                <i class="bi bi-calendar stat-icon text-warning"></i>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-header"><i class="bi bi-bar-chart me-2"></i>Visitor Trend (Last {{ $days }} Days)</div>
    <div class="card-body"><canvas id="visitorReportChart" height="80"></canvas></div>
</div>
@endsection

@section('scripts')
<script>
const ctx = document.getElementById('visitorReportChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [
            { label: 'Visits', data: {!! json_encode($visits) !!}, borderColor: '#004D40', backgroundColor: 'rgba(0,77,64,0.1)', tension: 0.3, fill: true },
            { label: 'Unique Visitors', data: {!! json_encode($unique) !!}, borderColor: '#D4AF37', backgroundColor: 'rgba(212,175,55,0.1)', tension: 0.3, fill: true }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});
</script>
@endsection
