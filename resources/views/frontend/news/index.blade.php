@extends('layouts.frontend')

@section('title', __('messages.news_updates') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_news'))
@section('meta_keywords', 'FCT news, Fair Competition Tribunal updates, Tanzania competition news, tribunal announcements')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ __('messages.news_updates') }} - Fair Competition Tribunal",
    "description": "{{ __('messages.meta_news') }}",
    "url": "{{ route('news.index') }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @foreach($news as $index => $item)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "url": "{{ route('news.show', $item->slug) }}",
                "name": "{{ $item->title }}"
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
        <h1>{{ __('messages.news_updates') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.news_updates') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- News Section -->
<section class="py-5" aria-label="{{ __('messages.news_updates') }}">
    <div class="container">
        <div class="row g-4">
            @forelse($news as $item)
                <article class="col-lg-4 col-md-6">
                    <div class="news-card h-100">
                        @if($item->featured_image)
                            <img src="{{ asset($item->featured_image) }}" alt="{{ $item->title }}" loading="lazy">
                        @else
                            <div style="height:200px;background:linear-gradient(135deg,var(--fct-primary),var(--fct-primary-dark));display:flex;align-items:center;justify-content:center;" role="img" aria-label="{{ $item->title }}">
                                <i class="bi bi-newspaper text-white fs-1" aria-hidden="true"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <time class="date-badge d-block" datetime="{{ $item->published_at ? $item->published_at->format('Y-m-d') : '' }}">
                                <i class="bi bi-calendar3 me-1" aria-hidden="true"></i> {{ $item->published_at ? $item->published_at->format('F j, Y') : '' }}
                            </time>
                            <h5>{{ $item->title }}</h5>
                            <p class="text-muted" style="font-size:0.875rem;">{{ Str::limit(strip_tags($item->excerpt ?? $item->content), 120) }}</p>
                            <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-fct-primary">{{ __('messages.read_more_btn') }}</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted" aria-hidden="true"></i>
                    <p class="text-muted mt-3">{{ __('messages.no_news') }}</p>
                </div>
            @endforelse
        </div>
        <nav class="d-flex justify-content-center mt-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Ukurasa wa habari' : 'News pagination' }}">
            {{ $news->links() }}
        </nav>
    </div>
</section>
@endsection
