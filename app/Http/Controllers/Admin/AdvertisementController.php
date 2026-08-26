<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use Illuminate\Support\Str;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::with('creator')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.advertisements.index', compact('advertisements'));
    }

    public function create()
    {
        return view('admin.advertisements.create');
    }

    public function store(StoreAdvertisementRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/advertisements'), $filename);
            $data['image_path'] = 'uploads/advertisements/' . $filename;
        }
        Advertisement::create($data);
        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement created successfully.');
    }

    public function edit($id)
    {
        $ad = Advertisement::findOrFail($id);
        return view('admin.advertisements.edit', compact('ad'));
    }

    public function update(UpdateAdvertisementRequest $request, $id)
    {
        $ad = Advertisement::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/advertisements'), $filename);
            if ($ad->image_path && file_exists(public_path($ad->image_path))) {
                @unlink(public_path($ad->image_path));
            }
            $data['image_path'] = 'uploads/advertisements/' . $filename;
        }
        $ad->update($data);
        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement updated successfully.');
    }

    public function destroy($id)
    {
        $ad = Advertisement::findOrFail($id);
        if ($ad->image_path && file_exists(public_path($ad->image_path))) {
            @unlink(public_path($ad->image_path));
        }
        $ad->delete();
        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement deleted successfully.');
    }
}