<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary Meta Tags -->
    <title>@yield('title', $siteSettings['site_name'] ?? __('messages.united_republic_tanzania'))</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['site_description'] ?? __('messages.meta_home'))">
    <meta name="keywords" content="@yield('meta_keywords', 'Fair Competition Tribunal, Tanzania, FCT, competition law, consumer protection, mergers, acquisitions, appeals')">
    <meta name="author" content="Fair Competition Tribunal - Tanzania">
    <meta name="robots" content="index, follow">
    <meta name="language" content="{{ app()->getLocale() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Alternate Languages -->
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">
    <link rel="alternate" hreflang="sw" href="{{ url()->current() }}?lang=sw">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $siteSettings['site_name'] ?? 'Fair Competition Tribunal')">
    <meta property="og:description" content="@yield('meta_description', $siteSettings['site_description'] ?? __('messages.meta_home'))">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/fct-logo.png'))">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'Fair Competition Tribunal' }}">
    <meta property="og:locale" content="{{ app()->getLocale() == 'sw' ? 'sw_TZ' : 'en_TZ' }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $siteSettings['site_name'] ?? 'Fair Competition Tribunal')">
    <meta property="twitter:description" content="@yield('meta_description', $siteSettings['site_description'] ?? __('messages.meta_home'))">
    <meta property="twitter:image" content="@yield('og_image', asset('assets/images/fct-logo.png'))">

    <!-- JSON-LD Structured Data -->
    @hasSection('structured_data')
        @yield('structured_data')
    @else
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GovernmentOrganization",
        "name": "Fair Competition Tribunal - Tanzania",
        "alternateName": "FCT Tanzania",
        "description": "{{ __('messages.meta_home') }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/images/fct-logo.png') }}",
        "sameAs": [
            "{{ $siteSettings['social_facebook'] ?? '' }}",
            "{{ $siteSettings['social_twitter'] ?? '' }}"
        ],
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "TZ",
            "addressLocality": "{{ $siteSettings['contact_address'] ?? 'Dar es Salaam' }}"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $siteSettings['contact_phone'] ?? '' }}",
            "contactType": "customer service",
            "availableLanguage": ["English", "Swahili"]
        }
    }
    </script>
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fct-logo.png') }}">

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --fct-primary: #1B5E20;
            --fct-primary-dark: #0D3B10;
            --fct-primary-light: #2E7D32;
            --fct-accent: #FFD700;
            --fct-accent-dark: #C9A000;
            --fct-text: #1C1C1C;
            --fct-text-secondary: #5F6B6A;
            --fct-border: #DEE2E6;
            --fct-surface: #F8F9FA;
            --fct-white: #FFFFFF;
            --fct-tz-green: #1EB53A;
            --fct-tz-yellow: #FCD116;
            --fct-tz-black: #000000;
            --fct-tz-blue: #00A3DD;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--fct-text);
            line-height: 1.6;
            background: var(--fct-white);
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 600; }

        /* Utility Classes */
        .fct-primary-bg { background-color: var(--fct-primary) !important; }
        .fct-primary-text { color: var(--fct-primary) !important; }
        .fct-accent-text { color: var(--fct-accent) !important; }

        .btn-fct-primary {
            background-color: var(--fct-primary);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-fct-primary:hover {
            background-color: var(--fct-primary-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
        }

        /* Top Bar */
        .top-bar {
            background: var(--fct-surface);
            border-bottom: 1px solid var(--fct-border);
            font-size: 13px;
        }
        .top-bar a { color: var(--fct-text-secondary); text-decoration: none; transition: color 0.2s; }
        .top-bar a:hover { color: var(--fct-primary); }

        /* Identity Bar with Banner Background */
        .identity-bar {
            position: relative;
            overflow: hidden;
            padding: 12px 0;
        }
        .identity-bar .banner-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset("assets/images/fct-header-banner.jpg") }}') center center / cover no-repeat;
            filter: blur(20px) saturate(1.3);
            opacity: 0.92;
            z-index: 0;
        }
        .identity-bar .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.88) 0%, rgba(255,255,255,0.82) 40%, rgba(255,255,255,0.9) 100%);
            z-index: 1;
        }
        .identity-bar .identity-content {
            position: relative;
            z-index: 2;
        }
        .identity-bar .logo-container {
            background: rgba(255,255,255,0.75);
            border-radius: 10px;
            padding: 4px 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .fct-logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: var(--fct-primary);
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(255,255,255,0.9);
        }
        .fct-tagline {
            font-size: 11px;
            color: var(--fct-text-secondary);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Language Switcher */
        .language-switcher {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .language-switcher .lang-btn {
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid var(--fct-border);
            background: transparent;
            color: var(--fct-text-secondary);
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .language-switcher .lang-btn:hover,
        .language-switcher .lang-btn.active {
            background: var(--fct-primary);
            color: #fff;
            border-color: var(--fct-primary);
        }

        /* Navigation */
        .navbar-fct {
            background: linear-gradient(135deg, var(--fct-primary) 0%, var(--fct-primary-dark) 100%) !important;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .navbar-fct .navbar-nav .nav-item {
            position: relative;
        }
        .navbar-fct .navbar-nav .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--fct-accent);
            transition: width 0.3s ease;
            border-radius: 2px 2px 0 0;
        }
        .navbar-fct .navbar-nav .nav-item:hover::after,
        .navbar-fct .navbar-nav .nav-item.active::after {
            width: 60%;
        }
        .navbar-fct .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: lowercase;
            padding: 14px 18px !important;
            transition: all 0.3s ease;
            position: relative;
        }
        .navbar-fct .navbar-nav .nav-link::first-letter {
            text-transform: uppercase;
        }
        .navbar-fct .navbar-nav .nav-link:hover,
        .navbar-fct .navbar-nav .nav-link.active {
            color: var(--fct-accent) !important;
            background: rgba(255,255,255,0.06);
        }
        .navbar-fct .dropdown-menu {
            border: none;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            border-radius: 0 0 8px 8px;
            margin-top: 0;
            overflow: hidden;
            min-width: 220px;
        }
        .navbar-fct .dropdown-item {
            font-size: 13px;
            font-weight: 500;
            padding: 11px 22px;
            color: var(--fct-text);
            transition: all 0.25s ease;
            border-left: 3px solid transparent;
            text-transform: lowercase;
        }
        .navbar-fct .dropdown-item::first-letter {
            text-transform: uppercase;
        }
        .navbar-fct .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(27,94,32,0.08) 0%, transparent 100%);
            color: var(--fct-primary);
            border-left-color: var(--fct-primary);
            padding-left: 26px;
        }
        .navbar-fct .dropdown-item.active {
            background: linear-gradient(90deg, rgba(27,94,32,0.1) 0%, transparent 100%);
            color: var(--fct-primary);
            border-left-color: var(--fct-accent);
            font-weight: 600;
        }
        .navbar-fct .dropdown-toggle::after {
            transition: transform 0.3s ease;
            border-top-color: rgba(255,255,255,0.7);
            vertical-align: middle;
        }
        .navbar-fct .dropdown-toggle:hover::after,
        .navbar-fct .dropdown-toggle.show::after {
            border-top-color: var(--fct-accent);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 600px;
            overflow: hidden;
        }
        .hero-carousel { height: 600px; }
        .hero-carousel .carousel-item { height: 600px; }

        /* Full-slide item with image background */
        .hero-slide-item {
            position: relative;
            height: 100%;
            width: 100%;
        }
        .hero-slide-item .slide-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        .hero-slide-item .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13,59,16,0.75) 0%, rgba(27,94,32,0.55) 50%, rgba(13,59,16,0.7) 100%);
            z-index: 2;
        }
        .hero-slide-item .slide-content {
            position: relative;
            z-index: 3;
            height: 100%;
            display: flex;
            align-items: center;
        }

        /* Fixed slide uses a themed gradient instead of image */
        .hero-slide-item.slide-fixed .slide-overlay {
            background: linear-gradient(135deg, rgba(13,59,16,0.92) 0%, rgba(27,94,32,0.88) 40%, rgba(0,163,221,0.75) 100%);
        }

        /* Caption styling per slide */
        .slide-caption h1 {
            font-size: 2.6rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .slide-caption h1 .slide-highlight {
            color: var(--fct-accent);
            display: block;
            font-size: 1.1em;
            margin-top: 0.25rem;
        }
        .slide-caption p {
            font-size: 1.15rem;
            color: rgba(255,255,255,0.92);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            max-width: 540px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.3);
        }
        .slide-caption .btn-group-slides {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .slide-caption .btn-slide-action {
            background: var(--fct-accent);
            color: var(--fct-primary-dark);
            border: none;
            font-weight: 600;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .slide-caption .btn-slide-action:hover {
            background: #fff;
            color: var(--fct-primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }
        .slide-caption .btn-slide-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,0.5);
            font-weight: 500;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .slide-caption .btn-slide-outline:hover {
            background: rgba(255,255,255,0.15);
            border-color: #fff;
            color: #fff;
            transform: translateY(-3px);
        }

        /* Carousel controls - positioned on the slide */
        .hero-carousel .carousel-control-prev,
        .hero-carousel .carousel-control-next {
            z-index: 10;
            width: 5%;
        }
        .hero-carousel .carousel-indicators {
            z-index: 10;
            bottom: 15px;
        }
        .hero-carousel .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(255,255,255,0.4);
            border: 2px solid transparent;
            transition: all 0.3s;
        }
        .hero-carousel .carousel-indicators button.active {
            background-color: var(--fct-accent);
            border-color: rgba(255,255,255,0.5);
            transform: scale(1.2);
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-header h2 {
            color: var(--fct-primary);
            font-size: 1.8rem;
            position: relative;
            display: inline-block;
            padding-bottom: 0.75rem;
        }
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--fct-accent);
        }

        /* Info Cards */
        .info-card {
            background: #fff;
            border: 1px solid var(--fct-border);
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
            border-radius: 4px;
        }
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: var(--fct-primary);
        }
        .info-card i {
            font-size: 2.5rem;
            color: var(--fct-primary);
            margin-bottom: 1rem;
            display: block;
        }
        .info-card h5 {
            font-size: 0.95rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            color: var(--fct-text);
        }

        /* News Cards */
        .news-card {
            background: #fff;
            border: 1px solid var(--fct-border);
            transition: all 0.3s;
            height: 100%;
            border-radius: 4px;
            overflow: hidden;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .news-card img { width: 100%; height: 200px; object-fit: cover; }
        .news-card .card-body { padding: 1.5rem; }
        .news-card .date-badge {
            font-size: 12px;
            color: var(--fct-text-secondary);
            margin-bottom: 0.5rem;
        }
        .news-card h5 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--fct-text);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        /* Footer */
        .footer-fct {
            background: linear-gradient(135deg, var(--fct-primary-dark) 0%, var(--fct-primary) 100%);
            color: #fff;
        }
        .footer-fct a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-fct a:hover { color: var(--fct-accent); }
        .footer-fct h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 1.25rem 0;
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }

        /* About Tabs */
        .about-tabs .nav-link {
            color: var(--fct-text);
            font-weight: 500;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            border-bottom: 2px solid transparent;
            padding: 12px 20px;
        }
        .about-tabs .nav-link.active {
            color: var(--fct-primary);
            border-bottom-color: var(--fct-primary);
            background: none;
        }
        .about-tabs .nav-link:hover { border-bottom-color: var(--fct-border); }

        /* Tanzania Colors */
        .tz-colors {
            display: flex;
            justify-content: center;
            gap: 4px;
            margin-top: 20px;
        }
        .tz-color-bar { width: 30px; height: 4px; border-radius: 2px; }
        .tz-green { background: var(--fct-tz-green); }
        .tz-yellow { background: var(--fct-tz-yellow); }
        .tz-black { background: var(--fct-tz-black); width: 10px; }
        .tz-blue { background: var(--fct-tz-blue); }

        /* Breadcrumb - Modern Card Style */
        .breadcrumb-fct {
            background: linear-gradient(135deg, var(--fct-primary) 0%, var(--fct-primary-dark) 60%, rgba(0,163,221,0.15) 100%);
            padding: 2rem 0;
            position: relative;
            overflow: hidden;
        }
        .breadcrumb-fct::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 150px;
            height: 150px;
            background: rgba(255,215,0,0.08);
            border-radius: 50%;
            pointer-events: none;
        }
        .breadcrumb-fct::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 20%;
            width: 80px;
            height: 80px;
            background: rgba(0,163,221,0.08);
            border-radius: 50%;
            pointer-events: none;
        }
        .breadcrumb-fct h1 {
            color: #fff;
            font-size: 1.85rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
            text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .breadcrumb-fct .breadcrumb {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(8px);
            padding: 0.4rem 1rem;
            border-radius: 50px;
            display: inline-flex;
            margin: 0;
            border: 1px solid rgba(255,255,255,0.15);
        }
        .breadcrumb-fct .breadcrumb-item,
        .breadcrumb-fct .breadcrumb-item a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .breadcrumb-fct .breadcrumb-item a:hover {
            color: var(--fct-accent);
        }
        .breadcrumb-fct .breadcrumb-item.active {
            color: var(--fct-accent);
            font-weight: 600;
        }
        .breadcrumb-fct .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.5);
            content: '\203A';
            font-size: 1rem;
            padding: 0 0.6rem;
        }

        /* Skip to content for accessibility */
        .skip-to-content {
            position: absolute;
            top: -40px;
            left: 0;
            background: var(--fct-primary);
            color: #fff;
            padding: 8px;
            text-decoration: none;
            z-index: 100;
            transition: top 0.3s;
        }
        .skip-to-content:focus { top: 0; }

        /* Responsive */
        @media (max-width: 991px) {
            .slide-caption h1 { font-size: 1.9rem; }
            .slide-caption h1 .slide-highlight { font-size: 1em; }
            .slide-caption p { font-size: 1rem; }
            .hero-section, .hero-carousel, .hero-carousel .carousel-item { min-height: 550px; height: auto; }
            .hero-slide-item .slide-content { padding: 2rem 0; }
            .slide-caption .btn-group-slides { flex-direction: column; }
            .slide-caption .btn-slide-action,
            .slide-caption .btn-slide-outline { width: 100%; text-align: center; }

            /* Mobile Nav */
            .navbar-fct .navbar-collapse {
                background: linear-gradient(180deg, var(--fct-primary-dark) 0%, var(--fct-primary) 100%);
                padding: 1rem;
                border-radius: 0 0 12px 12px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                margin-top: 4px;
            }
            .navbar-fct .navbar-nav .nav-item::after { display: none; }
            .navbar-fct .navbar-nav .nav-link {
                padding: 10px 14px !important;
                border-radius: 6px;
                margin-bottom: 2px;
            }
            .navbar-fct .navbar-nav .nav-link:hover,
            .navbar-fct .navbar-nav .nav-link.active {
                background: rgba(255,255,255,0.1);
            }
            .navbar-fct .dropdown-menu {
                background: rgba(255,255,255,0.05);
                border-radius: 6px;
                box-shadow: none;
                border: 1px solid rgba(255,255,255,0.1);
            }
            .navbar-fct .dropdown-item {
                color: rgba(255,255,255,0.9);
            }
            .navbar-fct .dropdown-item:hover {
                background: rgba(255,255,255,0.1);
                color: var(--fct-accent);
                border-left-color: transparent;
            }

            /* Mobile identity bar */
            .identity-bar .logo-container {
                padding: 2px 4px;
            }
            .identity-bar img { height: 55px !important; }
            .fct-logo-text { font-size: 11px !important; }
            .fct-logo-text h1 { font-size: 0.9rem !important; }

            /* Mobile breadcrumb */
            .breadcrumb-fct { padding: 1.5rem 0; }
            .breadcrumb-fct h1 { font-size: 1.4rem; }
            .breadcrumb-fct .breadcrumb { border-radius: 30px; padding: 0.3rem 0.8rem; }
        }

        @media (max-width: 576px) {
            .slide-caption h1 { font-size: 1.5rem; }
            .slide-caption p { font-size: 0.95rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
    {{-- Appearance: colors + skin from Admin > Settings --}}
    @php
        $fctPrimaryColor = \App\Models\Setting::where('key', 'appearance_primary_color')->value('value') ?: '#1B5E20';
        $fctAccentColor  = \App\Models\Setting::where('key', 'appearance_accent_color')->value('value') ?: '#f5b301';
        $fctSkin         = \App\Models\Setting::where('key', 'appearance_skin')->value('value') ?: 'light';
    @endphp
    <style>
        :root {
            --fct-primary: {{ $fctPrimaryColor }};
            --fct-accent: {{ $fctAccentColor }};
        }
        @if($fctSkin === 'dark')
        :root {
            --fct-text: #e8ecf1;
            --fct-text-secondary: #9aa7b5;
            --fct-border: #2c3a4d;
            --fct-surface: #1c2635;
        }
        body { background: #141d2b !important; color: #e8ecf1 !important; }
        @endif
    </style>

    <link href="{{ asset('assets/css/fct-bilingual.css') }}" rel="stylesheet">

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
    <!-- Skip to content link for accessibility -->
    <a href="#main-content" class="skip-to-content">{{ app()->getLocale() == 'sw' ? 'Ruka hadi maudhui' : 'Skip to main content' }}</a>

    @include('components.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/fct-nav.js') }}"></script>

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
