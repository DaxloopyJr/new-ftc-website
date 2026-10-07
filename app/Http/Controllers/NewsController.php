<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NewsEvent;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = NewsEvent::published()->orderBy('published_at', 'desc')->paginate(12);
        return view('frontend.news.index', compact('news'));
    }

    public function announcements()
    {
        $newsItems = NewsEvent::published()->where('is_announcement', true)
            ->latest('published_at')->paginate(9);
        return view('frontend.news.index', ['newsItems' => $newsItems, 'title' => app()->getLocale() == 'sw' ? 'Matangazo' : 'Announcements']);
    }

    public function show($slug)
    {
        $newsItem = NewsEvent::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $newsItem->increment('view_count');
        $relatedNews = NewsEvent::published()
            ->where('id', '!=', $newsItem->id)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();
        return view('frontend.news.show', compact('newsItem', 'relatedNews'));
    }
}