@extends('layouts.frontend')

@section('title', __('messages.meet_team') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_team'))
@section('meta_keywords', 'Fair Competition Tribunal team, tribunal members, management, FCT Tanzania staff')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ProfilePage",
    "name": "{{ __('messages.meet_team') }} - Fair Competition Tribunal",
    "description": "{{ __('messages.meta_team') }}",
    "url": "{{ route('team.index') }}",
    "mainEntity": {
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
        <h1>{{ __('messages.meet_team') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.meet_team') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Team Section -->
<section class="py-5" aria-label="{{ app()->getLocale() == 'sw' ? 'Timu' : 'Team Members' }}">
    <div class="container">
        <!-- Category Filters -->
        <nav class="d-flex flex-wrap gap-2 mb-5 justify-content-center" aria-label="{{ app()->getLocale() == 'sw' ? 'Kategoria za Timu' : 'Team Categories' }}">
            <a href="{{ route('team.index') }}" class="btn btn-sm {{ !$category ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Wote' : 'All' }}</a>
            <a href="{{ route('team.index', ['category' => 'tribunal_member']) }}" class="btn btn-sm {{ $category == 'tribunal_member' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.tribunal_members') }}</a>
            <a href="{{ route('team.index', ['category' => 'management']) }}" class="btn btn-sm {{ $category == 'management' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.management') }}</a>
            <a href="{{ route('team.index', ['category' => 'secretariat']) }}" class="btn btn-sm {{ $category == 'secretariat' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Utawala' : 'Secretariat' }}</a>
        </nav>

        @php
            $tribunalMembers = $members->where('category', 'tribunal_member');
            $management = $members->where('category', 'management');
            $secretariat = $members->where('category', 'secretariat');
            $groups = [
                ['key' => 'tribunal_member', 'title' => __('messages.tribunal_members'), 'items' => $tribunalMembers],
                ['key' => 'management',      'title' => __('messages.management'),      'items' => $management],
                ['key' => 'secretariat',     'title' => app()->getLocale() == 'sw' ? 'Utawala' : 'Secretariat', 'items' => $secretariat],
            ];
        @endphp

        @foreach($groups as $group)
            @if((!$category || $category == $group['key']) && $group['items']->count() > 0)
                <h2 class="fct-primary-text mb-4 text-center" style="font-size:1.3rem;">{{ $group['title'] }}</h2>
                <div class="row g-4 justify-content-center mb-5">
                    @foreach($group['items'] as $member)
                        <article id="member-{{ $member->id }}" class="col-xl-3 col-lg-4 col-md-6 d-flex">
                            <div class="fct-team-card">
                                <a href="{{ route('team.show', $member->id) }}" class="fct-team-photo" role="img" aria-label="{{ $member->getField('name') }}" title="{{ app()->getLocale() == 'sw' ? 'Ona wasifu' : 'View biography' }}">
                                    @if($member->photo)
                                        <img src="{{ asset($member->photo) }}" alt="{{ $member->getField('name') }}" loading="lazy">
                                    @else
                                        <i class="bi bi-person-fill" aria-hidden="true"></i>
                                    @endif
                                </a>
                                <div class="fct-team-body">
                                    <h5><a href="{{ route('team.show', $member->id) }}" class="text-decoration-none" style="color:inherit;">{{ $member->getField('name') }}</a></h5>
                                    <p class="role">{{ $member->getField('title') }}</p>
                                    @if($member->getField('designation'))
                                        <p class="desig">{{ $member->getField('designation') }}</p>
                                    @endif
                                    @if($member->email)
                                        <a class="email" href="mailto:{{ $member->email }}"><i class="bi bi-envelope me-1" aria-hidden="true"></i>{{ $member->email }}</a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection
