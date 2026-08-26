<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaGallery;
use Illuminate\Support\Str;

class MediaGalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = MediaGallery::with('creator');
        if ($category) { $query->where('category', $category); }
        $media = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.gallery.index', compact('media', 'category'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:51200',
            'file_type' => 'required|in:image,video',
            'category' => 'required|in:photo_gallery,video_gallery',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $data = $request->only(['title', 'description', 'file_type', 'category', 'is_featured', 'is_published']);
        $data['created_by'] = auth()->id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            $data['file_path'] = 'uploads/gallery/' . $filename;
        }
        MediaGallery::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Media uploaded successfully.');
    }

    public function edit($id)
    {
        $mediaItem = MediaGallery::findOrFail($id);
        return view('admin.gallery.edit', compact('mediaItem'));
    }

    public function update(Request $request, $id)
    {
        $mediaItem = MediaGallery::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:51200',
            'file_type' => 'required|in:image,video',
            'category' => 'required|in:photo_gallery,video_gallery',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $data = $request->only(['title', 'description', 'file_type', 'category', 'is_featured', 'is_published']);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            if ($mediaItem->file_path && file_exists(public_path($mediaItem->file_path))) {
                @unlink(public_path($mediaItem->file_path));
            }
            $data['file_path'] = 'uploads/gallery/' . $filename;
        }
        $mediaItem->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Media updated successfully.');
    }

    public function destroy($id)
    {
        $mediaItem = MediaGallery::findOrFail($id);
        if ($mediaItem->file_path && file_exists(public_path($mediaItem->file_path))) {
            @unlink(public_path($mediaItem->file_path));
        }
        $mediaItem->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Media deleted successfully.');
    }
}