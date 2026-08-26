<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Http\Requests\StoreHeroSlideRequest;
use App\Http\Requests\UpdateHeroSlideRequest;
use Illuminate\Support\Str;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::with('creator')->orderBy('sort_order')->paginate(15);
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(StoreHeroSlideRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/hero-slides'), $filename);
            $data['image_path'] = 'uploads/hero-slides/' . $filename;
        }
        HeroSlide::create($data);
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide created successfully.');
    }

    public function edit($id)
    {
        $slide = HeroSlide::findOrFail($id);
        return view('admin.hero-slides.edit', compact('slide'));
    }

    public function update(UpdateHeroSlideRequest $request, $id)
    {
        $slide = HeroSlide::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/hero-slides'), $filename);
            if ($slide->image_path && file_exists(public_path($slide->image_path))) {
                @unlink(public_path($slide->image_path));
            }
            $data['image_path'] = 'uploads/hero-slides/' . $filename;
        }
        $slide->update($data);
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy($id)
    {
        $slide = HeroSlide::findOrFail($id);
        if ($slide->image_path && file_exists(public_path($slide->image_path))) {
            @unlink(public_path($slide->image_path));
        }
        $slide->delete();
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array', 'order.*' => 'integer|exists:hero_slides,id']);
        foreach ($request->order as $index => $id) {
            HeroSlide::where('id', $id)->update(['sort_order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}