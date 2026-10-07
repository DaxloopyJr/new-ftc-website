@extends('layouts.frontend')

@section('title', (app()->getLocale() == 'sw' ? 'Matokeo ya Utafutaji' : 'Search Results') . ' | Fair Competition Tribunal')

@section('content')
<section class="breadcrumb-fct">
    <div class="container py-4">
        <h1>{{ app()->getLocale() == 'sw' ? 'Tafuta' : 'Search' }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'sw' ? 'Tafuta' : 'Search' }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <form action="{{ route('search') }}" method="GET" class="d-flex mb-4" role="search">
            <input type="search" name="q" class="form-control me-2" placeholder="{{ app()->getLocale() == 'sw' ? 'Tafuta tovuti...' : 'Search the site...' }}" value="{{ $q }}" minlength="2" required>
            <button class="btn btn-fct-primary" type="submit"><i class="bi bi-search me-1" aria-hidden="true"></i>{{ app()->getLocale() == 'sw' ? 'Tafuta' : 'Search' }}</button>
        </form>

        @if(mb_strlen($q) >= 2)
            <p class="text-muted mb-3">
                {{ $results->count() }} {{ app()->getLocale() == 'sw' ? 'matokeo ya' : 'results for' }} &ldquo;{{ $q }}&rdquo;
            </p>
            @if($results->count())
                <div class="list-group">
                    @foreach($results as $r)
                        <a href="{{ $r['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>
                                <span class="badge bg-secondary me-2">{{ $r['type'] }}</span>{{ $r['title'] }}
                            </span>
                            @if($r['meta'])
                                <small class="text-muted ms-2 flex-shrink-0">{{ $r['meta'] }}</small>
                            @endif
                        </a>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    {{ app()->getLocale() == 'sw' ? 'Hakuna matokeo yaliyopatikana. Jaribu neno lingine.' : 'No results found. Try a different keyword.' }}
                </div>
            @endif
        @else
            <div class="alert alert-secondary">
                {{ app()->getLocale() == 'sw' ? 'Andika angalau herufi 2 kutafuta.' : 'Type at least 2 characters to search.' }}
            </div>
        @endif
    </div>
</section>
@endsection
