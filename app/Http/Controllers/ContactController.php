<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon.');
    }
}