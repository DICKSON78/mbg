<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $items = Cart::getItems();
        $subtotal = Cart::subtotal();
        $shipping = Cart::hasPhysicalItems() ? 5.00 : 0;
        $tax = round($subtotal * 0, 2);
        $total = round($subtotal + $shipping + $tax, 2);

        return view('checkout', compact('items', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $rules = [
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:50',
            'billing_address' => 'required|string',
            'billing_city' => 'required|string|max:255',
            'billing_country' => 'required|string|max:255',
            'payment_method' => 'required|in:mpesa,airtel_money,tigo_pesa,card,bank_transfer',
            'notes' => 'nullable|string|max:1000',
        ];

        if (Cart::hasPhysicalItems()) {
            $rules = array_merge($rules, [
                'shipping_name' => 'required|string|max:255',
                'shipping_address' => 'required|string',
                'shipping_city' => 'required|string|max:255',
                'shipping_country' => 'required|string|max:255',
            ]);
        }

        $validated = $request->validate($rules);

        $items = Cart::getItems();
        $subtotal = Cart::subtotal();
        $shipping = Cart::hasPhysicalItems() ? 5.00 : 0;
        $tax = round($subtotal * 0, 2);
        $total = round($subtotal + $shipping + $tax, 2);

        $currency = 'USD';
        foreach ($items as $item) {
            if (!empty($item['currency'])) {
                $currency = $item['currency'];
                break;
            }
        }

        $order = DB::transaction(function () use ($validated, $items, $subtotal, $shipping, $tax, $total, $currency) {
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'currency' => $currency,
                'billing_name' => $validated['billing_name'],
                'billing_email' => $validated['billing_email'],
                'billing_phone' => $validated['billing_phone'],
                'billing_address' => $validated['billing_address'],
                'billing_city' => $validated['billing_city'],
                'billing_country' => $validated['billing_country'],
                'shipping_name' => $validated['shipping_name'] ?? $validated['billing_name'],
                'shipping_email' => $validated['shipping_email'] ?? $validated['billing_email'],
                'shipping_phone' => $validated['shipping_phone'] ?? $validated['billing_phone'],
                'shipping_address' => $validated['shipping_address'] ?? $validated['billing_address'],
                'shipping_city' => $validated['shipping_city'] ?? $validated['billing_city'],
                'shipping_country' => $validated['shipping_country'] ?? $validated['billing_country'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'notes' => $validated['notes'] ?? null,
                'invoice_number' => Order::generateInvoiceNumber(),
            ]);

            foreach ($items as $key => $item) {
                $orderableType = $item['type'] === 'book' ? Book::class : \App\Models\Appointment::class;

                OrderItem::create([
                    'order_id' => $order->id,
                    'orderable_id' => $item['item_id'],
                    'orderable_type' => $orderableType,
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                    'digital_file' => $item['digital_file'] ?? null,
                ]);

                if ($item['type'] === 'book') {
                    $book = Book::find($item['item_id']);
                    if ($book && !$book->isDigital() && $book->stock !== null) {
                        $book->decrement('stock', $item['quantity']);
                    }
                }
            }

            Cart::clear();

            \App\Models\Notification::notifyAdmins(
                'order_placed',
                'New Order #' . $order->order_number,
                "Order total: {$order->currency} " . number_format($total, 2) . " — {$validated['billing_name']}",
                route('admin.orders')
            );

            return $order;
        });

        $paymentDetails = $this->getPaymentDetails($validated['payment_method'], $order);

        try {
            Mail::send([], [], function ($message) use ($order) {
                $message->to($order->billing_email)
                    ->subject('Order Confirmation - ' . $order->order_number)
                    ->html('
                        <h3>Thank you for your order!</h3>
                        <p><strong>Order Number:</strong> ' . $order->order_number . '</p>
                        <p><strong>Invoice:</strong> ' . $order->invoice_number . '</p>
                        <p><strong>Total:</strong> ' . $order->currency . ' ' . number_format($order->total, 2) . '</p>
                        <p><strong>Status:</strong> ' . ucfirst($order->status) . '</p>
                        <p>You can view your order details in your profile.</p>
                    ');
            });

            Mail::send([], [], function ($message) use ($order) {
                $message->to('info@mindbodygoals.com')
                    ->cc('olu@mbg.qa')
                    ->subject('New Order: ' . $order->order_number)
                    ->html('
                        <h3>New Order Received</h3>
                        <p><strong>Order:</strong> ' . $order->order_number . '</p>
                        <p><strong>Customer:</strong> ' . $order->billing_name . ' (' . $order->billing_email . ')</p>
                        <p><strong>Total:</strong> ' . $order->currency . ' ' . number_format($order->total, 2) . '</p>
                        <p><strong>Payment Method:</strong> ' . strtoupper(str_replace('_', ' ', $order->payment_method)) . '</p>
                        <p>Manage in admin: ' . route('admin.orders') . '</p>
                    ');
            });
        } catch (\Exception $e) {
        }

        return redirect()->route('order.confirmation', $order->id)
            ->with('payment_details', $paymentDetails);
    }

    private function getPaymentDetails(string $method, Order $order): string
    {
        $amount = $order->currency . ' ' . number_format($order->total, 2);
        return match ($method) {
            'mpesa' => "Send {$amount} to M-Pesa Number: +255 792 326 665 with reference {$order->order_number}.",
            'airtel_money' => "Send {$amount} to Airtel Money Number: +255 688 XXXXXX with reference {$order->order_number}.",
            'tigo_pesa' => "Send {$amount} to Tigo Pesa Number: +255 713 XXXXXX with reference {$order->order_number}.",
            'card' => "Our billing agent will email a secure payment link to {$order->billing_email} shortly.",
            'bank_transfer' => "Bank details will be sent to {$order->billing_email}.",
            default => "Please contact us to complete payment.",
        };
    }
}
