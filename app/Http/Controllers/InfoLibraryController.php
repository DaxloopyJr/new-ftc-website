<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\InfoLibrary;

class InfoLibraryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $q      = trim((string) $request->get('q', ''));
        $type   = $request->get('type');
        $status = $request->get('status');
        $year   = $request->get('year');

        $query = InfoLibrary::published()->latest();
        if ($category) {
            $query->where('category', $category);
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

        $items = $query->paginate(10)->appends($request->query());
        $years = InfoLibrary::published()
            ->selectRaw('DISTINCT EXTRACT(YEAR FROM COALESCE(decision_date, registration_date, created_at)) AS y')
            ->orderByDesc('y')->pluck('y')->filter()->values();
        $filters = ['q' => $q, 'type' => $type, 'status' => $status, 'year' => $year];

        if ($request->get('ajax')) {
            return response()->json([
                'html' => view('frontend.partials.doclist', [
                    'listItems' => $items, 'listKind' => 'info',
                ])->render(),
            ]);
        }

        return view('frontend.info-library.index', compact('items', 'category', 'years', 'filters'));
    }

    public function show($slug)
    {
        $item = InfoLibrary::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('frontend.info-library.show', compact('item'));
    }

    public function download($slug)
    {
        $item = InfoLibrary::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $item->increment('download_count');
        $path = public_path($item->file_path);
        if (file_exists($path)) {
            return response()->download($path, $item->slug . '.' . pathinfo($path, PATHINFO_EXTENSION));
        }
        return redirect()->back()->with('error', 'File not found.');
    }
}