@extends('layouts.frontend')

@section('title', (app()->getLocale() == 'sw' ? 'Nyumbani' : 'Home') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_home'))
@section('meta_keywords', 'Fair Competition Tribunal, Tanzania, FCT, competition law, consumer protection, mergers, acquisitions, appeals, quasi-judicial')

@section('structured_data')
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
@foreach($heroSlides as $index => $slide)
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ImageObject",
    "contentUrl": "{{ asset($slide->image_path) }}",
    "description": "{{ $slide->title }}",
    "name": "{{ $slide->title }}"
}
</script>
@endforeach
@endsection

@section('content')
<!-- Hero Section -->
@php
    $totalSlides = 1 + $heroSlides->count(); // 1 fixed slide + dynamic slides
@endphp
<section class="hero-section" aria-label="{{ app()->getLocale() == 'sw' ? 'Sehemu Kuu' : 'Hero Section' }}">
    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" aria-roledescription="carousel" aria-label="{{ app()->getLocale() == 'sw' ? 'Vipande vya Kichwa' : 'Hero Slides' }}">

        {{-- Carousel Indicators --}}
        @if($totalSlides > 1)
        <div class="carousel-indicators">
            {{-- Indicator for fixed slide (index 0) --}}
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="{{ app()->getLocale() == 'sw' ? 'Mfumo wa Kufungua Kesi' : 'Digital Case Filing System' }}"></button>
            {{-- Indicators for dynamic slides (indices 1+) --}}
            @foreach($heroSlides as $index => $slide)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index + 1 }}" aria-label="{{ $slide->title ?? ('Slide ' . ($index + 2)) }}"></button>
            @endforeach
        </div>
        @endif

        <div class="carousel-inner">

            {{-- ========================================= --}}
            {{-- SLIDE 1: FIXED - Digital Case Filing System --}}
            {{-- ========================================= --}}
            <div class="carousel-item active">
                <div class="hero-slide-item slide-fixed">
                    {{-- Animated gradient background (no image) --}}
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <div class="container">
                            <div class="row align-items-center">
                                {{-- Caption --}}
                                <div class="col-lg-7">
                                    <article class="slide-caption">
                                        <h1>
                                            {{ app()->getLocale() == 'sw' ? 'Wasilisha Rufaa Yako Mtandaoni' : 'File your Appeal Online' }}
                                            <span class="slide-highlight">{{ app()->getLocale() == 'sw' ? 'Mfumo wa Kidigitali wa Kufungua Kesi' : 'Digital Case Filing System' }}</span>
                                        </h1>
                                        <p>
                                            {{ app()->getLocale() == 'sw'
                                                ? 'Wasilisha rufaa yako kielektroniki kupitia mfumo wetu wa kidigitali wa kufungua kesi. Haraka, salama, na rahisi.'
                                                : 'Submit your appeal electronically through our digital case filing system. Fast, secure, and convenient.'
                                            }}
                                        </p>
                                        <div class="btn-group-slides">
                                            <a href="{{ route('pages.show', 'how-to-appeal') }}" class="btn btn-slide-action btn-lg">
                                                <i class="bi bi-file-earmark-text me-2" aria-hidden="true"></i>
                                                {{ app()->getLocale() == 'sw' ? 'Fungua Rufaa Sasa' : 'File an Appeal Now' }}
                                            </a>
                                            <a href="{{ route('pages.show', 'about-us') }}" class="btn btn-slide-outline btn-lg">
                                                {{ __('messages.learn_more') }}
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                {{-- Leadership Profiles --}}
                                <div class="col-lg-5 d-none d-lg-block">
                                    <aside class="row g-3" aria-label="{{ app()->getLocale() == 'sw' ? 'Viongozi' : 'Leadership' }}">
                                        @if($chairperson)
                                        <div class="col-6">
                                            <article class="card border-0" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px);">
                                                <div class="card-body text-center text-white p-3">
                                                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center overflow-hidden" style="width:130px;height:130px;background:rgba(255,255,255,0.15);">
                                                        @if($chairperson->photo)
                                                            <img src="{{ asset($chairperson->photo) }}" alt="{{ $chairperson->name }}" style="width:130px;height:130px;object-fit:cover;" loading="lazy">
                                                        @else
                                                            <i class="bi bi-person text-white fs-1" aria-hidden="true"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="mb-0 text-white" style="font-size:0.8rem;font-weight:600;">{{ $chairperson->name }}</h6>
                                                    <small class="text-white" style="opacity:0.75;font-size:0.7rem;">{{ $chairperson->title }}</small>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @if($registrar)
                                        <div class="col-6">
                                            <article class="card border-0" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px);">
                                                <div class="card-body text-center text-white p-3">
                                                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center overflow-hidden" style="width:130px;height:130px;background:rgba(255,255,255,0.15);">
                                                        @if($registrar->photo)
                                                            <img src="{{ asset($registrar->photo) }}" alt="{{ $registrar->name }}" style="width:130px;height:130px;object-fit:cover;" loading="lazy">
                                                        @else
                                                            <i class="bi bi-person text-white fs-1" aria-hidden="true"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="mb-0 text-white" style="font-size:0.8rem;font-weight:600;">{{ $registrar->name }}</h6>
                                                    <small class="text-white" style="opacity:0.75;font-size:0.7rem;">{{ $registrar->title }}</small>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================= --}}
            {{-- SLIDES 2+: DYNAMIC from Admin --}}
            {{-- ========================================= --}}
            @foreach($heroSlides as $index => $slide)
            <div class="carousel-item">
                <div class="hero-slide-item">
                    {{-- Background Image --}}
                    <img src="{{ asset($slide->image_path) }}" class="slide-bg-image" alt="{{ $slide->title }}" loading="lazy">
                    {{-- Dark Overlay for text contrast --}}
                    <div class="slide-overlay"></div>
                    {{-- Caption Content --}}
                    <div class="slide-content">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <article class="slide-caption">
                                        <h1>{{ $slide->title }}</h1>
                                        <p>{{ $slide->subtitle }}</p>
                                        <div class="btn-group-slides">
                                            @if($slide->button_text && $slide->button_link)
                                                <a href="{{ $slide->button_link }}" class="btn btn-slide-action btn-lg">
                                                    <i class="bi bi-arrow-right me-2" aria-hidden="true"></i>
                                                    {{ $slide->button_text }}
                                                </a>
                                            @else
                                                <a href="{{ route('pages.show', 'about-us') }}" class="btn btn-slide-action btn-lg">
                                                    <i class="bi bi-arrow-right me-2" aria-hidden="true"></i>
                                                    {{ __('messages.learn_more') }}
                                                </a>
                                            @endif
                                            <a href="{{ route('pages.show', 'how-to-appeal') }}" class="btn btn-slide-outline btn-lg">
                                                {{ app()->getLocale() == 'sw' ? 'Fungua Rufaa' : 'File an Appeal' }}
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                {{-- Leadership Profiles (shown on dynamic slides too) --}}
                                <div class="col-lg-5 d-none d-lg-block">
                                    <aside class="row g-3" aria-label="{{ app()->getLocale() == 'sw' ? 'Viongozi' : 'Leadership' }}">
                                        @if($chairperson)
                                        <div class="col-6">
                                            <article class="card border-0" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px);">
                                                <div class="card-body text-center text-white p-3">
                                                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center overflow-hidden" style="width:130px;height:130px;background:rgba(255,255,255,0.15);">
                                                        @if($chairperson->photo)
                                                            <img src="{{ asset($chairperson->photo) }}" alt="{{ $chairperson->name }}" style="width:130px;height:130px;object-fit:cover;" loading="lazy">
                                                        @else
                                                            <i class="bi bi-person text-white fs-1" aria-hidden="true"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="mb-0 text-white" style="font-size:0.8rem;font-weight:600;">{{ $chairperson->name }}</h6>
                                                    <small class="text-white" style="opacity:0.75;font-size:0.7rem;">{{ $chairperson->title }}</small>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @if($registrar)
                                        <div class="col-6">
                                            <article class="card border-0" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(10px);">
                                                <div class="card-body text-center text-white p-3">
                                                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center overflow-hidden" style="width:130px;height:130px;background:rgba(255,255,255,0.15);">
                                                        @if($registrar->photo)
                                                            <img src="{{ asset($registrar->photo) }}" alt="{{ $registrar->name }}" style="width:130px;height:130px;object-fit:cover;" loading="lazy">
                                                        @else
                                                            <i class="bi bi-person text-white fs-1" aria-hidden="true"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="mb-0 text-white" style="font-size:0.8rem;font-weight:600;">{{ $registrar->name }}</h6>
                                                    <small class="text-white" style="opacity:0.75;font-size:0.7rem;">{{ $registrar->title }}</small>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Carousel Controls --}}
        @if($totalSlides > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="{{ app()->getLocale() == 'sw' ? 'Kipande kilichotangulia' : 'Previous Slide' }}">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="{{ app()->getLocale() == 'sw' ? 'Kipande kinachofuata' : 'Next Slide' }}">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
        @endif
    </div>
</section>

<!-- About Section -->
<section class="py-5" aria-labelledby="about-heading">
    <div class="container py-4">
        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                <article>
                    <h2 id="about-heading" class="fct-primary-text mb-4" style="font-size:1.5rem;">{{ __('messages.about_title') }}</h2>
                    <p class="text-muted mb-3">{{ __('messages.about_p1') }}</p>
                    <p class="text-muted mb-4">{{ __('messages.about_p2') }}</p>
                    <a href="{{ route('pages.show', 'about-us') }}" class="btn btn-fct-primary">{{ __('messages.read_more') }} <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i></a>
                </article>
            </div>
            <div class="col-lg-6">
                <div class="card" style="background:var(--fct-surface);border:1px solid var(--fct-border);">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs about-tabs" role="tablist" aria-label="{{ app()->getLocale() == 'sw' ? 'Kuhusu Sehemu' : 'About Sections' }}">
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link active w-100" id="composition-tab" data-bs-toggle="tab" data-bs-target="#composition" type="button" role="tab" aria-controls="composition" aria-selected="true">{{ __('messages.composition') }}</button>
                            </li>
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link w-100" id="role-tab" data-bs-toggle="tab" data-bs-target="#role" type="button" role="tab" aria-controls="role" aria-selected="false">{{ __('messages.role_functions') }}</button>
                            </li>
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link w-100" id="vision-tab" data-bs-toggle="tab" data-bs-target="#vision" type="button" role="tab" aria-controls="vision" aria-selected="false">{{ __('messages.vision_mission_tab') }}</button>
                            </li>
                        </ul>
                        <div class="tab-content p-4">
                            <div class="tab-pane fade show active" id="composition" role="tabpanel" aria-labelledby="composition-tab">
                                <i class="bi bi-people-fill fct-primary-text fs-2 mb-2 d-block" aria-hidden="true"></i>
                                <h5>{{ __('messages.composition') }}</h5>
                                <p class="text-muted">{{ __('messages.composition_text') }}</p>
                            </div>
                            <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">
                                <i class="bi bi-briefcase-fill fct-primary-text fs-2 mb-2 d-block" aria-hidden="true"></i>
                                <h5>{{ __('messages.role_functions') }}</h5>
                                <p class="text-muted">{{ __('messages.role_functions_text') }}</p>
                            </div>
                            <div class="tab-pane fade" id="vision" role="tabpanel" aria-labelledby="vision-tab">
                                <i class="bi bi-eye-fill fct-primary-text fs-2 mb-2 d-block" aria-hidden="true"></i>
                                <h5>{{ __('messages.vision_mission_tab') }}</h5>
                                <p class="text-muted">{{ __('messages.vision_mission_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-5" style="background:var(--fct-surface);" aria-labelledby="news-heading">
    <div class="container py-4">
        <header class="section-header">
            <h2 id="news-heading">{{ __('messages.latest_news_updates') }}</h2>
        </header>
        <div class="row g-4">
            @forelse($latestNews as $news)
                <article class="col-lg-4 col-md-6">
                    <div class="news-card h-100">
                        @if($news->featured_image)
                            <img src="{{ asset($news->featured_image) }}" alt="{{ $news->title }}" loading="lazy">
                        @else
                            <div style="height:200px;background:linear-gradient(135deg,var(--fct-primary),var(--fct-primary-dark));display:flex;align-items:center;justify-content:center;" role="img" aria-label="{{ $news->title }}">
                                <i class="bi bi-newspaper text-white fs-1" aria-hidden="true"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <time class="date-badge d-block" datetime="{{ $news->published_at ? $news->published_at->format('Y-m-d') : '' }}">
                                <i class="bi bi-calendar3 me-1" aria-hidden="true"></i> {{ $news->published_at ? $news->published_at->format('F j, Y') : '' }}
                            </time>
                            <h5>{{ $news->title }}</h5>
                            <p class="text-muted" style="font-size:0.875rem;">{{ Str::limit(strip_tags($news->excerpt ?? $news->content), 120) }}</p>
                            <a href="{{ route('news.show', $news->slug) }}" class="btn btn-sm btn-fct-primary">{{ __('messages.read_more_btn') }}</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">{{ __('messages.no_news') }}</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('news.index') }}" class="btn btn-outline-primary">{{ __('messages.view_all_news') }}</a>
        </div>
    </div>
</section>

<!-- Information Center -->
<section class="py-5" aria-labelledby="info-heading">
    <div class="container py-4">
        <header class="section-header">
            <h2 id="info-heading">{{ __('messages.information_center') }}</h2>
        </header>
        <nav class="row g-4" aria-label="{{ __('messages.information_center') }}">
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('publications.index', ['category' => 'strategic_plan']) }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-map" aria-hidden="true"></i>
                        <h5>{{ __('messages.strategic_plan') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('pages.show', 'court-proceedings') }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-hammer" aria-hidden="true"></i>
                        <h5>{{ __('messages.court_proceedings') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('publications.index') }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-download" aria-hidden="true"></i>
                        <h5>{{ __('messages.downloads') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('info-library.index', ['category' => 'decided_cases']) }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-check-circle" aria-hidden="true"></i>
                        <h5>{{ __('messages.decided_cases') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('news.index') }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-newspaper" aria-hidden="true"></i>
                        <h5>{{ __('messages.press_release') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('info-library.index', ['category' => 'cause_list']) }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-calendar-week" aria-hidden="true"></i>
                        <h5>{{ __('messages.cause_list') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('pages.show', 'tenders') }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                        <h5>{{ __('messages.tenders') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
            <article class="col-lg-3 col-md-4 col-6">
                <a href="{{ route('pages.show', 'careers') }}" class="text-decoration-none">
                    <div class="info-card">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <h5>{{ __('messages.careers') }}</h5>
                        <span class="fct-primary-text" style="font-size:0.8rem;">{{ __('messages.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
            </article>
        </nav>
    </div>
</section>

<!-- Advertisement Section -->
@if($advertisements->count() > 0)
<section class="py-4" style="background:var(--fct-surface);" aria-label="{{ app()->getLocale() == 'sw' ? 'Matangazo' : 'Advertisements' }}">
    <div class="container">
        <div id="adCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($advertisements as $index => $ad)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <a href="{{ $ad->link_url ?? '#' }}" class="text-decoration-none">
                            <div class="card border-0" style="background: linear-gradient(135deg, var(--fct-primary), var(--fct-primary-dark)); border-radius: 8px;">
                                <div class="card-body text-center text-white py-4">
                                    <h4 class="mb-2">{{ $ad->title }}</h4>
                                    <p class="mb-0 opacity-75">{{ __('messages.click_learn_more') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endsection
