<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Genre;
class ContactController extends Controller
{
    public function index() {
        $genres = Genre::withCount('movies')->get();
        return view('frontend.contact.index',compact('genres'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);


        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
            'user_id' => 1,
        ]);

        $genres = Genre::withCount('movies')->get();
        return redirect()->route('contact.index',compact('genres'))->with('success', 'Message sent successfully!');
    }
}
