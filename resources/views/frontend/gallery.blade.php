@extends('layouts.frontend')

@section('title', __('messages.media_gallery') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_gallery'))
@section('meta_keywords', 'FCT gallery, Fair Competition Tribunal photos, Tanzania tribunal events, media gallery')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ImageGallery",
    "name": "{{ __('messages.media_gallery') }} - Fair Competition Tribunal",
    "description": "{{ __('messages.meta_gallery') }}",
    "url": "{{ route('gallery.index') }}",
    "about": {
        "@type": "GovernmentOrganization",
        "name": "Fair Competition Tribunal - Tanzania"
    }
}
</script>
@endsection

@section('content')
<!-- Page Header -->
<section class="breadcrumb-fct" aria-label="{{ app()->getLocale() == 'sw' ? 'Kichwa cha Ukurasa' : 'Page Header' }}">
    <div class="container py-4">
        <h1>{{ __('messages.media_gallery') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.media_gallery') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5" aria-label="{{ __('messages.media_gallery') }}">
    <div class="container">
        <!-- Category Filters -->
        <nav class="d-flex justify-content-center gap-2 mb-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Kategoria za Maktaba' : 'Gallery Categories' }}">
            <a href="{{ route('gallery.index', ['category' => 'photo_gallery']) }}" class="btn btn-sm {{ $category == 'photo_gallery' ? 'btn-fct-primary' : 'btn-outline-primary' }}"><i class="bi bi-images me-1" aria-hidden="true"></i>{{ __('messages.photos') }}</a>
            <a href="{{ route('gallery.index', ['category' => 'video_gallery']) }}" class="btn btn-sm {{ $category == 'video_gallery' ? 'btn-fct-primary' : 'btn-outline-primary' }}"><i class="bi bi-camera-video me-1" aria-hidden="true"></i>{{ __('messages.videos') }}</a>
        </nav>

        <div class="row g-3">
            @forelse($items as $item)
                <article class="col-lg-3 col-md-4 col-6">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        @if($item->file_type == 'image')
                            <img src="{{ asset($item->file_path) }}" class="card-img-top" alt="{{ $item->title }}" style="height:200px;object-fit:cover;" loading="lazy">
                        @else
                            <div class="d-flex align-items-center justify-content-center" style="height:200px;background:linear-gradient(135deg,var(--fct-primary),var(--fct-primary-dark));" role="img" aria-label="{{ $item->title }}">
                                <i class="bi bi-play-circle-fill text-white fs-1" aria-hidden="true"></i>
                            </div>
                        @endif
                        <div class="card-body p-2 text-center">
                            <small class="text-muted">{{ $item->title }}</small>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-images fs-1 text-muted" aria-hidden="true"></i>
                    <p class="text-muted mt-3">{{ app()->getLocale() == 'sw' ? 'Hakuna ' : 'No ' }}{{ $category == 'photo_gallery' ? (app()->getLocale() == 'sw' ? 'picha' : 'photos') : (app()->getLocale() == 'sw' ? 'video' : 'videos') }}{{ app()->getLocale() == 'sw' ? ' zilizopo.' : ' available.' }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
