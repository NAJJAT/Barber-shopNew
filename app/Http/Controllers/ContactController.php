<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormEmail;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.emails.contact');
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Save the data to the database
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Send an email to the admin
        Mail::to('ammarnajjar00@gmail.com')->send(new ContactFormEmail($contact));

        // Redirect back with success message
        return redirect()->back('user.emails.contact')->with('success', 'Your message has been sent successfully!');
    }

}
