@extends('layouts.frontend')

@section('title', $page->title . ' | Fair Competition Tribunal')
@section('meta_description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160))
@section('meta_keywords', $page->meta_keywords ?? 'FCT, Fair Competition Tribunal, Tanzania, ' . $page->title)
@section('og_type', 'article')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "{{ $page->title }} - Fair Competition Tribunal",
    "description": "{{ Str::limit(strip_tags($page->meta_description ?? $page->content), 160) }}",
    "url": "{{ route('pages.show', $page->slug) }}",
    "dateModified": "{{ $page->updated_at->toIso8601String() }}",
    "isPartOf": {
        "@type": "WebSite",
        "name": "Fair Competition Tribunal - Tanzania",
        "url": "{{ url('/') }}"
    }
}
</script>
@endsection

@section('content')
<!-- Page Header -->
<section class="breadcrumb-fct" aria-label="{{ app()->getLocale() == 'sw' ? 'Kichwa cha Ukurasa' : 'Page Header' }}">
    <div class="container py-4">
        <h1 style="font-size:2rem;">{{ $page->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                @if($page->parent)
                    <li class="breadcrumb-item"><a href="{{ route('pages.show', $page->parent->slug) }}">{{ $page->parent->title }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Page Content -->
<section class="py-5" aria-label="{{ $page->title }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        {!! $page->content !!}
                    </div>
                </article>
            </div>
            <aside class="col-lg-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Ukurasa wa pili' : 'Sidebar' }}">
                @if($page->children && $page->children->count() > 0)
                    <nav class="card border-0 shadow-sm mb-4" aria-label="{{ $page->title }} {{ app()->getLocale() == 'sw' ? 'chini' : 'children' }}">
                        <div class="card-header bg-white" style="border-bottom:2px solid var(--fct-primary);">
                            <h5 class="mb-0 fct-primary-text">{{ $page->title }}</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($page->children as $child)
                                <a href="{{ route('pages.show', $child->slug) }}" class="list-group-item list-group-item-action {{ request()->is($child->slug) ? 'active' : '' }}">
                                    <i class="bi bi-chevron-right me-2" style="font-size:0.75rem;" aria-hidden="true"></i>{{ $child->title }}
                                </a>
                            @endforeach
                        </div>
                    </nav>
                @elseif($page->parent && $page->parent->children->count() > 0)
                    <nav class="card border-0 shadow-sm mb-4" aria-label="{{ $page->parent->title }} {{ app()->getLocale() == 'sw' ? 'chini' : 'children' }}">
                        <div class="card-header bg-white" style="border-bottom:2px solid var(--fct-primary);">
                            <h5 class="mb-0 fct-primary-text">{{ $page->parent->title }}</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($page->parent->children as $sibling)
                                <a href="{{ route('pages.show', $sibling->slug) }}" class="list-group-item list-group-item-action {{ $sibling->id === $page->id ? 'active' : '' }}">
                                    <i class="bi bi-chevron-right me-2" style="font-size:0.75rem;" aria-hidden="true"></i>{{ $sibling->title }}
                                </a>
                            @endforeach
                        </div>
                    </nav>
                @endif

                <div class="card border-0 shadow-sm" style="background:linear-gradient(135deg, var(--fct-primary) 0%, var(--fct-primary-dark) 100%);">
                    <div class="card-body text-white text-center p-4">
                        <i class="bi bi-telephone-fill fs-1 mb-3 d-block" aria-hidden="true"></i>
                        <h5>{{ app()->getLocale() == 'sw' ? 'Unahitaji Msaada?' : 'Need Help?' }}</h5>
                        <p class="opacity-75 mb-3" style="font-size:0.875rem;">{{ app()->getLocale() == 'sw' ? 'Wasiliana nasi kwa usaidizi wa rufaa na maswali.' : 'Contact us for assistance with appeals and inquiries.' }}</p>
                        <a href="{{ route('contact') }}" class="btn btn-light btn-sm">{{ __('messages.contact_us') }}</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
