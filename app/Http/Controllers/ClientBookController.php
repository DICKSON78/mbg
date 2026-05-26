<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Mail;

class ClientBookController extends Controller
{
    /**
     * Display bookstore list.
     */
    public function index()
    {
        $advertisedBooks = Book::where('is_advertisement', true)
            ->where('status', 'active')
            ->get();

        $catalogBooks = Book::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('books', compact('advertisedBooks', 'catalogBooks'));
    }

    /**
     * Handle book purchase request.
     */
    public function purchase(Request $request, Book $book)
    {
        $validated = $request->validate([
            'buyer_name'     => 'required|string|max:255',
            'buyer_email'    => 'required|email|max:255',
            'buyer_phone'    => 'required|string|max:50',
            'payment_method' => 'required|in:mpesa,airtel_money,tigo_pesa,card',
        ]);

        // Create Purchase database record
        \App\Models\Purchase::create([
            'user_id'        => auth()->check() ? auth()->id() : null,
            'book_id'        => $book->id,
            'buyer_name'     => $validated['buyer_name'],
            'buyer_email'    => $validated['buyer_email'],
            'buyer_phone'    => $validated['buyer_phone'],
            'payment_method' => $validated['payment_method'],
            'price'          => $book->price,
            'currency'       => $book->currency,
            'status'         => 'pending'
        ]);

        $paymentDetails = '';
        switch ($validated['payment_method']) {
            case 'mpesa':
                $paymentDetails = 'Please send ' . $book->currency . ' ' . number_format($book->price) . ' to M-Pesa Merchant / Number: **+255 792 326 665** with reference code **MBG-' . $book->id . '**.';
                break;
            case 'airtel_money':
                $paymentDetails = 'Please send ' . $book->currency . ' ' . number_format($book->price) . ' to Airtel Money Merchant / Number: **+255 688 XXXXXX** with reference code **MBG-' . $book->id . '**.';
                break;
            case 'tigo_pesa':
                $paymentDetails = 'Please send ' . $book->currency . ' ' . number_format($book->price) . ' to Tigo Pesa Merchant / Number: **+255 713 XXXXXX** with reference code **MBG-' . $book->id . '**.';
                break;
            case 'card':
                $paymentDetails = 'Our billing agent will email a credit card checkout link to **' . $validated['buyer_email'] . '** shortly.';
                break;
        }

        // We can send an email notification to admin about the book sale
        try {
            Mail::send([], [], function ($message) use ($validated, $book) {
                $message->to('info@mindbodygoals.com')
                    ->cc('olu@mbg.qa')
                    ->subject('New Book Purchase Request: ' . $book->title)
                    ->html('
                        <h3>New Book Purchase Request</h3>
                        <p><strong>Book:</strong> ' . $book->title . ' (ID: ' . $book->id . ')</p>
                        <p><strong>Price:</strong> ' . $book->currency . ' ' . $book->price . '</p>
                        <p><strong>Buyer Name:</strong> ' . $validated['buyer_name'] . '</p>
                        <p><strong>Buyer Email:</strong> ' . $validated['buyer_email'] . '</p>
                        <p><strong>Buyer Phone:</strong> ' . $validated['buyer_phone'] . '</p>
                        <p><strong>Payment Method:</strong> ' . strtoupper(str_replace('_', ' ', $validated['payment_method'])) . '</p>
                    ');
            });
        } catch (\Exception $e) {
            // Log error silently, proceed to show confirmation
        }

        return redirect()->back()->with([
            'purchase_success' => 'Your order request for "' . $book->title . '" has been placed!',
            'payment_instructions' => $paymentDetails,
        ]);
    }
}
