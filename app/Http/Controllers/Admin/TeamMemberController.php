<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = TeamMember::query();
        if ($category) { $query->where('category', $category); }
        $members = $query->orderBy('display_order')->paginate(15);
        return view('admin.team-members.index', compact('members', 'category'));
    }

    public function create()
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:tribunal_member,management,secretariat',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['name', 'title', 'designation', 'bio', 'category', 'email', 'phone', 'display_order', 'is_active']);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/team'), $filename);
            $data['photo'] = 'uploads/team/' . $filename;
        }
        TeamMember::create($data);
        return redirect()->route('admin.team-members.index')->with('success', 'Member created successfully.');
    }

    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team-members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:tribunal_member,management,secretariat',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['name', 'title', 'designation', 'bio', 'category', 'email', 'phone', 'display_order', 'is_active']);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/team'), $filename);
            if ($member->photo && file_exists(public_path($member->photo))) {
                @unlink(public_path($member->photo));
            }
            $data['photo'] = 'uploads/team/' . $filename;
        }
        $member->update($data);
        return redirect()->route('admin.team-members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);
        if ($member->photo && file_exists(public_path($member->photo))) {
            @unlink(public_path($member->photo));
        }
        $member->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Member deleted successfully.');
    }
}