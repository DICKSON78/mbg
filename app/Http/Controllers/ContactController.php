<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Exception;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Send the email to the primary wellness address, CCing the alternate contact address
            Mail::to('info@mindbodygoals.com')
                ->cc('olu@mbg.qa')
                ->send(new ContactFormMail($validated));

            return back()->with('success', 'Thank you! Your message has been sent successfully.');
        } catch (Exception $e) {
            // Log the exception message if needed, e.g. Log::error($e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Message could not be sent. Please try again later.');
        }
    }
}
