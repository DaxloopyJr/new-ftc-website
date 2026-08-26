<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisitorStatsDaily;
use App\Models\VisitorLog;
use App\Models\Publication;
use App\Models\InfoLibrary;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function visitors(Request $request)
    {
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days - 1);
        $endDate = Carbon::now();

        $stats = VisitorStatsDaily::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('date')
            ->get();

        $labels = [];
        $visits = [];
        $unique = [];
        $dataMap = $stats->keyBy(fn($item) => $item->date->toDateString());

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($days - 1 - $i);
            $labels[] = $date->format('M d');
            $d = $dataMap[$date->toDateString()] ?? null;
            $visits[] = $d ? $d->total_visits : 0;
            $unique[] = $d ? $d->unique_visitors : 0;
        }

        $totalStats = [
            'total_visits' => $stats->sum('total_visits'),
            'total_unique' => $stats->sum('unique_visitors'),
            'total_views' => $stats->sum('page_views'),
            'avg_daily' => $days > 0 ? round($stats->sum('total_visits') / $days, 1) : 0,
        ];

        return view('admin.reports.visitors', compact('labels', 'visits', 'unique', 'totalStats', 'days'));
    }

    public function downloads(Request $request)
    {
        $publications = Publication::orderBy('download_count', 'desc')->take(20)->get();
        $infoLibrary = InfoLibrary::orderBy('download_count', 'desc')->take(20)->get();
        return view('admin.reports.downloads', compact('publications', 'infoLibrary'));
    }

    public function pageViews(Request $request)
    {
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days);

        $pageViews = VisitorLog::where('visited_at', '>=', $startDate)
            ->selectRaw('page_visited, COUNT(*) as views')
            ->groupBy('page_visited')
            ->orderByDesc('views')
            ->take(20)
            ->get();

        return view('admin.reports.page-views', compact('pageViews', 'days'));
    }
}