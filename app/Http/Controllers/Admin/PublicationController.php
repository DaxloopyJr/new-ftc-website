<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use Illuminate\Support\Str;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::with('creator')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.publications.index', compact('publications'));
    }

    public function create()
    {
        return view('admin.publications.create');
    }

    public function store(StorePublicationRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $filename);
            $data['file_path'] = 'uploads/publications/' . $filename;
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_cover_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $filename);
            $data['cover_image'] = 'uploads/publications/' . $filename;
        }
        Publication::create($data);
        return redirect()->route('admin.publications.index')->with('success', 'Publication created successfully.');
    }

    public function edit($id)
    {
        $publication = Publication::findOrFail($id);
        return view('admin.publications.edit', compact('publication'));
    }

    public function update(UpdatePublicationRequest $request, $id)
    {
        $publication = Publication::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $filename);
            if ($publication->file_path && file_exists(public_path($publication->file_path))) {
                @unlink(public_path($publication->file_path));
            }
            $data['file_path'] = 'uploads/publications/' . $filename;
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_cover_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $filename);
            if ($publication->cover_image && file_exists(public_path($publication->cover_image))) {
                @unlink(public_path($publication->cover_image));
            }
            $data['cover_image'] = 'uploads/publications/' . $filename;
        }
        $publication->update($data);
        return redirect()->route('admin.publications.index')->with('success', 'Publication updated successfully.');
    }

    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        if ($publication->file_path && file_exists(public_path($publication->file_path))) {
            @unlink(public_path($publication->file_path));
        }
        if ($publication->cover_image && file_exists(public_path($publication->cover_image))) {
            @unlink(public_path($publication->cover_image));
        }
        $publication->delete();
        return redirect()->route('admin.publications.index')->with('success', 'Publication deleted successfully.');
    }
}