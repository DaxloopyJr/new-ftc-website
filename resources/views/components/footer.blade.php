<footer class="footer-fct pt-5" role="contentinfo">
    <div class="container">
        <div class="row g-4 pb-4">
            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h5>{{ __('messages.quick_links') }}</h5>
                <nav aria-label="{{ __('messages.quick_links') }}">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                        <li class="mb-2"><a href="{{ route('pages.show', 'about-us') }}">{{ __('messages.about_fct') }}</a></li>
                        <li class="mb-2"><a href="{{ route('news.index') }}">{{ __('messages.news_updates') }}</a></li>
                        <li class="mb-2"><a href="{{ route('publications.index') }}">{{ __('messages.publications') }}</a></li>
                        <li class="mb-2"><a href="{{ route('info-library.index') }}">{{ __('messages.info_library') }}</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}">{{ __('messages.contact_us') }}</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Tribunal -->
            <div class="col-lg-3 col-md-6">
                <h5>{{ app()->getLocale() == 'sw' ? 'Kuhusu Tribunal' : 'The Tribunal' }}</h5>
                <nav aria-label="{{ app()->getLocale() == 'sw' ? 'Viungo vya Tribunal' : 'Tribunal Links' }}">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('pages.show', 'history') }}">{{ __('messages.history') }}</a></li>
                        <li class="mb-2"><a href="{{ route('pages.show', 'vision-mission') }}">{{ __('messages.vision_mission') }}</a></li>
                        <li class="mb-2"><a href="{{ route('pages.show', 'organisation-structure') }}">{{ __('messages.organisation_structure') }}</a></li>
                        <li class="mb-2"><a href="{{ route('team.index') }}">{{ __('messages.tribunal_members') }}</a></li>
                        <li class="mb-2"><a href="{{ route('pages.show', 'how-to-appeal') }}">{{ __('messages.how_to_appeal') }}</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Important Links -->
            <div class="col-lg-3 col-md-6">
                <h5>{{ __('messages.important_links') }}</h5>
                <nav aria-label="{{ __('messages.important_links') }}">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="https://www.tanzania.go.tz" target="_blank" rel="noopener noreferrer">{{ __('messages.tanzania_government') }}</a></li>
                        <li class="mb-2"><a href="https://www.fcc.go.tz" target="_blank" rel="noopener noreferrer">{{ __('messages.fair_competition_commission') }}</a></li>
                        <li class="mb-2"><a href="https://www.judiciary.go.tz" target="_blank" rel="noopener noreferrer">{{ __('messages.the_judiciary') }}</a></li>
                        <li class="mb-2"><a href="https://www.mof.go.tz" target="_blank" rel="noopener noreferrer">{{ __('messages.ministry_finance') }}</a></li>
                        <li class="mb-2"><a href="https://www.tic.go.tz" target="_blank" rel="noopener noreferrer">{{ __('messages.tanzania_investment_centre') }}</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Contact Us -->
            <div class="col-lg-3 col-md-6">
                <h5>{{ __('messages.contact_us') }}</h5>
                <address class="mb-0">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2" aria-hidden="true"></i> {{ $siteSettings['contact_address'] ?? (app()->getLocale() == 'sw' ? 'Dar es Salaam, Tanzania' : 'Dar es Salaam, Tanzania') }}</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2" aria-hidden="true"></i> {{ $siteSettings['contact_phone'] ?? '' }}</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2" aria-hidden="true"></i> <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@fct.go.tz' }}">{{ $siteSettings['contact_email'] ?? 'info@fct.go.tz' }}</a></li>
                        <li class="mb-2"><i class="bi bi-clock me-2" aria-hidden="true"></i> {{ $siteSettings['office_hours'] ?? (app()->getLocale() == 'sw' ? 'Jumatatu-Ijumaa: 8AM - 4:30PM' : 'Mon-Fri: 8AM - 4:30PM') }}</li>
                    </ul>
                </address>
                <div class="d-flex gap-3 mt-3" role="group" aria-label="{{ __('messages.follow_us') }}">
                    <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-white fs-5" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                    <a href="{{ $siteSettings['social_twitter'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-white fs-5" aria-label="Twitter"><i class="bi bi-twitter-x" aria-hidden="true"></i></a>
                    <a href="{{ $siteSettings['social_youtube'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-white fs-5" aria-label="YouTube"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                    <a href="{{ $siteSettings['social_instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-white fs-5" aria-label="Instagram"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>&copy; {{ date('Y') }} {{ $siteSettings['footer_copyright'] ?? (app()->getLocale() == 'sw' ? 'Tribunal ya Ushindani wa Haki. Haki Zote Zimehifadhiwa.' : 'Fair Competition Tribunal. All Rights Reserved.') }}</span>
                <nav aria-label="{{ app()->getLocale() == 'sw' ? 'Kiungo cha chini' : 'Footer Links' }}">
                    <div class="d-flex gap-3">
                        <a href="{{ route('pages.show', 'privacy-policy') }}">{{ __('messages.privacy_policy') }}</a>
                        <a href="{{ route('pages.show', 'terms-of-use') }}">{{ __('messages.terms_of_use') }}</a>
                        <a href="#">{{ __('messages.accessibility') }}</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</footer>
