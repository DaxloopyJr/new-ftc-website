<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Publication;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $q      = trim((string) $request->get('q', ''));
        $year   = $request->get('year');

        $query = Publication::published()->latest();
        if ($category) {
            $query->where('category', $category);
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

        $publications = $query->paginate(10)->appends($request->query());
        $years = Publication::published()->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $filters = ['q' => $q, 'year' => $year];

        if ($request->get('ajax')) {
            return response()->json([
                'html' => view('frontend.partials.doclist', [
                    'listItems' => $publications, 'listKind' => 'publication',
                ])->render(),
            ]);
        }

        return view('frontend.publications.index', compact('publications', 'category', 'years', 'filters'));
    }

    public function show($slug)
    {
        $publication = Publication::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('frontend.publications.show', compact('publication'));
    }

    public function download($slug)
    {
        $publication = Publication::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $publication->increment('download_count');
        $path = public_path($publication->file_path);
        if (file_exists($path)) {
            return response()->download($path, $publication->slug . '.' . pathinfo($path, PATHINFO_EXTENSION));
        }
        return redirect()->back()->with('error', 'File not found.');
    }
}