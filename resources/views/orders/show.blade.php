@extends('layouts.client')

@section('title', 'Order Details | MBG Wellness')

@section('hero')
<section class="pt-32 pb-16 relative overflow-hidden bg-primary text-white">
    <div class="container mx-auto px-6 relative z-10">
        <div>
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-1">Order Details</span>
            <h1 class="text-4xl font-bold">Order <span class="text-gradient">#{{ $order->order_number }}</span></h1>
            <p class="text-gray-200 text-sm mt-1">View status, items, and download digital purchases</p>
        </div>
    </div>
</section>
@endsection

@section('client-content')
<section class="min-h-[500px]">
    <div class="container mx-auto px-6">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-primary hover:text-secondary font-semibold text-sm transition inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to My Orders
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-dark mb-4 flex items-center">
                        <i class="fas fa-box text-primary mr-2"></i> Order Items
                    </h3>
                    <div class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                        <div class="py-4 flex items-center justify-between">
                            <div>
                                <h4 class="font-semibold text-dark">{{ $item->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    Qty: {{ $item->quantity }} × {{ $order->currency }} {{ number_format($item->price, 2) }}
                                </p>
                                @if($item->digital_file && !$item->downloaded_at)
                                    <a href="{{ route('order.download', $item->id) }}" class="inline-flex items-center mt-2 text-xs font-semibold text-green-600 hover:text-green-800 bg-green-50 px-3 py-1.5 rounded-full transition">
                                        <i class="fas fa-download mr-1"></i> Download Now
                                    </a>
                                @elseif($item->digital_file && $item->downloaded_at)
                                    <span class="inline-flex items-center mt-2 text-xs text-gray-400">
                                        <i class="fas fa-check-circle mr-1"></i> Downloaded {{ $item->downloaded_at->format('M d, Y') }}
                                    </span>
                                @endif
                            </div>
                            <span class="font-semibold text-dark">{{ $order->currency }} {{ number_format($item->total, 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 mt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">{{ $order->currency }} {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold">{{ $order->shipping > 0 ? $order->currency . ' ' . number_format($order->shipping, 2) : 'Free' }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t border-gray-100 pt-2">
                            <span>Total</span>
                            <span class="text-primary">{{ $order->currency }} {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                @if($order->notes)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-dark mb-2 flex items-center">
                        <i class="fas fa-sticky-note text-primary mr-2"></i> Order Notes
                    </h3>
                    <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-dark mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-2"></i> Order Status
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Status</span>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                @if($order->status == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                @elseif($order->status == 'processing') bg-blue-50 text-blue-700 border border-blue-200
                                @elseif($order->status == 'completed') bg-green-50 text-green-700 border border-green-200
                                @elseif($order->status == 'cancelled') bg-red-50 text-red-700 border border-red-200
                                @else bg-gray-50 text-gray-700 border border-gray-200
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Payment</span>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                @if($order->payment_status == 'paid') bg-green-50 text-green-700 border border-green-200
                                @elseif($order->payment_status == 'failed') bg-red-50 text-red-700 border border-red-200
                                @else bg-yellow-50 text-yellow-700 border border-yellow-200
                                @endif">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Payment Method</span>
                            <span class="font-semibold text-dark capitalize">{{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}</span>
                        </div>
                        @if($order->tracking_number)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tracking</span>
                            <span class="font-semibold text-dark">{{ $order->tracking_number }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-dark mb-4 flex items-center">
                        <i class="fas fa-file-invoice text-primary mr-2"></i> Invoice
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">Invoice #{{ $order->invoice_number }}</p>
                    <p class="text-xs text-gray-400">Issued {{ $order->created_at->format('M d, Y') }}</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-dark mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-primary mr-2"></i> Shipping
                    </h3>
                    @if($order->shipping_address)
                        <p class="text-sm text-gray-600">{{ $order->shipping_name ?? $order->billing_name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                        <p class="text-sm text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_country }}</p>
                    @else
                        <p class="text-sm text-gray-400">Digital items only — no shipping needed.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
