<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageMiddleware
{
    /**
     * Supported languages
     */
    protected array $supportedLanguages = ['en', 'sw'];

    /**
     * Cookie name for language preference
     */
    protected string $cookieName = 'fct_language';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for language in URL parameter first
        $locale = $request->get('lang');

        // If not in URL, check cookie
        if (!$locale) {
            $locale = $request->cookie($this->cookieName);
        }

        // If not in cookie, use browser preference
        if (!$locale) {
            $locale = $this->getBrowserLanguage($request);
        }

        // Default to English if not supported
        if (!$locale || !in_array($locale, $this->supportedLanguages)) {
            $locale = 'en';
        }

        // Set application locale
        App::setLocale($locale);

        // Store locale in session for Blade views
        session(['locale' => $locale]);

        $response = $next($request);

        // Set cookie if not already set or different
        if ($request->cookie($this->cookieName) !== $locale) {
            $response->withCookie(cookie($this->cookieName, $locale, 60 * 24 * 365)); // 1 year
        }

        return $response;
    }

    /**
     * Get browser's preferred language
     */
    private function getBrowserLanguage(Request $request): ?string
    {
        $acceptLanguage = $request->header('Accept-Language');

        if (!$acceptLanguage) {
            return null;
        }

        // Parse Accept-Language header
        $languages = explode(',', $acceptLanguage);

        foreach ($languages as $language) {
            $lang = strtolower(substr(trim($language), 0, 2));

            if (in_array($lang, $this->supportedLanguages)) {
                return $lang;
            }
        }

        return null;
    }
}
