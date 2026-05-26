@extends('layouts.app')

@section('title', 'Order Confirmed | MBG Wellness')

@section('content')
<section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden" style="background: linear-gradient(135deg, #0d5520 0%, #1a7a33 100%);">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_40%,rgba(255,255,255,0.08)_0%,transparent_60%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_70%,rgba(0,0,0,0.1)_0%,transparent_50%)]"></div>
    <div class="absolute inset-0" style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center">
            <div class="w-20 h-20 bg-white/15 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl ring-4 ring-white/10">
                <i class="fas fa-check text-white text-3xl drop-shadow-lg"></i>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight drop-shadow-lg">Order <span class="bg-gradient-to-r from-[#fcd91b] to-[#ffeb3b] bg-clip-text text-transparent">Confirmed!</span></h1>
            <p class="text-xl text-white/80 max-w-xl mx-auto font-light">Thank you for your purchase, {{ $order->billing_name }}. You'll receive a confirmation shortly.</p>
            <div class="mt-6 inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-5 py-2 text-white/70 text-sm">
                <i class="fas fa-receipt"></i>
                Order #{{ $order->order_number }}
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-b from-gray-50 to-white min-h-[400px]">
    <div class="container mx-auto px-6">
        @if(session('payment_details'))
        <div class="max-w-2xl mx-auto mb-8 bg-gradient-to-br from-amber-50 to-yellow-50/50 border border-amber-200/60 p-6 rounded-2xl shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fas fa-info-circle text-amber-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-amber-800 text-base mb-1.5">Payment Instructions</h3>
                    <p class="text-sm text-amber-700 whitespace-pre-line leading-relaxed">{{ session('payment_details') }}</p>
                    <div class="mt-4 flex items-center gap-2 text-xs text-amber-600 bg-amber-100/50 px-3 py-2 rounded-lg">
                        <i class="fas fa-clock"></i>
                        <span>Please complete payment to process your order. An invoice has been sent to <strong>{{ $order->billing_email }}</strong>.</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] border border-gray-100/80 overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-[#6a1b9a] px-6 py-5">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="font-bold text-lg text-white flex items-center gap-2">
                                <i class="fas fa-check-circle text-yellow-300"></i> Order #{{ $order->order_number }}
                            </h2>
                            <p class="text-sm text-white/70 mt-0.5">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <span class="px-3.5 py-1.5 bg-yellow-400/90 text-dark text-xs font-bold rounded-full flex items-center gap-1.5 shadow-lg">
                            <i class="fas fa-hourglass-half text-[10px]"></i> Pending
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-1">
                        @foreach($order->items as $item)
                        <div class="flex justify-between items-center py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary/5 to-primary/10 flex items-center justify-center shrink-0">
                                    <i class="fas {{ $item->orderable_type === 'App\\Models\\Book' ? 'fa-book' : 'fa-calendar-check' }} text-primary/50 text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark text-sm">{{ $item->title }}</h4>
                                    <p class="text-xs text-gray-400">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <span class="font-semibold text-dark text-sm">{{ $order->currency }} {{ number_format($item->total, 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100/80 pt-4 mt-4 space-y-2.5">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="font-semibold text-dark">{{ $order->currency }} {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Shipping</span>
                            <span class="font-semibold text-dark">{{ $order->shipping > 0 ? $order->currency . ' ' . number_format($order->shipping, 2) : 'Free' }}</span>
                        </div>
                        <div class="border-t border-gray-100/80 pt-3 flex justify-between items-baseline">
                            <span class="font-bold text-dark text-base">Total</span>
                            <span class="font-bold text-2xl" style="color: #842988;">{{ $order->currency }} {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/80 px-6 py-5 border-t border-gray-100/80">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <h4 class="font-bold text-dark text-xs uppercase tracking-wider mb-3 flex items-center gap-2">
                                <i class="fas fa-user text-primary/50"></i> Billing
                            </h4>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p class="font-medium text-dark">{{ $order->billing_name }}</p>
                                <p>{{ $order->billing_email }}</p>
                                <p>{{ $order->billing_phone }}</p>
                                <p class="text-gray-400">{{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_country }}</p>
                            </div>
                        </div>
                        @if($order->shipping_address && $order->shipping_address !== $order->billing_address)
                        <div>
                            <h4 class="font-bold text-dark text-xs uppercase tracking-wider mb-3 flex items-center gap-2">
                                <i class="fas fa-truck text-primary/50"></i> Shipping
                            </h4>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p class="font-medium text-dark">{{ $order->shipping_name }}</p>
                                <p>{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_country }}</p>
                            </div>
                        </div>
                        @endif
                        @if($order->payment_method)
                        <div>
                            <h4 class="font-bold text-dark text-xs uppercase tracking-wider mb-3 flex items-center gap-2">
                                <i class="fas fa-credit-card text-primary/50"></i> Payment
                            </h4>
                            <p class="text-sm text-gray-600 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                            <p class="text-sm"><span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/60">{{ ucfirst($order->payment_status) }}</span></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
                @auth
                    <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-dark border border-gray-200 px-6 py-3 rounded-xl font-semibold transition-all shadow-sm hover:shadow-md text-sm">
                        <i class="fas fa-eye text-primary/60"></i> View Full Details
                    </a>
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-dark border border-gray-200 px-6 py-3 rounded-xl font-semibold transition-all shadow-sm hover:shadow-md text-sm">
                        <i class="fas fa-list text-primary/60"></i> My Orders
                    </a>
                @endauth
                <a href="{{ route('books') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-primary to-[#6a1b9a] hover:from-[#6a1b9a] hover:to-primary text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl shadow-primary/20 text-sm">
                    <i class="fas fa-shopping-bag"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
</section>
@endsection