<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitorLog;
use App\Models\VisitorStatsDaily;
use Illuminate\Support\Facades\Cookie;

class TrackVisitors
{
    /**
     * Cookie name for unique visitor tracking
     */
    protected string $visitorCookieName = 'fct_visitor_id';

    /**
     * Cookie lifetime in minutes (2 years)
     */
    protected int $cookieLifetime = 60 * 24 * 365 * 2;

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip tracking for admin routes, bots, and static assets
        if ($this->shouldSkipTracking($request)) {
            return $response;
        }

        try {
            // Get or create unique visitor ID from cookie
            $visitorId = $this->getOrCreateVisitorId($request, $response);
            $ipAddress = $request->ip();
            $pageVisited = $request->path();
            $userAgent = $request->userAgent();
            $referrer = $request->header('referer');

            // Log the visit
            VisitorLog::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'page_visited' => $pageVisited,
                'referrer' => $referrer,
                'country' => null,
                'city' => null,
                'session_id' => $visitorId,
                'visited_at' => now(),
            ]);

            // Update daily stats
            $today = now()->toDateString();
            $stats = VisitorStatsDaily::firstOrCreate(
                ['date' => $today],
                ['total_visits' => 0, 'unique_visitors' => 0, 'page_views' => 0]
            );

            $stats->increment('total_visits');
            $stats->increment('page_views');

            // Check if unique visitor (by visitor cookie ID in last 24 hours)
            $recentVisit = VisitorLog::where('session_id', $visitorId)
                ->where('visited_at', '>=', now()->subDay())
                ->where('id', '!=', VisitorLog::latest()->first()->id ?? 0)
                ->exists();

            if (!$recentVisit) {
                $stats->increment('unique_visitors');
            }

        } catch (\Exception $e) {
            // Silently fail - don't affect user experience
        }

        return $response;
    }

    /**
     * Get existing visitor ID from cookie or create a new one
     */
    private function getOrCreateVisitorId(Request $request, Response $response): string
    {
        $visitorId = $request->cookie($this->visitorCookieName);

        if (!$visitorId) {
            // Generate unique visitor ID
            $visitorId = 'fct_' . uniqid() . '_' . time();

            // Set cookie on the response
            if (method_exists($response, 'withCookie')) {
                $response->withCookie(
                    cookie($this->visitorCookieName, $visitorId, $this->cookieLifetime)
                );
            }
        }

        return $visitorId;
    }

    private function shouldSkipTracking(Request $request): bool
    {
        $path = $request->path();

        // Skip admin routes
        if (str_starts_with($path, 'admin') || str_starts_with($path, 'login') || str_starts_with($path, 'register')) {
            return true;
        }

        // Skip static assets
        $skipExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'ico', 'svg', 'woff', 'woff2', 'ttf'];
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (in_array($extension, $skipExtensions)) {
            return true;
        }

        // Skip common bots
        $userAgent = $request->userAgent() ?? '';
        $bots = ['bot', 'crawler', 'spider', 'scrape', 'curl', 'wget', 'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider', 'yandexbot'];
        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return true;
            }
        }

        return false;
    }
}
