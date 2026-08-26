@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Dashboard</h4>
    <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <!-- Total Users -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($stats['total_users']) }}</div>
                    <div class="stat-label">Total Users</div>
                </div>
                <i class="bi bi-people stat-icon text-primary"></i>
            </div>
        </div>
    </div>
    <!-- News Articles -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($stats['total_news']) }}</div>
                    <div class="stat-label">News Articles</div>
                </div>
                <i class="bi bi-newspaper stat-icon text-success"></i>
            </div>
        </div>
    </div>
    <!-- Publications -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($stats['total_publications']) }}</div>
                    <div class="stat-label">Publications</div>
                </div>
                <i class="bi bi-journal-bookmark stat-icon text-info"></i>
            </div>
        </div>
    </div>
    <!-- Contacts -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ number_format($stats['total_contacts']) }}</div>
                    <div class="stat-label">Contacts</div>
                </div>
                <i class="bi bi-envelope stat-icon text-warning"></i>
            </div>
        </div>
    </div>
</div>

<!-- Visitor Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($stats['total_unique_visitors'] ?? 0) }}</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.8);">Unique Visitors</div>
                </div>
                <i class="bi bi-person-check stat-icon" style="color: rgba(255,255,255,0.3);"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #0D3B10 0%, #1B5E20 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($stats['total_page_views'] ?? 0) }}</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.8);">Page Views</div>
                </div>
                <i class="bi bi-eye stat-icon" style="color: rgba(255,255,255,0.3);"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #FFD700 0%, #C9A000 100%); color: #1C1C1C;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value" style="color: #1C1C1C;">{{ number_format($stats['today_visits'] ?? 0) }}</div>
                    <div class="stat-label" style="color: rgba(0,0,0,0.7);">Today's Visits</div>
                </div>
                <i class="bi bi-calendar-check stat-icon" style="color: rgba(0,0,0,0.2);"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($stats['active_slides'] ?? 0) }}</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.8);">Active Slides</div>
                </div>
                <i class="bi bi-images stat-icon" style="color: rgba(255,255,255,0.3);"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Visitor Chart -->
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-graph-up me-2"></i>Visitor Statistics (Last 30 Days)</span>
                <a href="{{ route('admin.reports.visitors') }}" class="btn btn-sm btn-admin-primary">View Report</a>
            </div>
            <div class="card-body">
                <canvas id="visitorChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <!-- Recent Contacts -->
    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-envelope me-2"></i>Recent Contacts</span>
                @if($stats['unread_contacts'] > 0)
                    <span class="badge bg-danger">{{ $stats['unread_contacts'] }} new</span>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentContacts as $contact)
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="list-group-item list-group-item-action {{ !$contact->is_read ? 'fw-bold' : '' }}">
                            <div class="d-flex justify-content-between">
                                <small>{{ Str::limit($contact->name, 20) }}</small>
                                <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                            </div>
                            <small class="text-muted">{{ Str::limit($contact->subject, 30) }}</small>
                        </a>
                    @empty
                        <div class="list-group-item text-muted">No contacts yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="content-card mt-4">
            <div class="card-header">
                <span><i class="bi bi-lightning me-2"></i>Quick Actions</span>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-images me-2"></i>Manage Hero Slides</a>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-newspaper me-2"></i>Manage News</a>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-info btn-sm"><i class="bi bi-gear me-2"></i>Site Settings</a>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-envelope me-2"></i>View Contacts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const ctx = document.getElementById('visitorChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($allDates) !!},
        datasets: [
            { label: 'Visits', data: {!! json_encode($allVisits) !!}, borderColor: '#1B5E20', backgroundColor: 'rgba(27,94,32,0.1)', tension: 0.3, fill: true },
            { label: 'Unique Visitors', data: {!! json_encode($allUnique) !!}, borderColor: '#FFD700', backgroundColor: 'rgba(255,215,0,0.1)', tension: 0.3, fill: true },
            { label: 'Page Views', data: {!! json_encode($allViews) !!}, borderColor: '#00A3DD', backgroundColor: 'rgba(0,163,221,0.05)', tension: 0.3, fill: false, borderDash: [5,5] }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y.toLocaleString();
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0, callback: function(value) { return value.toLocaleString(); } }
            }
        }
    }
});
</script>
@endsection
