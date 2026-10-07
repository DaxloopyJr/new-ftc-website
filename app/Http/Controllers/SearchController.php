<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use App\Models\Page;
use App\Models\Publication;
use App\Models\InfoLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $results = new Collection();

        if (mb_strlen($q) >= 2) {
            $like = '%' . mb_strtolower($q) . '%';

            $news = NewsEvent::where('is_published', true)
                ->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(title) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(title_sw) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(excerpt) LIKE ?', [$like]);
                })
                ->latest()->limit(20)->get()
                ->map(fn ($i) => [
                    'title' => $i->getField('title'),
                    'type'  => app()->getLocale() == 'sw' ? 'Habari' : 'News',
                    'url'   => route('news.show', $i->slug),
                    'meta'  => optional($i->created_at)->format('d M Y'),
                ]);

            $pubs = Publication::where('is_published', true)
                ->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(title) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(title_sw) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(description) LIKE ?', [$like]);
                })
                ->latest()->limit(20)->get()
                ->map(fn ($i) => [
                    'title' => $i->getField('title'),
                    'type'  => app()->getLocale() == 'sw' ? 'Machapisho' : 'Publication',
                    'url'   => route('publications.show', $i->slug),
                    'meta'  => '',
                ]);

            $infos = InfoLibrary::where('is_published', true)
                ->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(title) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(title_sw) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(description) LIKE ?', [$like]);
                })
                ->latest()->limit(20)->get()
                ->map(fn ($i) => [
                    'title' => $i->getField('title'),
                    'type'  => app()->getLocale() == 'sw' ? 'Maktaba ya Taarifa' : 'Info Library',
                    'url'   => route('info-library.show', $i->slug),
                    'meta'  => '',
                ]);

            $pages = Page::where('is_published', true)
                ->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(title) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(title_sw) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(content) LIKE ?', [$like]);
                })
                ->limit(20)->get()
                ->map(fn ($i) => [
                    'title' => $i->getField('title'),
                    'type'  => app()->getLocale() == 'sw' ? 'Kurasa' : 'Page',
                    'url'   => route('pages.show', $i->slug),
                    'meta'  => '',
                ]);

            $results = $news->concat($pubs)->concat($infos)->concat($pages);
        }

        return view('frontend.search', compact('q', 'results'));
    }
}
