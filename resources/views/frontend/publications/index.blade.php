@extends('layouts.frontend')

@section('title', __('messages.publications') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_publications'))
@section('meta_keywords', 'FCT publications, Fair Competition Tribunal reports, strategic plan, annual reports, Tanzania')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ __('messages.publications') }} - Fair Competition Tribunal",
    "description": "{{ __('messages.meta_publications') }}",
    "url": "{{ route('publications.index') }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @foreach($publications as $index => $pub)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "url": "{{ route('publications.show', $pub->slug) }}",
                "name": "{{ $pub->getField('title') }}"
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
        <h1>{{ __('messages.publications') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.publications') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Publications Section -->
<section class="py-5" aria-label="{{ __('messages.publications') }}">
    <div class="container">
        <!-- Category Filters -->
        <nav class="row g-3 mb-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Kategoria za Machapisho' : 'Publication Categories' }}">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('publications.index') }}" class="btn btn-sm {{ !$category ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Yote' : 'All' }}</a>
                    <a href="{{ route('publications.index', ['category' => 'acts_and_rules']) }}" class="btn btn-sm {{ $category == 'acts_and_rules' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Sheria na Kanuni' : 'Acts & Rules' }}</a>
                    <a href="{{ route('publications.index', ['category' => 'strategic_plan']) }}" class="btn btn-sm {{ $category == 'strategic_plan' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.strategic_plan') }}</a>
                    <a href="{{ route('publications.index', ['category' => 'client_service_charter']) }}" class="btn btn-sm {{ $category == 'client_service_charter' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Hati ya Huduma kwa Wateja' : 'Client Service Charter' }}</a>
                    <a href="{{ route('publications.index', ['category' => 'annual_report']) }}" class="btn btn-sm {{ $category == 'annual_report' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Ripoti za Mwaka' : 'Annual Reports' }}</a>
                </div>
            </div>
        </nav>

                {{-- Filters --}}
        <form id="doclist-filters" method="GET" action="{{ route('publications.index') }}" class="fct-filter-bar row g-2 align-items-end mb-4" role="search">
            @if($category)<input type="hidden" name="category" value="{{ $category }}">@endif
            <div class="col-md-4">
                <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Tafuta' : 'Search' }}</label>
                <input type="search" name="q" class="form-control form-control-sm" value="{{ $filters['q'] ?? '' }}" placeholder="{{ app()->getLocale() == 'sw' ? 'Tafuta...' : 'Search...' }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Mwaka' : 'Year' }}</label>
                <select name="year" class="form-select form-select-sm">
                    <option value="">{{ app()->getLocale() == 'sw' ? 'Wote' : 'All' }}</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ (string)($filters['year'] ?? '') === (string)$y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-fct-primary"><i class="bi bi-funnel me-1" aria-hidden="true"></i>{{ app()->getLocale() == 'sw' ? 'Chuja' : 'Filter' }}</button>
                <a href="{{ route('publications.index', $category ? ['category' => $category] : []) }}" class="btn btn-sm btn-outline-secondary">{{ app()->getLocale() == 'sw' ? 'Futa' : 'Reset' }}</a>
            </div>
        </form>

        {{-- Document list (updated via AJAX) --}}
        <div id="doclist-wrap">
            @include('frontend.partials.doclist', ['listItems' => $publications, 'listKind' => 'publication'])
        </div>
        <nav class="d-flex justify-content-center mt-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Ukurasa wa machapisho' : 'Publications pagination' }}">
            {{ $publications->links() }}
        </nav>
    </div>
</section>
@section('scripts')
<script src="{{ asset('assets/js/fct-doclist.js') }}"></script>
@endsection

@endsection
