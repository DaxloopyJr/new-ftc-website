<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        foreach ($request->validated()['settings'] as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
        cache()->forget('site_settings');
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}