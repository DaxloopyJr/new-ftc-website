<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MediaGallery;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'photo_gallery');
        $items = MediaGallery::published()->where('category', $category)->get();
        return view('frontend.gallery', compact('items', 'category'));
    }
}