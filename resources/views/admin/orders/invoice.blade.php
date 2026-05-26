<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->invoice_number }} | MBG Wellness</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
        }
    </style>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-right mb-6 no-print">
            <button onclick="window.print()" class="bg-[#842988] hover:bg-[#6a1b9a] text-white px-5 py-2 rounded-lg text-sm font-semibold transition inline-flex items-center">
                <i class="fas fa-print mr-2"></i> Print
            </button>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-10 shadow-sm">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">INVOICE</h1>
                    <p class="text-gray-500 mt-1">#{{ $order->invoice_number }}</p>
                </div>
                <div class="text-right">
                    <div class="flex items-center justify-end space-x-2 mb-2">
                        <img src="{{ asset('assets/img/favicon.png') }}" alt="" class="h-7">
                        <span class="text-lg font-bold text-[#842988]">MIND, BODY & GOALS</span>
                    </div>
                    <p class="text-sm text-gray-500">Dodoma, Tanzania</p>
                    <p class="text-sm text-gray-500">info@mindbodygoals.com</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-10">
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Bill To</h3>
                    <p class="font-semibold text-gray-800">{{ $order->billing_name }}</p>
                    <p class="text-sm text-gray-600">{{ $order->billing_email }}</p>
                    <p class="text-sm text-gray-600">{{ $order->billing_phone }}</p>
                    <p class="text-sm text-gray-600">{{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_country }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Order Info</h3>
                    <p class="text-sm"><span class="text-gray-500">Order #:</span> <span class="font-semibold">{{ $order->order_number }}</span></p>
                    <p class="text-sm"><span class="text-gray-500">Date:</span> <span class="font-semibold">{{ $order->created_at->format('M d, Y') }}</span></p>
                    <p class="text-sm"><span class="text-gray-500">Status:</span> <span class="font-semibold capitalize">{{ $order->status }}</span></p>
                    <p class="text-sm"><span class="text-gray-500">Payment:</span> <span class="font-semibold capitalize">{{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}</span></p>
                </div>
            </div>

            <table class="w-full mb-10">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-3 text-xs font-bold text-gray-500 uppercase">Item</th>
                        <th class="text-center py-3 text-xs font-bold text-gray-500 uppercase">Qty</th>
                        <th class="text-right py-3 text-xs font-bold text-gray-500 uppercase">Price</th>
                        <th class="text-right py-3 text-xs font-bold text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr class="border-b border-gray-100">
                        <td class="py-4 text-gray-800 font-medium">{{ $item->title }}</td>
                        <td class="py-4 text-center text-gray-500">{{ $item->quantity }}</td>
                        <td class="py-4 text-right text-gray-500">{{ $order->currency }} {{ number_format($item->price, 2) }}</td>
                        <td class="py-4 text-right font-semibold text-gray-800">{{ $order->currency }} {{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end">
                <div class="w-72 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-semibold">{{ $order->currency }} {{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Shipping</span>
                        <span class="font-semibold">{{ $order->shipping > 0 ? $order->currency . ' ' . number_format($order->shipping, 2) : 'Free' }}</span>
                    </div>
                    <div class="flex justify-between font-bold border-t-2 border-gray-200 pt-2">
                        <span>Total</span>
                        <span class="text-[#842988]">{{ $order->currency }} {{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>Thank you for your business!</p>
                <p class="mt-1">For questions, contact info@mindbodygoals.com</p>
            </div>
        </div>
    </div>
</body>
</html>
