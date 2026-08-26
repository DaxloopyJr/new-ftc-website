<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Models\NewsEvent;
use App\Models\Advertisement;
use App\Models\TeamMember;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = HeroSlide::active()->get();
		$headerPages = Page::where('is_published', true)->whereNull('parent_id')->with('children')->get();
        $latestNews = NewsEvent::published()->orderBy('published_at', 'desc')->take(6)->get();
        $advertisements = Advertisement::active()->byPosition('home_middle')->get();
        $chairperson = TeamMember::active()->byCategory('tribunal_member')->where('title', 'like', '%Chairperson%')->first();
        $registrar = TeamMember::active()->byCategory('management')->where('title', 'like', '%Registrar%')->first();
		
        return view('frontend.home', compact('heroSlides', 'headerPages', 'latestNews', 'advertisements', 'chairperson', 'registrar'));
    }
	
	public function admin()
    {
        return view('auth.login');
    }
}