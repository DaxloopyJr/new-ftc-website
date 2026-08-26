<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoLibrary;
use App\Http\Requests\StoreInfoLibraryRequest;
use App\Http\Requests\UpdateInfoLibraryRequest;
use Illuminate\Support\Str;

class InfoLibraryController extends Controller
{
    public function index()
    {
        $items = InfoLibrary::with('creator')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.info-library.index', compact('items'));
    }

    public function create()
    {
        return view('admin.info-library.create');
    }

    public function store(StoreInfoLibraryRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/info-library'), $filename);
            $data['file_path'] = 'uploads/info-library/' . $filename;
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }
        InfoLibrary::create($data);
        return redirect()->route('admin.info-library.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = InfoLibrary::findOrFail($id);
        return view('admin.info-library.edit', compact('item'));
    }

    public function update(UpdateInfoLibraryRequest $request, $id)
    {
        $item = InfoLibrary::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/info-library'), $filename);
            if ($item->file_path && file_exists(public_path($item->file_path))) {
                @unlink(public_path($item->file_path));
            }
            $data['file_path'] = 'uploads/info-library/' . $filename;
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }
        $item->update($data);
        return redirect()->route('admin.info-library.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = InfoLibrary::findOrFail($id);
        if ($item->file_path && file_exists(public_path($item->file_path))) {
            @unlink(public_path($item->file_path));
        }
        $item->delete();
        return redirect()->route('admin.info-library.index')->with('success', 'Item deleted successfully.');
    }
}