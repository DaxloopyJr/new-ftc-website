<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('parent')->orderBy('sort_order')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $parentPages = Page::whereNull('parent_id')->where('is_published', true)->get();
        return view('admin.pages.create', compact('parentPages'));
    }

    public function store(StorePageRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        Page::create($data);
        cache()->forget('header_pages');
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $parentPages = Page::whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('admin.pages.edit', compact('page', 'parentPages'));
    }

    public function update(UpdatePageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $page->update($data);
        cache()->forget('header_pages');
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        if ($page->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete page with child pages.');
        }
        $page->delete();
        cache()->forget('header_pages');
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}