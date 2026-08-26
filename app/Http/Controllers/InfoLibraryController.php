<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\InfoLibrary;

class InfoLibraryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = InfoLibrary::published();
        if ($category) { $query->where('category', $category); }
        $items = $query->orderBy('created_at', 'desc')->paginate(12);
        return view('frontend.info-library.index', compact('items', 'category'));
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