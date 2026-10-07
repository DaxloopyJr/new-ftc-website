<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamMemberController extends Controller
{
    public function show($id)
    {
        $member = TeamMember::active()->findOrFail($id);
        return view('frontend.team.show', compact('member'));
    }

    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = TeamMember::active();
        if ($category) { $query->where('category', $category); }
        $members = $query->get();
        return view('frontend.team.index', compact('members', 'category'));
    }
}