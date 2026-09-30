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
        <nav class="d-flex flex-wrap gap-2 mb-4 justify-content-center" aria-label="{{ app()->getLocale() == 'sw' ? 'Kategoria za Timu' : 'Team Categories' }}">
            <a href="{{ route('team.index') }}" class="btn btn-sm {{ !$category ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Wote' : 'All' }}</a>
            <a href="{{ route('team.index', ['category' => 'tribunal_member']) }}" class="btn btn-sm {{ $category == 'tribunal_member' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.tribunal_members') }}</a>
            <a href="{{ route('team.index', ['category' => 'management']) }}" class="btn btn-sm {{ $category == 'management' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ __('messages.management') }}</a>
            <a href="{{ route('team.index', ['category' => 'secretariat']) }}" class="btn btn-sm {{ $category == 'secretariat' ? 'btn-fct-primary' : 'btn-outline-primary' }}">{{ app()->getLocale() == 'sw' ? 'Utawala' : 'Secretariat' }}</a>
        </nav>

        @php
            $tribunalMembers = $members->where('category', 'tribunal_member');
            $management = $members->where('category', 'management');
            $secretariat = $members->where('category', 'secretariat');
        @endphp

        <!-- Tribunal Members -->
        @if(!$category || $category == 'tribunal_member')
            @if($tribunalMembers->count() > 0)
                <h2 class="fct-primary-text mb-4 text-center" style="font-size:1.3rem;">{{ __('messages.tribunal_members') }}</h2>
                <div class="row g-4 justify-content-center mb-5">
                    @foreach($tribunalMembers as $member)
                        <article class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm text-center">
                                <div class="card-body p-4">
                                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:100px;height:100px;background:linear-gradient(135deg,var(--fct-primary),var(--fct-primary-dark));" role="img" aria-label="{{ $member->getField('name') }}">
                                        @if($member->photo)
                                            <img src="{{ asset($member->photo) }}" alt="{{ $member->getField('name') }}" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;" loading="lazy">
                                        @else
                                            <i class="bi bi-person-fill text-white fs-1" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <h5 class="mb-1">{{ $member->getField('name') }}</h5>
                                    <p class="fct-primary-text mb-2" style="font-size:0.875rem;font-weight:500;">{{ $member->getField('title') }}</p>
                                    <p class="text-muted" style="font-size:0.8rem;">{{ $member->getField('designation') }}</p>
                                    @if($member->email)<small class="text-muted d-block"><i class="bi bi-envelope me-1" aria-hidden="true"></i><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></small>@endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- Management -->
        @if(!$category || $category == 'management')
            @if($management->count() > 0)
                <h2 class="fct-primary-text mb-4 text-center" style="font-size:1.3rem;">{{ __('messages.management') }}</h2>
                <div class="row g-4 justify-content-center mb-5">
                    @foreach($management as $member)
                        <article class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm text-center">
                                <div class="card-body p-4">
                                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:100px;height:100px;background:linear-gradient(135deg,var(--fct-primary),var(--fct-primary-dark));" role="img" aria-label="{{ $member->getField('name') }}">
                                        @if($member->photo)
                                            <img src="{{ asset($member->photo) }}" alt="{{ $member->getField('name') }}" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;" loading="lazy">
                                        @else
                                            <i class="bi bi-person-fill text-white fs-1" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <h5 class="mb-1">{{ $member->getField('name') }}</h5>
                                    <p class="fct-primary-text mb-2" style="font-size:0.875rem;font-weight:500;">{{ $member->getField('title') }}</p>
                                    <p class="text-muted" style="font-size:0.8rem;">{{ $member->getField('designation') }}</p>
                                    @if($member->email)<small class="text-muted d-block"><i class="bi bi-envelope me-1" aria-hidden="true"></i><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></small>@endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- Secretariat -->
        @if(!$category || $category == 'secretariat')
            @if($secretariat->count() > 0)
                <h2 class="fct-primary-text mb-4 text-center" style="font-size:1.3rem;">{{ app()->getLocale() == 'sw' ? 'Utawala' : 'Secretariat' }}</h2>
                <div class="row g-4 justify-content-center">
                    @foreach($secretariat as $member)
                        <article class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm text-center">
                                <div class="card-body p-4">
                                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:100px;height:100px;background:linear-gradient(135deg,var(--fct-primary),var(--fct-primary-dark));" role="img" aria-label="{{ $member->getField('name') }}">
                                        @if($member->photo)
                                            <img src="{{ asset($member->photo) }}" alt="{{ $member->getField('name') }}" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;" loading="lazy">
                                        @else
                                            <i class="bi bi-person-fill text-white fs-1" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <h5 class="mb-1">{{ $member->getField('name') }}</h5>
                                    <p class="fct-primary-text mb-2" style="font-size:0.875rem;font-weight:500;">{{ $member->getField('title') }}</p>
                                    <p class="text-muted" style="font-size:0.8rem;">{{ $member->getField('designation') }}</p>
                                    @if($member->email)<small class="text-muted d-block"><i class="bi bi-envelope me-1" aria-hidden="true"></i><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></small>@endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
