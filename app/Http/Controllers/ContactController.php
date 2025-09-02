<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contacts.create');
    }
     public function contact()
    {
        $messages = Contact::all();
        return view('admin.contact', compact('messages'));
    }

    /**
     * Store a new contact message in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Prepare data for storage
        $data = $request->only(['name', 'email', 'subject', 'message']);

        // Add authenticated user information, if available
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $data['user_name'] = auth()->user()->name;
            $data['user_email'] = auth()->user()->email;
        }

        // Store the contact message
        Contact::create($data);

        return redirect()->route('contacts.create')->with('success', 'Votre message a été envoyé avec succès !');
    }
}