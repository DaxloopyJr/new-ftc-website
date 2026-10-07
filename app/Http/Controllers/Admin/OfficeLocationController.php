<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeLocation;
use Illuminate\Http\Request;

class OfficeLocationController extends Controller
{
    public function index()
    {
        $locations = OfficeLocation::orderBy('sort_order')->orderBy('id')->paginate(15);
        return view('admin.office-locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.office-locations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        OfficeLocation::create($data);
        return redirect()->route('admin.office-locations.index')->with('success', 'Office location added.');
    }

    public function edit($id)
    {
        $location = OfficeLocation::findOrFail($id);
        return view('admin.office-locations.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $location = OfficeLocation::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $location->update($data);
        return redirect()->route('admin.office-locations.index')->with('success', 'Office location updated.');
    }

    public function destroy($id)
    {
        OfficeLocation::findOrFail($id)->delete();
        return redirect()->route('admin.office-locations.index')->with('success', 'Office location deleted.');
    }
}
