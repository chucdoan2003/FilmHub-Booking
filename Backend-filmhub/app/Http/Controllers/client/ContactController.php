<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        return view('frontend.contact.index');
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

        return redirect()->route('contact.index')->with('success', 'Message sent successfully!');
    }
}
