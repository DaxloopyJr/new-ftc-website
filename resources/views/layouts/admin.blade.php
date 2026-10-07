<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Dashboard') | FCT Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --fct-primary: #1B5E20;
            --fct-primary-dark: #0D3B10;
            --fct-primary-light: #2E7D32;
            --fct-accent: #FFD700;
            --fct-accent-dark: #C9A000;
            --fct-sidebar: #0D3B10;
            --fct-sidebar-hover: #1B5E20;
            --fct-text: #1C1C1C;
            --fct-border: #DEE2E6;
            --fct-surface: #F8F9FA;
            --fct-success: #28a745;
            --fct-info: #00A3DD;
            --fct-warning: #ffc107;
        }
        body { font-family: 'Inter', sans-serif; background: #f4f6f9; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        .admin-navbar {
            background: linear-gradient(135deg, var(--fct-primary) 0%, var(--fct-primary-dark) 100%);
            padding: 0.5rem 1rem;
        }
        .admin-navbar .navbar-brand {
            color: #fff;
            font-family: 'Poppins';
            font-weight: 600;
        }

        .admin-sidebar {
            background: linear-gradient(180deg, var(--fct-sidebar) 0%, var(--fct-primary-dark) 100%);
            min-height: calc(100vh - 56px);
            width: 260px;
            position: fixed;
            left: 0;
            top: 56px;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }
        .admin-sidebar.collapsed { width: 0; overflow: hidden; }
        .admin-main {
            margin-left: 260px;
            padding: 1.5rem;
            min-height: calc(100vh - 56px);
            transition: all 0.3s;
        }
        .admin-main.expanded { margin-left: 0; }

        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: var(--fct-sidebar-hover);
            color: #fff;
            border-left-color: var(--fct-accent);
        }
        .sidebar-menu li a i {
            margin-right: 10px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        .sidebar-menu .menu-header {
            padding: 15px 20px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.4);
        }

        .stat-card {
            background: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid var(--fct-primary);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .stat-card.primary { border-left-color: var(--fct-primary); }
        .stat-card.success { border-left-color: var(--fct-success); }
        .stat-card.info { border-left-color: var(--fct-info); }
        .stat-card.warning { border-left-color: var(--fct-warning); }
        .stat-card .stat-icon { font-size: 2rem; opacity: 0.2; }
        .stat-card .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--fct-text); }
        .stat-card .stat-label { font-size: 0.875rem; color: #6c757d; }

        .content-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .content-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .content-card .card-header {
            background: none;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        .content-card .card-body { padding: 1.5rem; }

        .table th {
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-top: none;
        }

        .btn-admin-primary {
            background: linear-gradient(135deg, var(--fct-primary) 0%, var(--fct-primary-dark) 100%);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-admin-primary:hover {
            background: linear-gradient(135deg, var(--fct-primary-dark) 0%, var(--fct-primary) 100%);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
        }
        .badge-admin { background: var(--fct-primary); color: #fff; }

        /* Alert improvements */
        .alert {
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .alert-success { background: rgba(40, 167, 69, 0.1); color: #155724; border-left: 4px solid #28a745; }
        .alert-danger { background: rgba(220, 53, 69, 0.1); color: #721c24; border-left: 4px solid #dc3545; }

        @media (max-width: 991px) {
            .admin-sidebar { width: 0; overflow: hidden; }
            .admin-sidebar.show { width: 260px; }
            .admin-main { margin-left: 0; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
    @yield('styles')
<style>
        /* FCT page loader */
        #fct-page-loader {
            position: fixed; inset: 0; z-index: 9999;
            background: #ffffff;
            display: flex; align-items: center; justify-content: center;
            transition: opacity .5s ease, visibility .5s ease;
        }
        #fct-page-loader.fct-loader-hidden {
            opacity: 0; visibility: hidden; pointer-events: none;
        }
        .fct-loader-box { text-align: center; }
        .fct-loader-logo {
            height: 70px; margin-bottom: 1rem;
            animation: fctLoaderPulse 1.2s ease-in-out infinite;
        }
        .fct-loader-spinner {
            width: 44px; height: 44px; margin: 0 auto;
            border: 4px solid rgba(27,94,32,.2);
            border-top-color: #1B5E20;
            border-radius: 50%;
            animation: fctLoaderSpin .8s linear infinite;
        }
        .fct-loader-text {
            margin-top: .8rem; color: #1B5E20;
            font-size: .85rem; letter-spacing: .1em; text-transform: uppercase;
        }
        @keyframes fctLoaderSpin { to { transform: rotate(360deg); } }
        @keyframes fctLoaderPulse { 0%,100% { transform: scale(1); opacity: 1; } 50% { transform: scale(.94); opacity: .75; } }
    </style>
</head>
<body>
    <!-- Page loading animation -->
    <div id="fct-page-loader" aria-hidden="true">
        <div class="fct-loader-box">
            <img src="{{ asset('assets/images/fct-logo.png') }}" alt="" class="fct-loader-logo">
            <div class="fct-loader-spinner"></div>
            <div class="fct-loader-text">{{ app()->getLocale() == 'sw' ? 'Inapakia...' : 'Loading...' }}</div>
        </div>
    </div>
    @include('components.admin-navbar')
    @include('components.admin-sidebar')

    <main class="admin-main" id="adminMain">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('collapsed');
            document.getElementById('adminSidebar').classList.toggle('show');
            document.getElementById('adminMain').classList.toggle('expanded');
        }
    </script>
    @yield('scripts')
<script>
    // FCT page loader: hide when the page has fully loaded
    window.addEventListener('load', function () {
        var loader = document.getElementById('fct-page-loader');
        if (loader) { setTimeout(function () { loader.classList.add('fct-loader-hidden'); }, 250); }
    });
    // Safety net: never keep the loader up longer than 6s
    setTimeout(function () {
        var loader = document.getElementById('fct-page-loader');
        if (loader) { loader.classList.add('fct-loader-hidden'); }
    }, 6000);
</script>
</body>
</html>
