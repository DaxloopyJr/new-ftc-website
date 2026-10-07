@extends('layouts.frontend')

@section('title', $page->getField('title') . ' | Fair Competition Tribunal')
@section('meta_description', $page->meta_description ?? Str::limit(strip_tags($page->getField('content')), 160))
@section('meta_keywords', $page->meta_keywords ?? 'FCT, Fair Competition Tribunal, Tanzania, ' . $page->getField('title'))
@section('og_type', 'article')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "{{ $page->getField('title') }} - Fair Competition Tribunal",
    "description": "{{ Str::limit(strip_tags($page->meta_description ?? $page->getField('content')), 160) }}",
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
        <h1 style="font-size:2rem;">{{ $page->getField('title') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                @if($page->parent)
                    <li class="breadcrumb-item"><a href="{{ route('pages.show', $page->parent->slug) }}">{{ $page->parent->title }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $page->getField('title') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Page Content -->
<section class="py-5" aria-label="{{ $page->getField('title') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        {!! $page->getField('content') !!}

                        {{-- View Team button (tribunal members / management pages) --}}
                        @if(in_array($page->slug, ['tribunal-members', 'management']))
                            <div class="my-4">
                                <a href="{{ route('team.index') }}" class="btn btn-primary">
                                    <i class="bi bi-people me-1"></i> {{ app()->getLocale() == 'sw' ? 'Ona Timu' : 'View Team' }}
                                </a>
                            </div>
                        @endif

                        {{-- Organisation structure chart (uploaded in Admin > Pages) --}}
                        @if($page->org_chart_image)
                            <figure class="my-4">
                                <img src="{{ asset('storage/' . $page->org_chart_image) }}" alt="Organisation structure" class="img-fluid rounded shadow">
                                <figcaption class="text-muted small mt-2">{{ app()->getLocale() == 'sw' ? 'Muundo wa Shirika' : 'Organisation Structure' }}</figcaption>
                            </figure>
                        @endif

                        {{-- Items list: filters + tanzlii-style rows for publications/info; cards for media/news --}}
                        @if(in_array($listKind, ['publication', 'info']))
                            <form method="GET" action="{{ route('pages.show', $page->slug) }}" class="fct-filter-bar row g-2 align-items-end my-3" role="search">
                                <div class="col-md-4">
                                    <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Tafuta' : 'Search' }}</label>
                                    <input type="search" name="q" class="form-control form-control-sm" value="{{ $filters['q'] }}" placeholder="{{ app()->getLocale() == 'sw' ? 'Tafuta...' : 'Search...' }}">
                                </div>
                                @if($showTypeFilter)
                                    <div class="col-md-3">
                                        <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Aina ya Kesi' : 'Case Type' }}</label>
                                        <select name="type" class="form-select form-select-sm">
                                            <option value="">{{ app()->getLocale() == 'sw' ? 'Zote' : 'All' }}</option>
                                            <option value="appeal" {{ $filters['type'] == 'appeal' ? 'selected' : '' }}>{{ app()->getLocale() == 'sw' ? 'Rufaa' : 'Appeal' }}</option>
                                            <option value="application" {{ $filters['type'] == 'application' ? 'selected' : '' }}>{{ app()->getLocale() == 'sw' ? 'Maombi' : 'Application' }}</option>
                                        </select>
                                    </div>
                                @endif
                                @if($showStatusFilter)
                                    <div class="col-md-3">
                                        <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Hali' : 'Status' }}</label>
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="">{{ app()->getLocale() == 'sw' ? 'Zote' : 'All' }}</option>
                                            @foreach(['Hearing', 'Mention', 'Judgement'] as $st)
                                                <option value="{{ $st }}" {{ $filters['status'] == $st ? 'selected' : '' }}>{{ $st }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if($years->count())
                                    <div class="col-md-2">
                                        <label class="form-label small mb-1">{{ app()->getLocale() == 'sw' ? 'Mwaka' : 'Year' }}</label>
                                        <select name="year" class="form-select form-select-sm">
                                            <option value="">{{ app()->getLocale() == 'sw' ? 'Wote' : 'All' }}</option>
                                            @foreach($years as $y)
                                                <option value="{{ $y }}" {{ (string)$filters['year'] === (string)$y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="col-md-3 col-lg-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-sm btn-fct-primary"><i class="bi bi-funnel me-1" aria-hidden="true"></i>{{ app()->getLocale() == 'sw' ? 'Chuja' : 'Filter' }}</button>
                                    <a href="{{ route('pages.show', $page->slug) }}" class="btn btn-sm btn-outline-secondary">{{ app()->getLocale() == 'sw' ? 'Futa' : 'Reset' }}</a>
                                </div>
                            </form>
                        @endif

                        @if($listItems->count())
                            @if(in_array($listKind, ['publication', 'info']))
                                <div class="fct-doclist my-2">
                                    @foreach($listItems as $item)
                                        @php
                                            $icon = 'bi-file-earmark-text'; $iconColor = '#5b6770';
                                            if ($listKind === 'info') {
                                                $ft  = strtolower((string) ($item->file_type ?? ''));
                                                $ext = $item->file_path ? strtolower(pathinfo($item->file_path, PATHINFO_EXTENSION)) : '';
                                                if (str_contains($ft . $ext, 'pdf')) { $icon = 'bi-file-earmark-pdf'; $iconColor = '#c0392b'; }
                                                elseif (str_contains($ft, 'word') || in_array($ext, ['doc','docx'])) { $icon = 'bi-file-earmark-word'; $iconColor = '#2b579a'; }
                                                elseif (str_contains($ft, 'excel') || in_array($ext, ['xls','xlsx','csv'])) { $icon = 'bi-file-earmark-excel'; $iconColor = '#1e7145'; }
                                            }
                                            $metaParts = [];
                                            if ($listKind === 'info') {
                                                $d = $item->decision_date ?? $item->registration_date;
                                                if ($d) { $metaParts[] = ($item->decision_date ? (app()->getLocale() == 'sw' ? 'Ilioamuliwa: ' : 'Decided: ') : (app()->getLocale() == 'sw' ? 'Iliyosajiliwa: ' : 'Registered: ')) . \Illuminate\Support\Carbon::parse($d)->format('d M Y'); }
                                                if ($item->case_type) { $metaParts[] = ucfirst($item->case_type); }
                                                if ($item->status) { $metaParts[] = $item->status; }
                                                if ($item->issue) { $metaParts[] = (app()->getLocale() == 'sw' ? 'Suala: ' : 'Issue: ') . $item->issue; }
                                            } else {
                                                if ($item->year) { $metaParts[] = $item->year; }
                                            }
                                        @endphp
                                        <div class="fct-doclist-row">
                                            <i class="bi {{ $icon }} fct-doclist-icon" style="color: {{ $iconColor }};" aria-hidden="true"></i>
                                            <div class="fct-doclist-main">
                                                <a href="{{ $listKind === 'publication' ? route('publications.show', $item->slug) : route('info-library.show', $item->slug) }}" class="fct-doclist-title">{{ $item->getField('title') }}</a>
                                                @if($item->case_number ?? false)
                                                    <div class="fct-doclist-meta">{{ $item->case_number }}</div>
                                                @endif
                                                @if(count($metaParts))
                                                    <div class="fct-doclist-meta">{{ implode(' &bull; ', $metaParts) }}</div>
                                                @endif
                                                @if($listKind === 'info' && $item->parties)
                                                    <div class="fct-doclist-meta">{{ $item->parties }}</div>
                                                @endif
                                            </div>
                                            <div class="fct-doclist-actions">
                                                <a href="{{ $listKind === 'publication' ? route('publications.show', $item->slug) : route('info-library.show', $item->slug) }}" class="btn btn-sm btn-outline-primary">{{ app()->getLocale() == 'sw' ? 'Ona' : 'View' }}</a>
                                                @if($item->file_path)
                                                    <a href="{{ $listKind === 'publication' ? route('publications.download', $item->slug) : route('info-library.download', $item->slug) }}" class="btn btn-sm btn-primary">{{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row g-3 my-3">
                                    @foreach($listItems as $item)
                                        <div class="col-md-6">
                                            <div class="content-card p-3 h-100 d-flex flex-column">
                                                <h6 class="mb-1">{{ $item->getField('title') }}</h6>
                                                <div class="mt-auto pt-2">
                                                    @if($listKind === 'media')
                                                        <a href="{{ route('gallery.index') }}" class="btn btn-sm btn-primary">{{ app()->getLocale() == 'sw' ? 'Ona' : 'View' }}</a>
                                                    @else
                                                        <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-primary">{{ app()->getLocale() == 'sw' ? 'Soma Zaidi' : 'Read More' }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(method_exists($listItems, 'links'))
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $listItems->links() }}
                                </div>
                            @endif
                        @else
                            @if(in_array($listKind, ['publication', 'info']))
                                <div class="alert alert-info my-3">{{ app()->getLocale() == 'sw' ? 'Hakuna rekodi zilizopatikana.' : 'No records found.' }}</div>
                            @endif
                        @endif
                    </div>
                </article>
            </div>
            <aside class="col-lg-4" aria-label="{{ app()->getLocale() == 'sw' ? 'Ukurasa wa pili' : 'Sidebar' }}">
                @if($page->children && $page->children->count() > 0)
                    <nav class="card border-0 shadow-sm mb-4" aria-label="{{ $page->getField('title') }} {{ app()->getLocale() == 'sw' ? 'chini' : 'children' }}">
                        <div class="card-header bg-white" style="border-bottom:2px solid var(--fct-primary);">
                            <h5 class="mb-0 fct-primary-text">{{ $page->getField('title') }}</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($page->children as $child)
                                <a href="{{ route('pages.show', $child->slug) }}" class="list-group-item list-group-item-action {{ request()->is($child->slug) ? 'active' : '' }}">
                                    <i class="bi bi-chevron-right me-2" style="font-size:0.75rem;" aria-hidden="true"></i>{{ $child->getField('title') }}
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
                                    <i class="bi bi-chevron-right me-2" style="font-size:0.75rem;" aria-hidden="true"></i>{{ $sibling->getField('title') }}
                                </a>
                            @endforeach
                        </div>
                    </nav>
                @endif

                <div class="content-card mb-4">
                        <h5 class="fct-primary-text mb-3">{{ app()->getLocale() == 'sw' ? 'Habari Mpya' : 'Recent News' }}</h5>
                        @if($recentNews->count())
                            <ul class="list-unstyled mb-0">
                                @foreach($recentNews as $rn)
                                    <li class="mb-2 pb-2" style="border-bottom:1px solid var(--fct-border,#e3e7ea);">
                                        <a href="{{ route('news.show', $rn->slug) }}" class="fct-doclist-title" style="font-size:.88rem;">{{ $rn->getField('title') }}</a>
                                        <div class="fct-doclist-meta">{{ optional($rn->published_at)->format('d M Y') }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'sw' ? 'Hakuna habari.' : 'No news yet.' }}</p>
                        @endif
                    </div>

                    <div class="content-card mb-4">
                        <h5 class="fct-primary-text mb-3">{{ app()->getLocale() == 'sw' ? 'Matangazo' : 'Announcements' }}</h5>
                        @if($recentAnnouncements->count())
                            <ul class="list-unstyled mb-0">
                                @foreach($recentAnnouncements as $ra)
                                    <li class="mb-2 pb-2" style="border-bottom:1px solid var(--fct-border,#e3e7ea);">
                                        <a href="{{ route('announcements.index') }}" class="fct-doclist-title" style="font-size:.88rem;">{{ $ra->getField('title') }}</a>
                                        <div class="fct-doclist-meta">{{ optional($ra->published_at)->format('d M Y') }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'sw' ? 'Hakuna matangazo.' : 'No announcements.' }}</p>
                        @endif
                    </div>
            </aside>
        </div>
    </div>
</section>
@endsection
