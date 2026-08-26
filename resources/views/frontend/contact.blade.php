@extends('layouts.frontend')

@section('title', __('messages.contact_title') . ' | Fair Competition Tribunal')
@section('meta_description', __('messages.meta_contact'))
@section('meta_keywords', 'contact Fair Competition Tribunal, FCT Tanzania, inquiries, appeals, Dar es Salaam')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "{{ __('messages.contact_title') }} - Fair Competition Tribunal",
    "description": "{{ __('messages.meta_contact') }}",
    "url": "{{ route('contact') }}",
    "mainEntity": {
        "@type": "GovernmentOrganization",
        "name": "Fair Competition Tribunal - Tanzania",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "TZ",
            "addressLocality": "{{ $siteSettings['contact_address'] ?? 'Dar es Salaam' }}"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $siteSettings['contact_phone'] ?? '' }}",
            "contactType": "customer service",
            "availableLanguage": ["English", "Swahili"]
        }
    }
}
</script>
@endsection

@section('content')
<!-- Page Header -->
<section class="breadcrumb-fct" aria-label="{{ app()->getLocale() == 'sw' ? 'Kichwa cha Ukurasa' : 'Page Header' }}">
    <div class="container py-4">
        <h1>{{ __('messages.contact_title') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.contact_title') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-5" aria-label="{{ app()->getLocale() == 'sw' ? 'Fomu ya Mawasiliano' : 'Contact Form' }}">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <article class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="fct-primary-text mb-4">{{ __('messages.send_message') }}</h3>
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('contact.store') }}" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">{{ __('messages.full_name') }} *</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}" autocomplete="name">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('messages.email_address') }} *</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" autocomplete="email">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('messages.phone_number') }}</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" autocomplete="tel">
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">{{ __('messages.subject') }} *</label>
                                    <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" required value="{{ old('subject') }}">
                                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">{{ __('messages.message') }} *</label>
                                    <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-fct-primary px-4">{{ __('messages.send_btn') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
            <div class="col-lg-5">
                <aside aria-label="{{ __('messages.contact_info') }}">
                    <div class="card border-0 shadow-sm mb-4" style="background:linear-gradient(135deg, var(--fct-primary) 0%, var(--fct-primary-dark) 100%);">
                        <div class="card-body text-white p-4">
                            <h4 class="mb-4">{{ __('messages.contact_info') }}</h4>
                            <address class="mb-0">
                                <div class="d-flex mb-3">
                                    <i class="bi bi-geo-alt fs-5 me-3 mt-1" aria-hidden="true"></i>
                                    <div>{{ $siteSettings['contact_address'] ?? (app()->getLocale() == 'sw' ? 'Dar es Salaam, Tanzania' : 'Dar es Salaam, Tanzania') }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <i class="bi bi-telephone fs-5 me-3 mt-1" aria-hidden="true"></i>
                                    <div><a href="tel:{{ $siteSettings['contact_phone'] ?? '' }}" class="text-white text-decoration-none">{{ $siteSettings['contact_phone'] ?? '' }}</a></div>
                                </div>
                                <div class="d-flex mb-3">
                                    <i class="bi bi-envelope fs-5 me-3 mt-1" aria-hidden="true"></i>
                                    <div><a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@fct.go.tz' }}" class="text-white text-decoration-none">{{ $siteSettings['contact_email'] ?? 'info@fct.go.tz' }}</a></div>
                                </div>
                                <div class="d-flex">
                                    <i class="bi bi-clock fs-5 me-3 mt-1" aria-hidden="true"></i>
                                    <div>{{ $siteSettings['office_hours'] ?? (app()->getLocale() == 'sw' ? 'Jumatatu-Ijumaa: 8AM - 4:30PM' : 'Mon-Fri: 8AM - 4:30PM') }}</div>
                                </div>
                            </address>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <h5 class="mb-3">{{ __('messages.follow_us') }}</h5>
                            <div class="d-flex justify-content-center gap-3" role="group" aria-label="{{ __('messages.follow_us') }}">
                                <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary rounded-circle" style="width:45px;height:45px;" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                                <a href="{{ $siteSettings['social_twitter'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-info rounded-circle" style="width:45px;height:45px;" aria-label="Twitter"><i class="bi bi-twitter-x" aria-hidden="true"></i></a>
                                <a href="{{ $siteSettings['social_youtube'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger rounded-circle" style="width:45px;height:45px;" aria-label="YouTube"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                                <a href="{{ $siteSettings['social_instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-warning rounded-circle" style="width:45px;height:45px;" aria-label="Instagram"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection
