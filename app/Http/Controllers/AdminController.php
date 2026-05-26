<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Display dashboard analytics and recent items.
     */
    public function dashboard()
    {
        $stats = [
            'pending_appointments'  => Appointment::where('status', 'pending')->count(),
            'approved_appointments' => Appointment::where('status', 'approved')->count(),
            'total_books'           => Book::count(),
            'total_clients'         => Appointment::select('email')->distinct()->count(),
            'total_orders'          => \App\Models\Order::count(),
            'pending_orders'        => \App\Models\Order::where('status', 'pending')->count(),
        ];

        $recentAppointments = Appointment::orderBy('created_at', 'desc')->take(5)->get();
        $upcomingSessions = Appointment::where('status', 'approved')
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'upcomingSessions'));
    }

    /**
     * List all appointments.
     */
    public function appointments(Request $request)
    {
        $status = $request->get('status');
        $query = Appointment::orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $appointments = $query->paginate(15)->withQueryString();
        return view('admin.appointments', compact('appointments', 'status'));
    }

    /**
     * Update an appointment (status, time, date, notes).
     */
    public function updateAppointment(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status'           => 'required|in:pending,approved,declined,completed',
            'notes'            => 'nullable|string',
        ]);

        $appointment->update($validated);

        $user = \App\Models\User::where('email', $appointment->email)->first();
        if ($user) {
            $type = $validated['status'] === 'approved' ? 'appointment_approved' : ($validated['status'] === 'declined' ? 'appointment_declined' : 'appointment_status');
            $title = $type === 'appointment_approved' ? 'Appointment Approved' : ($type === 'appointment_declined' ? 'Appointment Declined' : 'Appointment Updated');
            $msg = "Your {$appointment->title} session on {$appointment->appointment_date->format('M d, Y')} has been {$validated['status']}.";
            \App\Models\Notification::createForUser($user->id, $type, $title, $msg, route('appointment.status'));
        }

        return back()->with('success', 'Appointment updated successfully.');
    }

    /**
     * Delete an appointment.
     */
    public function deleteAppointment(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Appointment deleted successfully.');
    }

    /**
     * List all books.
     */
    public function books()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Store a newly uploaded book.
     */
    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'currency'         => 'required|string|max:10',
            'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'purchase_url'     => 'nullable|url',
            'is_advertisement' => 'nullable|boolean',
            'status'           => 'required|in:active,inactive',
        ]);

        $validated['is_advertisement'] = $request->has('is_advertisement');

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Move file directly to public directory to avoid storage link issues
            $file->move(public_path('assets/img/books'), $fileName);
            $validated['cover_image'] = 'assets/img/books/' . $fileName;
        }

        Book::create($validated);

        return back()->with('success', 'Book uploaded successfully.');
    }

    /**
     * Update book details.
     */
    public function updateBook(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'currency'         => 'required|string|max:10',
            'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'purchase_url'     => 'nullable|url',
            'is_advertisement' => 'nullable|boolean',
            'status'           => 'required|in:active,inactive',
        ]);

        $validated['is_advertisement'] = $request->has('is_advertisement');

        if ($request->hasFile('cover_image')) {
            // Delete old file if exists
            if ($book->cover_image && file_exists(public_path($book->cover_image))) {
                @unlink(public_path($book->cover_image));
            }

            $file = $request->file('cover_image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/books'), $fileName);
            $validated['cover_image'] = 'assets/img/books/' . $fileName;
        }

        $book->update($validated);

        return back()->with('success', 'Book updated successfully.');
    }

    /**
     * Delete a book from catalog.
     */
    public function deleteBook(Book $book)
    {
        if ($book->cover_image && file_exists(public_path($book->cover_image))) {
            @unlink(public_path($book->cover_image));
        }

        $book->delete();

        return back()->with('success', 'Book deleted successfully.');
    }

    /**
     * List all distinct clients and their history.
     */
    public function clients(Request $request)
    {
        // Get unique clients by email, and aggregate their total appointments and latest appointment details
        $clients = Appointment::select('email', 'name', 'phone')
            ->selectRaw('count(id) as total_appointments')
            ->selectRaw('max(appointment_date) as last_appointment_date')
            ->groupBy('email', 'name', 'phone')
            ->orderBy('last_appointment_date', 'desc')
            ->paginate(15);

        return view('admin.clients', compact('clients'));
    }

    /**
     * View history details of a specific client by email.
     */
    public function clientDetails($email)
    {
        $clientInfo = Appointment::where('email', $email)->first();
        if (!$clientInfo) {
            abort(404);
        }

        $history = Appointment::where('email', $email)
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        $purchases = \App\Models\Purchase::with('book')
            ->where('buyer_email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.client-details', compact('clientInfo', 'history', 'purchases'));
    }

    /**
     * Update a client's book purchase status.
     */
    public function updatePurchaseStatus(Request $request, \App\Models\Purchase $purchase)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        $purchase->update($validated);

        return back()->with('success', 'Book order status updated successfully.');
    }
}
