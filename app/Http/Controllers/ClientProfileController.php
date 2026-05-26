<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
    /**
     * Display client profile, including purchases, schedule, and clinician notes.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Fetch all appointments for the logged-in client by email
        $appointments = Appointment::where('email', $user->email)
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        // Fetch all books purchased by the logged-in client
        return view('profile', compact('user', 'appointments'));
    }

    public function myBooks()
    {
        $user = auth()->user();

        $purchases = Purchase::with('book')
            ->where('user_id', $user->id)
            ->orWhere('buyer_email', $user->email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-books', compact('purchases'));
    }
}
