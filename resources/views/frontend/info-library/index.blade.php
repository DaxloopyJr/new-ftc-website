@extends('layouts.frontend')

@section('title', __('messages.info_library_title') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_info_library'))
@section('meta_keywords', 'FCT legal documents, decided cases, cause list, Tanzania competition tribunal, case digest')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ __('messages.info_library_title') }} - Fair Competition Tribunal",
    "description": "{{ __('messages.meta_info_library') }}",
    "url": "{{ route('info-library.index') }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @foreach($items as $index => $item)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "url": "{{ route('info-library.show', $item->slug) }}",
                "name": "{{ $item->getField('title') }}"
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
}
</script>
@endsection

@section('content')
<!-- Page Header -->
<section class="breadcrumb-fct" aria-label="{{ app()->getLocale() == 'sw' ? 'Kichwa cha Ukurasa' : 'Page Header' }}">
    <div class="container py-4">
        <h1>{{ __('messages.info_library_title') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.info_library_title') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Info Library Section -->
<section class="py-5" aria-label="{{ __('messages.info_library_title') }}">
    <div class="container">
        <!-- Category Filters -->
        <nav class="row g-3 mb-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Kategoria za Maktaba' : 'Library Categories' }}">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('info-library.index') }}" class="btn btn-sm {{ !$category ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Zote' : 'All' }}</a>
                    <a href="{{ route('info-library.index', ['category' => 'case_digest']) }}" class="btn btn-sm {{ $category == 'case_digest' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Muhtasari wa Kesi' : 'Case Digest' }}</a>
                    <a href="{{ route('info-library.index', ['category' => 'decided_cases']) }}" class="btn btn-sm {{ $category == 'decided_cases' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.decided_cases') }}</a>
                    <a href="{{ route('info-library.index', ['category' => 'registered_cases']) }}" class="btn btn-sm {{ $category == 'registered_cases' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Kesi Zilizosajiliwa' : 'Registered Cases' }}</a>
                    <a href="{{ route('info-library.index', ['category' => 'cause_list']) }}" class="btn btn-sm {{ $category == 'cause_list' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.cause_list') }}</a>
                    <a href="{{ route('info-library.index', ['category' => 'brochure']) }}" class="btn btn-sm {{ $category == 'brochure' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Vipeperushi' : 'Brochures' }}</a>
                </div>
            </div>
        </nav>

        {{-- Filters --}}
        <form id="doclist-filters" method="GET" action="{{ route('info-library.index') }}" class="fct-filter-bar row g-2 align-items-end mb-4" role="search">
            @if($category)<input type="hidden" name="category" value="{{ $category }}">@endif
            <div class="col-md-3">
                <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Tafuta' : 'Search' }}</label>
                <input type="search" name="q" class="form-control form-control-sm" value="{{ $filters['q'] ?? '' }}" placeholder="{{ app()->getLocale() == 'sw' ? 'Tafuta...' : 'Search...' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Aina ya Kesi' : 'Case Type' }}</label>
                <select name="type" class="form-select form-select-sm">
                    <option value="">{{ app()->getLocale() == 'sw' ? 'Zote' : 'All' }}</option>
                    <option value="appeal" {{ ($filters['type'] ?? '') == 'appeal' ? 'selected' : '' }}>{{ app()->getLocale() == 'sw' ? 'Rufaa' : 'Appeal' }}</option>
                    <option value="application" {{ ($filters['type'] ?? '') == 'application' ? 'selected' : '' }}>{{ app()->getLocale() == 'sw' ? 'Maombi' : 'Application' }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Hali' : 'Status' }}</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">{{ app()->getLocale() == 'sw' ? 'Zote' : 'All' }}</option>
                    @foreach(['Hearing', 'Mention', 'Judgement'] as $st)
                        <option value="{{ $st }}" {{ ($filters['status'] ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Mwaka' : 'Year' }}</label>
                <select name="year" class="form-select form-select-sm">
                    <option value="">{{ app()->getLocale() == 'sw' ? 'Wote' : 'All' }}</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ (string)($filters['year'] ?? '') === (string)$y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-fct-primary"><i class="bi bi-funnel me-1" aria-hidden="true"></i>{{ app()->getLocale() == 'sw' ? 'Chuja' : 'Filter' }}</button>
                <a href="{{ route('info-library.index', $category ? ['category' => $category] : []) }}" class="btn btn-sm btn-outline-secondary">{{ app()->getLocale() == 'sw' ? 'Futa' : 'Reset' }}</a>
            </div>
        </form>

        {{-- Document list (updated via AJAX) --}}
        <div id="doclist-wrap">
            @include('frontend.partials.doclist', ['listItems' => $items, 'listKind' => 'info'])
        </div>
    </div>
</section>
@section('scripts')
<script src="{{ asset('assets/js/fct-doclist.js') }}"></script>
@endsection

@endsection
