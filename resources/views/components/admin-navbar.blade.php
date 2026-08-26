<nav class="admin-navbar navbar navbar-dark sticky-top">
    <div class="container-fluid">
        <button class="btn btn-sm btn-outline-light border-0 me-2" onclick="toggleSidebar()">
            <i class="bi bi-list fs-5"></i>
        </button>
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-check me-2"></i>FCT Admin
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="text-white text-decoration-none" title="View Site">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>
            <div class="dropdown">
                <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>