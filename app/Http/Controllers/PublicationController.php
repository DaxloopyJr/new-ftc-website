<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Publication;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = Publication::published();
        if ($category) { $query->where('category', $category); }
        $publications = $query->orderBy('year', 'desc')->paginate(12);
        return view('frontend.publications.index', compact('publications', 'category'));
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