<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Notification;

class ClientBookController extends Controller
{
    public function index()
    {
        $catalogBooks = Book::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('books', compact('catalogBooks'));
    }

    public function purchase(Request $request, Book $book)
    {
        $validated = $request->validate([
            'buyer_name'    => 'required|string|max:255',
            'buyer_email'   => 'required|email|max:255',
            'country_code'  => 'required|string|max:5',
            'buyer_phone'   => 'required|string|max:50',
            'buyer_address' => 'nullable|string|max:1000',
            'buyer_notes'   => 'nullable|string|max:2000',
        ]);

        $fullPhone = $validated['country_code'] . ' ' . $validated['buyer_phone'];

        $purchase = \App\Models\Purchase::create([
            'user_id'       => auth()->check() ? auth()->id() : null,
            'book_id'       => $book->id,
            'buyer_name'    => $validated['buyer_name'],
            'buyer_email'   => $validated['buyer_email'],
            'buyer_phone'   => $fullPhone,
            'buyer_address' => $validated['buyer_address'] ?? null,
            'buyer_notes'   => $validated['buyer_notes'] ?? null,
            'payment_method' => 'manual',
            'price'         => $book->price,
            'currency'      => $book->currency,
            'status'        => 'pending',
        ]);

        Notification::notifyAdmins(
            'book_preorder',
            'New Book Pre-order: ' . $book->title,
            $validated['buyer_name'] . ' has pre-ordered "' . $book->title . '" (' . $book->currency . ' ' . number_format($book->price, 2) . '). Contact them at ' . $fullPhone . '.',
            route('admin.books')
        );

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'name'    => $validated['buyer_name'],
                'message' => 'Your pre-order for "' . $book->title . '" has been received.',
            ]);
        }

        return redirect()->back()->with([
            'preorder_success' => 'Thank you, ' . $validated['buyer_name'] . '!',
            'preorder_message' => 'Your pre-order for "<strong>' . $book->title . '</strong>" has been received. Our team will contact you at <strong>' . $fullPhone . '</strong> or <strong>' . $validated['buyer_email'] . '</strong> to arrange delivery and payment.',
        ]);
    }
}
