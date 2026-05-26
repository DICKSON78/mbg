<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::forUser(auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');
        return view('orders.show', compact('order'));
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');
        $paymentDetails = session('payment_details');
        return view('orders.confirmation', compact('order', 'paymentDetails'));
    }

    public function download(OrderItem $item)
    {
        if (!$item->digital_file) {
            abort(404);
        }

        $order = $item->order;
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        $filePath = public_path($item->digital_file);
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        $item->update(['downloaded_at' => now()]);

        return response()->download($filePath);
    }
}
