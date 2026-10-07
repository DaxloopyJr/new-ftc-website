@extends('layouts.frontend')

@section('title', $member->getField('name') . ' | ' . __('messages.meet_team'))

@section('content')
<section class="breadcrumb-fct">
    <div class="container py-4">
        <h1>{{ $member->getField('name') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('team.index') }}">{{ __('messages.meet_team') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $member->getField('name') }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-4 col-md-5">
                <div class="fct-team-card">
                    <div class="fct-team-photo" style="height:320px;">
                        @if($member->photo)
                            <img src="{{ asset($member->photo) }}" alt="{{ $member->getField('name') }}">
                        @else
                            <i class="bi bi-person-fill" aria-hidden="true"></i>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="content-card p-4">
                    <h3 class="fct-primary-text mb-1">{{ $member->getField('name') }}</h3>
                    <p class="fw-semibold mb-1" style="color: var(--fct-primary, #1B5E20);">{{ $member->getField('title') }}</p>
                    @if($member->getField('designation'))
                        <p class="text-muted mb-3">{{ $member->getField('designation') }}</p>
                    @endif
                    @if($member->email)
                        <p class="mb-3"><a href="mailto:{{ $member->email }}"><i class="bi bi-envelope me-1"></i>{{ $member->email }}</a></p>
                    @endif
                    <hr>
                    <h5 class="mb-2">{{ app()->getLocale() == 'sw' ? 'Wasifu' : 'Biography' }}</h5>
                    <div style="line-height:1.8;">{!! nl2br(e($member->getField('bio'))) !!}</div>
                    <a href="{{ route('team.index') }}" class="btn btn-outline-primary mt-3">
                        <i class="bi bi-arrow-left me-1"></i>{{ app()->getLocale() == 'sw' ? 'Rudi kwa Timu' : 'Back to Team' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
