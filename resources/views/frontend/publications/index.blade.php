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
                "name": "{{ $pub->title }}"
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

        <div class="row g-4">
            @forelse($publications as $pub)
                <article class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <span class="badge" style="background:var(--fct-primary);font-size:0.7rem;">{{ $pub->category_label }}</span>
                            <h5 class="mt-2 mb-2" style="font-size:1rem;">{{ $pub->title }}</h5>
                            <p class="text-muted" style="font-size:0.875rem;">{{ Str::limit($pub->description, 100) }}</p>
                            @if($pub->year)<small class="text-muted d-block mb-2">{{ app()->getLocale() == 'sw' ? 'Mwaka' : 'Year' }}: {{ $pub->year }}</small>@endif
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="text-muted" style="font-size:0.75rem;"><i class="bi bi-download me-1" aria-hidden="true"></i>{{ $pub->download_count }} {{ app()->getLocale() == 'sw' ? 'vipakuzi' : 'downloads' }}</span>
                                <a href="{{ route('publications.download', $pub->slug) }}" class="btn btn-sm btn-fct-primary"><i class="bi bi-download" aria-hidden="true"></i> {{ __('messages.download') }}</a>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted" aria-hidden="true"></i>
                    <p class="text-muted mt-3">{{ __('messages.no_publications') }}</p>
                </div>
            @endforelse
        </div>
        <nav class="d-flex justify-content-center mt-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Ukurasa wa machapisho' : 'Publications pagination' }}">
            {{ $publications->links() }}
        </nav>
    </div>
</section>
@endsection
