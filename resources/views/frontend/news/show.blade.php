@extends('layouts.frontend')

@section('title', $newsItem->title . ' | Fair Competition Tribunal')
@section('meta_description', Str::limit(strip_tags($newsItem->excerpt ?? $newsItem->content), 160))
@section('meta_keywords', 'FCT, ' . $newsItem->title . ', Fair Competition Tribunal, Tanzania')
@section('og_type', 'article')
@section('og_image', $newsItem->featured_image ? asset($newsItem->featured_image) : asset('assets/images/fct-logo.png'))

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "headline": "{{ $newsItem->title }}",
    "description": "{{ Str::limit(strip_tags($newsItem->excerpt ?? $newsItem->content), 160) }}",
    "image": "{{ $newsItem->featured_image ? asset($newsItem->featured_image) : asset('assets/images/fct-logo.png') }}",
    "datePublished": "{{ $newsItem->published_at ? $newsItem->published_at->toIso8601String() : '' }}",
    "dateModified": "{{ $newsItem->updated_at->toIso8601String() }}",
    "author": {
        "@type": "Organization",
        "name": "Fair Competition Tribunal - Tanzania"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Fair Competition Tribunal - Tanzania",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/images/fct-logo.png') }}"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('news.show', $newsItem->slug) }}"
    }
}
</script>
@endsection

@section('content')
<!-- Page Header -->
<section class="breadcrumb-fct" aria-label="{{ app()->getLocale() == 'sw' ? 'Kichwa cha Ukurasa' : 'Page Header' }}">
    <div class="container py-4">
        <h1 style="font-size:1.75rem;">{{ $newsItem->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">{{ __('messages.news_updates') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($newsItem->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Article Section -->
<section class="py-5" aria-label="{{ app()->getLocale() == 'sw' ? 'Maudhui ya Habari' : 'News Article' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm">
                    @if($newsItem->featured_image)
                        <img src="{{ asset($newsItem->featured_image) }}" class="card-img-top" alt="{{ $newsItem->title }}" style="max-height:400px;object-fit:cover;" loading="eager">
                    @endif
                    <div class="card-body p-4 p-lg-5">
                        <header class="d-flex flex-wrap gap-3 text-muted mb-3" style="font-size:0.875rem;">
                            <time datetime="{{ $newsItem->published_at ? $newsItem->published_at->format('Y-m-d') : '' }}">
                                <i class="bi bi-calendar3 me-1" aria-hidden="true"></i> {{ $newsItem->published_at ? $newsItem->published_at->format('F j, Y') : '' }}
                            </time>
                            @if($newsItem->event_date)<time datetime="{{ $newsItem->event_date->format('Y-m-d') }}"><i class="bi bi-calendar-event me-1" aria-hidden="true"></i> {{ app()->getLocale() == 'sw' ? 'Tukio' : 'Event' }}: {{ $newsItem->event_date->format('F j, Y') }}</time>@endif
                            @if($newsItem->location)<span><i class="bi bi-geo-alt me-1" aria-hidden="true"></i> {{ $newsItem->location }}</span>@endif
                            <span><i class="bi bi-eye me-1" aria-hidden="true"></i> {{ number_format($newsItem->view_count) }} {{ app()->getLocale() == 'sw' ? 'mara zilizotazamwa' : 'views' }}</span>
                        </header>
                        <div class="article-content">
                            {!! $newsItem->content !!}
                        </div>
                    </div>
                </article>
            </div>
            <aside class="col-lg-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Habari Zinazohusiana' : 'Related News' }}">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white" style="border-bottom:2px solid var(--fct-primary);">
                        <h5 class="mb-0 fct-primary-text">{{ app()->getLocale() == 'sw' ? 'Habari Zinazohusiana' : 'Related News' }}</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($relatedNews as $related)
                            <a href="{{ route('news.show', $related->slug) }}" class="list-group-item list-group-item-action">
                                <time class="text-muted d-block" style="font-size:0.75rem;" datetime="{{ $related->published_at ? $related->published_at->format('Y-m-d') : '' }}">{{ $related->published_at ? $related->published_at->format('M j, Y') : '' }}</time>
                                {{ Str::limit($related->title, 60) }}
                            </a>
                        @empty
                            <div class="list-group-item text-muted">{{ app()->getLocale() == 'sw' ? 'Hakuna habari zinazohusiana' : 'No related news' }}</div>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
