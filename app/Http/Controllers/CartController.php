<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::getItems();
        $subtotal = Cart::subtotal();
        $count = Cart::count();
        return view('cart', compact('items', 'subtotal', 'count'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'type' => 'required|in:book,appointment',
            'item_id' => 'required|integer',
            'quantity' => 'integer|min:1|max:99',
        ]);

        if ($request->type === 'book') {
            $book = Book::findOrFail($request->item_id);
            if (!$book->inStock()) {
                return back()->with('error', 'Sorry, this book is currently out of stock.');
            }
        }

        Cart::addItem($request->type, $request->item_id, $request->quantity ?? 1);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count' => Cart::count(),
                'subtotal' => Cart::subtotal(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function update(Request $request, string $key)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        Cart::updateQuantity($key, $request->quantity);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(string $key)
    {
        Cart::removeItem($key);
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        Cart::clear();
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }

    public function count()
    {
        return response()->json(['count' => Cart::count()]);
    }
}
