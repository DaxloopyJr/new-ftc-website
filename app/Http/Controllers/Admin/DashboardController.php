<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewsEvent;
use App\Models\Publication;
use App\Models\Contact;
use App\Models\VisitorStatsDaily;
use App\Models\VisitorLog;
use App\Models\HeroSlide;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_news' => NewsEvent::count(),
            'total_publications' => Publication::count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'total_slides' => HeroSlide::count(),
            'active_slides' => HeroSlide::where('is_active', true)->count(),
        ];

        // Visitor data for last 30 days
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(29);
        $visitorData = VisitorStatsDaily::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('date')
            ->get();

        // Total unique visitors (all time)
        $totalUniqueVisitors = VisitorStatsDaily::sum('unique_visitors');
        $totalPageViews = VisitorStatsDaily::sum('page_views');
        $todayVisits = VisitorStatsDaily::where('date', Carbon::today()->toDateString())->first();

        $stats['total_unique_visitors'] = $totalUniqueVisitors;
        $stats['total_page_views'] = $totalPageViews;
        $stats['today_visits'] = $todayVisits ? $todayVisits->total_visits : 0;
        $stats['today_unique'] = $todayVisits ? $todayVisits->unique_visitors : 0;

        $chartLabels = $visitorData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray();
        $chartVisits = $visitorData->pluck('total_visits')->toArray();
        $chartUnique = $visitorData->pluck('unique_visitors')->toArray();
        $chartViews = $visitorData->pluck('page_views')->toArray();

        // Fill missing dates with zeros
        $allDates = [];
        $allVisits = [];
        $allUnique = [];
        $allViews = [];
        $dataMap = $visitorData->keyBy(fn($item) => $item->date->toDateString());

        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays(29 - $i);
            $dateStr = $date->toDateString();
            $allDates[] = $date->format('M d');
            if (isset($dataMap[$dateStr])) {
                $allVisits[] = $dataMap[$dateStr]->total_visits;
                $allUnique[] = $dataMap[$dateStr]->unique_visitors;
                $allViews[] = $dataMap[$dateStr]->page_views;
            } else {
                $allVisits[] = 0;
                $allUnique[] = 0;
                $allViews[] = 0;
            }
        }

        $recentContacts = Contact::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'allDates', 'allVisits', 'allUnique', 'allViews', 'recentContacts'));
    }
}
