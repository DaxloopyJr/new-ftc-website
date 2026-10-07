<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Publication;
use App\Models\InfoLibrary;
use App\Models\MediaGallery;
use App\Models\NewsEvent;

class PageController extends Controller
{
    public function show(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // Submenu -> content lists (Publications / Info Library / Media Centre / News)
        $pubCats = [
            'acts-and-rules' => 'acts_and_rules',
            'strategic-plan' => 'strategic_plan',
            'client-service-charter' => 'client_service_charter',
            'annual-reports' => 'annual_report',
        ];
        $infoCats = [
            'case-digest' => 'case_digest',
            'decided-cases' => 'decided_cases',
            'registered-cases' => 'registered_cases',
            'cause-list' => 'cause_list',
            'brochures' => 'brochure',
        ];

        $q      = trim((string) $request->get('q', ''));
        $type   = $request->get('type');
        $status = $request->get('status');
        $year   = $request->get('year');

        $listItems = collect();
        $listKind  = null;
        $years     = collect();
        $showTypeFilter   = false;
        $showStatusFilter = false;

        if ($page->slug === 'publications' || isset($pubCats[$page->slug])) {
            $query = Publication::where('is_published', true)->latest();
            if (isset($pubCats[$page->slug])) {
                $query->where('category', $pubCats[$page->slug]);
            }
            if ($q !== '') {
                $like = '%' . mb_strtolower($q) . '%';
                $query->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(title) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(title_sw) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(description) LIKE ?', [$like]);
                });
            }
            if ($year) {
                $query->where('year', $year);
            }
            $listItems = $query->paginate(9)->appends($request->query());
            $listKind  = 'publication';
            $years = Publication::where('is_published', true)->whereNotNull('year')
                ->distinct()->orderBy('year', 'desc')->pluck('year');
        } elseif ($page->slug === 'info-library' || isset($infoCats[$page->slug])) {
            $query = InfoLibrary::where('is_published', true)->latest();
            if (isset($infoCats[$page->slug])) {
                $query->where('category', $infoCats[$page->slug]);
            }
            if ($q !== '') {
                $like = '%' . mb_strtolower($q) . '%';
                $query->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(title) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(title_sw) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(case_number) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(parties) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(issue) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(description) LIKE ?', [$like]);
                });
            }
            if ($type && in_array($type, ['appeal', 'application'])) {
                $query->where('case_type', $type);
            }
            if ($status) {
                $query->where('status', $status);
            }
            if ($year) {
                $query->where(function ($w) use ($year) {
                    $w->whereYear('decision_date', $year)
                      ->orWhereYear('registration_date', $year)
                      ->orWhereYear('created_at', $year);
                });
            }
            $listItems = $query->paginate(9)->appends($request->query());
            $listKind  = 'info';
            $showTypeFilter   = in_array($page->slug, ['decided-cases', 'registered-cases']);
            $showStatusFilter = $page->slug === 'registered-cases';
            $years = InfoLibrary::where('is_published', true)
                ->selectRaw('DISTINCT EXTRACT(YEAR FROM COALESCE(decision_date, registration_date, created_at)) AS y')
                ->orderByDesc('y')->pluck('y')->filter()->values();
        } elseif ($page->slug === 'photo-gallery' || $page->slug === 'video-gallery') {
            $listItems = MediaGallery::where('is_published', true)
                ->where('category', $page->slug === 'photo-gallery' ? 'photo_gallery' : 'video_gallery')
                ->latest()->paginate(12)->appends($request->query());
            $listKind = 'media';
        } elseif ($page->slug === 'news') {
            $listItems = NewsEvent::where('is_published', true)->latest()
                ->paginate(9)->appends($request->query());
            $listKind = 'news';
        }

        $recentNews = NewsEvent::published()->where('is_announcement', false)
            ->latest('published_at')->take(3)->get();
        $recentAnnouncements = NewsEvent::published()->where('is_announcement', true)
            ->latest('published_at')->take(3)->get();
        $filters = ['q' => $q, 'type' => $type, 'status' => $status, 'year' => $year];

        return view('frontend.pages.show', compact(
            'page', 'listItems', 'listKind', 'years', 'filters', 'showTypeFilter', 'showStatusFilter', 'recentNews', 'recentAnnouncements'
        ));
    }
}
