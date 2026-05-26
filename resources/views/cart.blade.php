@extends('layouts.app')

@section('title', 'Shopping Cart | MBG Wellness')

@section('content')
<section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #4a1558 100%);">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(252,217,27,0.08)_0%,transparent_60%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,rgba(132,41,136,0.3)_0%,transparent_50%)]"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight drop-shadow-lg">Shopping <span class="bg-gradient-to-r from-[#fcd91b] to-[#ffeb3b] bg-clip-text text-transparent">Cart</span></h1>
            <p class="text-xl text-gray-200/80 max-w-2xl mx-auto font-light">
                @if(!empty($items))
                    {{ $count }} {{ Str::plural('item', $count) }} in your cart
                @else
                    Your cart awaits
                @endif
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-b from-gray-50 to-white min-h-[500px]">
    <div class="container mx-auto px-6">

        @if(empty($items))
            <div id="empty-cart-modal" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 text-center transform transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-5">
                        <i class="fas fa-shopping-bag text-3xl text-primary"></i>
                    </div>
                    <h2 class="text-xl font-bold text-dark mb-2">Your cart is empty</h2>
                    <p class="text-sm text-gray-500 mb-8">Looks like you haven't added anything yet. Explore our collection and find something you love.</p>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('books') }}" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-3 rounded-full font-semibold transition-all shadow-lg inline-flex items-center justify-center gap-2">
                            <i class="fas fa-book"></i> Browse Books
                        </a>
                        <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                            <i class="fas fa-arrow-left mr-1"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-10 max-w-6xl mx-auto">
                <div class="lg:w-[62%] space-y-5">
                    @foreach($items as $key => $item)
                        <div class="group bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] hover:shadow-[0_8px_30px_-8px_rgba(132,41,136,0.12)] border border-gray-100/80 hover:border-primary/10 p-5 flex flex-col sm:flex-row gap-5 transition-all duration-300">
                            <div class="sm:w-28 shrink-0">
                                @if($item['type'] === 'book' && !empty($item['cover_image']))
                                    <div class="relative overflow-hidden rounded-xl shadow-sm">
                                        <img src="{{ asset($item['cover_image']) }}" alt="{{ $item['title'] }}" class="w-full h-28 sm:h-32 object-cover rounded-xl transition-transform duration-500 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                                    </div>
                                @elseif($item['type'] === 'appointment')
                                    <div class="w-full h-28 sm:h-32 bg-gradient-to-br from-primary/10 via-primary/5 to-purple-50 rounded-xl flex items-center justify-center border border-primary/5 transition-all duration-300 group-hover:border-primary/20 group-hover:shadow-inner">
                                        <i class="fas fa-calendar-check text-3xl text-primary/40 group-hover:text-primary/60 transition-colors"></i>
                                    </div>
                                @else
                                    <div class="w-full h-28 sm:h-32 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex items-center justify-center border border-gray-100">
                                        <i class="fas fa-book text-3xl text-gray-300"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-[0.12em] px-3 py-1 rounded-full {{ $item['type'] === 'appointment' ? 'bg-primary/8 text-primary border border-primary/15' : 'bg-gray-100 text-gray-500 border border-gray-200/60' }}">
                                                <i class="fas {{ $item['type'] === 'appointment' ? 'fa-calendar' : 'fa-book' }} text-[9px]"></i>
                                                {{ $item['type'] === 'appointment' ? 'Appointment' : 'Book' }}
                                            </span>
                                            <h3 class="text-[15px] font-bold text-dark mt-2.5 leading-snug">{{ $item['title'] }}</h3>
                                            @if(!empty($item['appointment_date']))
                                                <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-3">
                                                    <span class="flex items-center gap-1"><i class="far fa-calendar text-primary/50"></i> {{ $item['appointment_date'] }}</span>
                                                    <span class="flex items-center gap-1"><i class="far fa-clock text-primary/50"></i> {{ $item['appointment_time'] }}</span>
                                                </p>
                                            @endif
                                            <div class="flex flex-wrap gap-1.5 mt-2">
                                                @if($item['type'] === 'book' && !empty($item['is_digital']))
                                                    <span class="inline-flex items-center gap-1 text-[10px] font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                                                        <i class="fas fa-cloud-download-alt text-[9px]"></i> Digital Download
                                                    </span>
                                                @endif
                                                @if($item['type'] === 'book' && empty($item['is_digital']))
                                                    <span class="inline-flex items-center gap-1 text-[10px] font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200/60">
                                                        <i class="fas fa-box text-[9px]"></i> Physical Book
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <div class="text-lg font-bold" style="color: #842988;">{{ $item['currency'] ?? 'USD' }} {{ number_format($item['price'], 2) }}</div>
                                            @if($item['quantity'] > 1)
                                                <div class="text-[11px] text-gray-400 mt-0.5">{{ $item['quantity'] }} × {{ number_format($item['price'], 2) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100/80">
                                    <div class="flex items-center gap-3">
                                        <form method="POST" action="{{ route('cart.update', $key) }}" class="flex items-center">
                                            @csrf
                                            <div class="flex items-center bg-gray-50 rounded-lg border border-gray-200/80 overflow-hidden shadow-sm">
                                                <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="w-9 h-9 flex items-center justify-center text-gray-400 hover:text-primary hover:bg-gray-100 transition text-sm {{ $item['quantity'] <= 1 ? 'opacity-20 cursor-not-allowed' : '' }}" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus text-[10px]"></i>
                                                </button>
                                                <span class="w-10 h-9 flex items-center justify-center text-sm font-semibold text-dark bg-white border-x border-gray-200/80">{{ $item['quantity'] }}</span>
                                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="w-9 h-9 flex items-center justify-center text-gray-400 hover:text-primary hover:bg-gray-100 transition text-sm">
                                                    <i class="fas fa-plus text-[10px]"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <span class="text-sm font-bold text-gray-800">{{ $item['currency'] ?? 'USD' }} {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                    </div>
                                    <a href="{{ route('cart.remove', $key) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-gray-300 hover:text-white hover:bg-red-500 transition-all" onclick="return confirm('Remove this item from your cart?')">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
                        <a href="{{ route('books') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-400 hover:text-primary transition group">
                            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                            Continue Shopping
                        </a>
                        <a href="{{ route('cart.clear') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-300 hover:text-red-500 transition" onclick="return confirm('Clear all items from your cart?')">
                            <i class="fas fa-trash-alt text-xs"></i>
                            Clear Cart
                        </a>
                    </div>
                </div>

                <div class="lg:w-[38%]">
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.06)] border border-gray-100/80 p-6 lg:sticky lg:top-28">
                        <div class="flex items-center gap-3.5 mb-5 pb-5 border-b border-gray-100/80">
                            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-primary/10 to-primary/5 flex items-center justify-center shadow-inner">
                                <i class="fas fa-receipt text-primary/70 text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark">Order Summary</h3>
                                <p class="text-[11px] text-gray-400">{{ $count }} {{ Str::plural('item', $count) }}</p>
                            </div>
                        </div>

                        <div class="space-y-2.5 mb-2">
                            @foreach($items as $item)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="w-5 h-5 rounded-md bg-gray-100 text-[10px] font-bold flex items-center justify-center text-gray-500 shrink-0">{{ $item['quantity'] }}</span>
                                    <span class="text-sm text-gray-600 truncate">{{ $item['title'] }}</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 shrink-0 ml-2">{{ $item['currency'] ?? 'USD' }} {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100/80 pt-4 mt-4 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="font-semibold text-dark">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            @php $shipping = 0; foreach($items as $item) { if(empty($item['is_digital'])) { $shipping = 5.00; break; } } @endphp
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Shipping</span>
                                <span class="font-semibold {{ $shipping > 0 ? 'text-dark' : 'text-emerald-600' }}">{{ $shipping > 0 ? '$' . number_format($shipping, 2) : 'Free' }}</span>
                            </div>
                            @if($shipping > 0)
                            <div class="flex justify-between text-[11px] text-gray-400 pl-2">
                                <span>Standard delivery</span>
                                <span>3-7 business days</span>
                            </div>
                            @endif
                            <div class="border-t border-gray-100/80 pt-3 mt-3 flex justify-between items-baseline">
                                <span class="font-bold text-dark text-lg">Total</span>
                                <span class="font-bold text-2xl" style="color: #842988;">${{ number_format($subtotal + $shipping, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="mt-6 w-full bg-gradient-to-r from-primary to-[#6a1b9a] hover:from-[#6a1b9a] hover:to-primary text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl shadow-primary/20 flex items-center justify-center gap-2">
                            <i class="fas fa-lock"></i> Proceed to Checkout
                        </a>

                        <div class="mt-4 flex items-center justify-center gap-5 text-[11px] text-gray-400">
                            <span class="flex items-center gap-1.5"><i class="fas fa-shield-alt text-emerald-400"></i> Secure</span>
                            <span class="flex items-center gap-1.5"><i class="fas fa-rotate-left text-emerald-400"></i> 30-day returns</span>
                            <span class="flex items-center gap-1.5"><i class="fas fa-headset text-emerald-400"></i> Support</span>
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100/80 flex items-center justify-center gap-4 text-gray-300">
                            <i class="fab fa-cc-visa text-2xl hover:text-gray-500 transition"></i>
                            <i class="fab fa-cc-mastercard text-2xl hover:text-gray-500 transition"></i>
                            <i class="fab fa-cc-amex text-2xl hover:text-gray-500 transition"></i>
                            <div class="w-7 h-7 rounded-md bg-gray-100 flex items-center justify-center text-xs text-gray-400 font-bold">MP</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection