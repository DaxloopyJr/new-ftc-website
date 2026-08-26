<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsEvent;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsEvent::with('creator')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $data['featured_image'] = 'uploads/news/' . $filename;
        }
        if ($data['is_published'] ?? false) { $data['published_at'] = now(); }
        NewsEvent::create($data);
        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    public function edit($id)
    {
        $newsItem = NewsEvent::findOrFail($id);
        return view('admin.news.edit', compact('newsItem'));
    }

    public function update(UpdateNewsRequest $request, $id)
    {
        $newsItem = NewsEvent::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            if ($newsItem->featured_image && file_exists(public_path($newsItem->featured_image))) {
                @unlink(public_path($newsItem->featured_image));
            }
            $data['featured_image'] = 'uploads/news/' . $filename;
        }
        if (($data['is_published'] ?? false) && !$newsItem->published_at) { $data['published_at'] = now(); }
        $newsItem->update($data);
        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $newsItem = NewsEvent::findOrFail($id);
        if ($newsItem->featured_image && file_exists(public_path($newsItem->featured_image))) {
            @unlink(public_path($newsItem->featured_image));
        }
        $newsItem->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}