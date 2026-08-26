<!-- Top Bar -->
<div class="top-bar" role="banner" aria-label="{{ __('messages.united_republic_tanzania') }}">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-1">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <span class="text-muted"><i class="bi bi-globe me-1" aria-hidden="true"></i> {{ __('messages.united_republic_tanzania') }}</span>
                <span class="text-muted d-none d-sm-inline">|</span>
                <a href="mailto:info@fct.go.tz" aria-label="{{ __('messages.webmail') }}"><i class="bi bi-envelope me-1" aria-hidden="true"></i> {{ __('messages.webmail') }}</a>
                <a href="#" aria-label="{{ __('messages.complaints') }}"><i class="bi bi-exclamation-triangle me-1" aria-hidden="true"></i> {{ __('messages.complaints') }}</a>
                <a href="#" aria-label="{{ __('messages.e_office') }}"><i class="bi bi-building me-1" aria-hidden="true"></i> {{ __('messages.e_office') }}</a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Language Switcher -->
                <div class="language-switcher" role="group" aria-label="{{ __('messages.language') }}">
                    <a href="{{ url()->current() }}?lang=en" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" aria-label="Switch to English" title="English">EN</a>
                    <a href="{{ url()->current() }}?lang=sw" class="lang-btn {{ app()->getLocale() == 'sw' ? 'active' : '' }}" aria-label="Switch to Swahili" title="Swahili">SW</a>
                </div>
                <span class="text-muted d-none d-md-inline"><i class="bi bi-clock me-1" aria-hidden="true"></i> {{ now()->format('l, F j, Y') }}</span>
                <a href="#" aria-label="Accessibility"><i class="bi bi-universal-access fs-5" aria-hidden="true"></i></a>
                <a href="#" aria-label="Search"><i class="bi bi-search fs-5" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Identity Bar with Banner Background -->
<div class="identity-bar">
    <!-- Blurred Banner Background -->
    <div class="banner-bg" aria-hidden="true"></div>
    <div class="banner-overlay" aria-hidden="true"></div>
    <!-- Content -->
    <div class="container identity-content">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/tzlogo.png') }}" alt="{{ __('messages.united_republic_tanzania') }}" style="height: 85px;">
                </div>
            </div>
            <div class="text-center">
                <div class="fct-logo-text">{{ __('messages.united_republic_tanzania') }}</div>
                <div class="fct-logo-text">{{ app()->getLocale() == 'sw' ? 'WIZARA YA VIWANDA NA BIASHARA' : 'MINISTRY OF INDUSTRY AND TRADE' }}</div>
                <div class="fct-logo-text"><h1 style="font-size: 1.5rem;"><strong>{{ app()->getLocale() == 'sw' ? 'TRIBUNAL YA USHINDANI WA HAKI (FCT)' : 'FAIR COMPETITION TRIBUNAL (FCT)' }}</strong></h1></div>
                <div class="tz-colors" aria-hidden="true">
                    <div class="tz-color-bar tz-green"></div>
                    <div class="tz-color-bar tz-yellow"></div>
                    <div class="tz-color-bar tz-black"></div>
                    <div class="tz-color-bar tz-blue"></div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/fct-logo.png') }}" alt="FCT {{ app()->getLocale() == 'sw' ? 'Nembo' : 'Logo' }}" style="height: 85px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-fct sticky-top" role="navigation" aria-label="{{ app()->getLocale() == 'sw' ? 'Urambazaji Kuu' : 'Main Navigation' }}">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#fctNavbar" aria-controls="fctNavbar" aria-expanded="false" aria-label="{{ app()->getLocale() == 'sw' ? 'Badili urambazaji' : 'Toggle navigation' }}">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="fctNavbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}" aria-current="{{ request()->is('/') ? 'page' : 'false' }}">{{ strtolower(__('messages.home')) }}</a>
                </li>
                @php
                    $headerPages = \App\Models\Page::whereNull('parent_id')
                        ->where('is_published', true)
                        ->with('children')
                        ->get();
                @endphp

                @foreach($headerPages ?? [] as $page)
                    @if($page->children->count() > 0)
                        <li class="nav-item dropdown {{ request()->is($page->slug . '*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle {{ request()->is($page->slug . '*') ? 'active' : '' }}" href="{{ route('pages.show', $page->slug) }}" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-{{ $page->slug }}">
                                {{ strtolower($page->title) }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-{{ $page->slug }}">
                                @foreach($page->children as $child)
                                    <li><a class="dropdown-item {{ request()->is($child->slug) ? 'active' : '' }}" href="{{ route('pages.show', $child->slug) }}">{{ strtolower($child->title) }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item {{ request()->is($page->slug) ? 'active' : '' }}">
                            <a class="nav-link {{ request()->is($page->slug) ? 'active' : '' }}" href="{{ route('pages.show', $page->slug) }}" aria-current="{{ request()->is($page->slug) ? 'page' : 'false' }}">{{ strtolower($page->title) }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
