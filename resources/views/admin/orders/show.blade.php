@extends('layouts.admin')

@section('title', 'Order #'.$order->order_number.' | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <h1 class="text-3xl font-bold text-white">Order #{{ $order->order_number }}</h1>
            <p class="text-white/70 text-sm mt-1">Manage fulfillment and payment.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="mb-5">
        <a href="{{ route('admin.orders') }}" class="btn btn-ghost btn-sm inline-flex items-center gap-1.5"><i class="fas fa-arrow-left text-xs"></i> Back to Orders</a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-4"><i class="fas fa-box" style="color: var(--primary);"></i> Order Items</h3>
                <div class="divide-y divide-purple-50">
                    @foreach($order->items as $item)
                    <div class="py-3 flex items-center justify-between">
                        <div><p class="font-medium text-gray-900 text-sm">{{ $item->title }}</p><p class="text-xs text-gray-400 mt-0.5">Qty: {{ $item->quantity }} × {{ $order->currency }} {{ number_format($item->price, 2) }}</p></div>
                        <span class="font-semibold text-gray-900 text-sm">{{ $order->currency }} {{ number_format($item->total, 2) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-purple-100 pt-3 mt-2 space-y-1">
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Subtotal</span><span class="font-semibold">{{ $order->currency }} {{ number_format($order->subtotal, 2) }}</span></div>
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Shipping</span><span class="font-semibold">{{ $order->shipping > 0 ? $order->currency . ' ' . number_format($order->shipping, 2) : 'Free' }}</span></div>
                    <div class="flex justify-between font-bold border-t border-purple-100 pt-2"><span>Total</span><span style="color: var(--primary);">{{ $order->currency }} {{ number_format($order->total, 2) }}</span></div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-4"><i class="fas fa-truck" style="color: var(--primary);"></i> Fulfillment</h3>
                <form method="POST" action="{{ route('admin.order.update', $order->id) }}" class="space-y-4">@csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="input-label">Status</label>
                            <select name="status" class="input">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <div><label class="input-label">Tracking #</label><input type="text" name="tracking_number" value="{{ $order->tracking_number }}" class="input" placeholder="Optional"></div>
                    </div>
                    <div><label class="input-label">Notes</label><textarea name="notes" rows="2" class="input">{{ $order->notes }}</textarea></div>
                    <div class="flex justify-end"><button type="submit" class="btn btn-primary">Update</button></div>
                </form>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-credit-card" style="color: var(--primary);"></i> Payment</h3>
                <div class="space-y-2 text-sm mb-3">
                    <div class="flex justify-between"><span class="text-gray-500">Method</span><span class="font-medium capitalize">{{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-500">Status</span>
                        <span class="badge {{ $order->payment_status == 'paid' ? 'bg-green-50 text-green-700 border-green-200' : ($order->payment_status == 'failed' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-amber-50 text-amber-700 border-amber-200') }}">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                    <div class="flex justify-between"><span class="text-gray-500">Invoice</span><span class="font-medium">{{ $order->invoice_number }}</span></div>
                </div>
                <form method="POST" action="{{ route('admin.order.payment', $order->id) }}" class="flex gap-2">@csrf @method('PUT')
                    <select name="payment_status" class="input text-xs px-2 py-1">
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-user" style="color: var(--primary);"></i> Customer</h3>
                <div class="space-y-1.5 text-sm"><p><span class="text-gray-500">Name:</span> <span class="font-medium text-gray-900">{{ $order->billing_name }}</span></p><p><span class="text-gray-500">Email:</span> <span class="font-medium text-gray-900">{{ $order->billing_email }}</span></p><p><span class="text-gray-500">Phone:</span> <span class="font-medium text-gray-900">{{ $order->billing_phone }}</span></p></div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> Shipping</h3>
                @if($order->shipping_address)
                    <div class="text-sm text-gray-600 space-y-1"><p>{{ $order->shipping_name }}</p><p>{{ $order->shipping_address }}</p><p>{{ $order->shipping_city }}, {{ $order->shipping_country }}</p></div>
                @else
                    <p class="text-sm text-gray-400">Digital only — no shipping.</p>
                @endif
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-file-invoice" style="color: var(--primary);"></i> Invoice</h3>
                <a href="{{ route('admin.order.invoice', $order->id) }}" target="_blank" class="text-sm font-medium inline-flex items-center gap-1.5" style="color: var(--primary);"><i class="fas fa-external-link-alt text-xs"></i> View Invoice</a>
            </div>
        </div>
    </div>
@endsection
