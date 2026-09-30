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

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background:var(--fct-surface);">
                        <tr>
                            <th scope="col">{{ app()->getLocale() == 'sw' ? 'Kichwa' : 'Title' }}</th>
                            <th scope="col">{{ __('messages.category') }}</th>
                            <th scope="col">{{ app()->getLocale() == 'sw' ? 'Na. ya Kesi' : 'Case No.' }}</th>
                            <th scope="col">{{ app()->getLocale() == 'sw' ? 'Tarehe' : 'Date' }}</th>
                            <th scope="col">{{ app()->getLocale() == 'sw' ? 'Kitendo' : 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->getField('title') }}</strong>
                                    @if($item->parties)<br><small class="text-muted">{{ $item->parties }}</small>@endif
                                </td>
                                <td><span class="badge" style="background:var(--fct-primary);">{{ $item->category_label }}</span></td>
                                <td>{{ $item->case_number ?? '-' }}</td>
                                <td><time datetime="{{ $item->decision_date ? $item->decision_date->format('Y-m-d') : '' }}">{{ $item->decision_date ? $item->decision_date->format('M j, Y') : '-' }}</time></td>
                                <td>
                                    <a href="{{ route('info-library.download', $item->slug) }}" class="btn btn-sm btn-fct-primary" aria-label="{{ __('messages.download') }} {{ $item->getField('title') }}"><i class="bi bi-download" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">{{ __('messages.no_documents') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <nav class="d-flex justify-content-center mt-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Ukurasa wa nyaraka' : 'Documents pagination' }}">
            {{ $items->links() }}
        </nav>
    </div>
</section>
@endsection
