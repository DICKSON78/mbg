@extends('layouts.app')

@section('title', 'Checkout | MBG Wellness')

@section('content')
<section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #5a1d6e 100%);">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Secure <span class="text-gradient">Checkout</span></h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">Complete your order and take the next step in your wellness journey</p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-[500px]">
    <div class="container mx-auto px-6">
        <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm">
            @csrf

            @if ($errors->any())
                <div class="max-w-4xl mx-auto mb-8 bg-red-50 border border-red-200 text-red-700 p-5 rounded-xl text-sm shadow-sm">
                    <div class="flex items-center gap-2 font-semibold mb-2">
                        <i class="fas fa-exclamation-triangle"></i> Please fix the following errors:
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-10 max-w-6xl mx-auto">
                <div class="lg:w-[60%] space-y-6">
                    <!-- Billing -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center shrink-0">1</span>
                            <div>
                                <h2 class="text-lg font-bold text-dark">Billing Information</h2>
                                <p class="text-xs text-gray-400">Who is this order for?</p>
                            </div>
                        </div>
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="billing_name" class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name *</label>
                                    <input type="text" id="billing_name" name="billing_name" required value="{{ old('billing_name', auth()->user()->name ?? '') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white"
                                           placeholder="John Doe">
                                </div>
                                <div>
                                    <label for="billing_email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address *</label>
                                    <input type="email" id="billing_email" name="billing_email" required value="{{ old('billing_email', auth()->user()->email ?? '') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white"
                                           placeholder="john@example.com">
                                </div>
                            </div>
                            <div>
                                <label for="billing_phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number *</label>
                                <input type="tel" id="billing_phone" name="billing_phone" required value="{{ old('billing_phone') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white"
                                       placeholder="+255 792 326 665">
                            </div>
                            <div>
                                <label for="billing_address" class="block text-sm font-semibold text-gray-700 mb-1.5">Street Address *</label>
                                <input type="text" id="billing_address" name="billing_address" required value="{{ old('billing_address') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white"
                                       placeholder="123 Main Street">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="billing_city" class="block text-sm font-semibold text-gray-700 mb-1.5">City *</label>
                                    <input type="text" id="billing_city" name="billing_city" required value="{{ old('billing_city') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                </div>
                                <div>
                                    <label for="billing_state" class="block text-sm font-semibold text-gray-700 mb-1.5">State / Region</label>
                                    <input type="text" id="billing_state" name="billing_state" value="{{ old('billing_state') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                </div>
                                <div>
                                    <label for="billing_country" class="block text-sm font-semibold text-gray-700 mb-1.5">Country *</label>
                                    <select id="billing_country" name="billing_country" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                        <option value="">Select country</option>
                                        <option value="Tanzania" {{ old('billing_country', 'Tanzania') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="Qatar" {{ old('billing_country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="United States" {{ old('billing_country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="United Kingdom" {{ old('billing_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="Canada" {{ old('billing_country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Kenya" {{ old('billing_country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Uganda" {{ old('billing_country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                        <option value="Rwanda" {{ old('billing_country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="South Africa" {{ old('billing_country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="Nigeria" {{ old('billing_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Other" {{ old('billing_country') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php $hasPhysical = false; foreach($items as $item) { if(empty($item['is_digital'])) { $hasPhysical = true; break; } } @endphp

                    @if($hasPhysical)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center shrink-0">2</span>
                            <div>
                                <h2 class="text-lg font-bold text-dark">Shipping Information</h2>
                                <p class="text-xs text-gray-400">Where should we deliver?</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-5 flex items-center gap-1.5">
                            <i class="fas fa-info-circle text-primary/60"></i>
                            Same as billing?
                            <a href="javascript:void(0)" onclick="copyBilling()" class="text-primary font-semibold hover:underline">Copy billing details</a>
                        </p>
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="shipping_name" class="block text-sm font-semibold text-gray-700 mb-1.5">Recipient Name *</label>
                                    <input type="text" id="shipping_name" name="shipping_name" value="{{ old('shipping_name') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                </div>
                                <div>
                                    <label for="shipping_phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Recipient Phone *</label>
                                    <input type="tel" id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                </div>
                            </div>
                            <div>
                                <label for="shipping_address" class="block text-sm font-semibold text-gray-700 mb-1.5">Shipping Address *</label>
                                <input type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="shipping_city" class="block text-sm font-semibold text-gray-700 mb-1.5">City *</label>
                                    <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                </div>
                                <div>
                                    <label for="shipping_state" class="block text-sm font-semibold text-gray-700 mb-1.5">State / Region</label>
                                    <input type="text" id="shipping_state" name="shipping_state" value="{{ old('shipping_state') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                </div>
                                <div>
                                    <label for="shipping_country" class="block text-sm font-semibold text-gray-700 mb-1.5">Country *</label>
                                    <select id="shipping_country" name="shipping_country"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white">
                                        <option value="">Select country</option>
                                        <option value="Tanzania" {{ old('shipping_country', 'Tanzania') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="Qatar" {{ old('shipping_country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="United States" {{ old('shipping_country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="United Kingdom" {{ old('shipping_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="Canada" {{ old('shipping_country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Kenya" {{ old('shipping_country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Uganda" {{ old('shipping_country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                        <option value="Rwanda" {{ old('shipping_country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="South Africa" {{ old('shipping_country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="Nigeria" {{ old('shipping_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Other" {{ old('shipping_country') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Payment -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center shrink-0">{{ $hasPhysical ? '3' : '2' }}</span>
                            <div>
                                <h2 class="text-lg font-bold text-dark">Payment Method</h2>
                                <p class="text-xs text-gray-400">Choose how to pay</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @php $methods = [
                                ['value' => 'mpesa', 'icon' => 'fas fa-mobile-alt', 'label' => 'M-Pesa', 'desc' => 'Tanzania'],
                                ['value' => 'airtel_money', 'icon' => 'fas fa-mobile-alt', 'label' => 'Airtel Money', 'desc' => 'Tanzania'],
                                ['value' => 'tigo_pesa', 'icon' => 'fas fa-mobile-alt', 'label' => 'Tigo Pesa', 'desc' => 'Tanzania'],
                                ['value' => 'card', 'icon' => 'fas fa-credit-card', 'label' => 'Credit / Debit Card', 'desc' => 'Visa, Mastercard, Amex'],
                                ['value' => 'bank_transfer', 'icon' => 'fas fa-university', 'label' => 'Bank Transfer', 'desc' => 'Direct deposit'],
                            ]; @endphp
                            @foreach($methods as $m)
                            <label class="relative flex items-center gap-3.5 p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 has-[:checked]:shadow-sm border-gray-100 hover:border-gray-200 bg-white">
                                <input type="radio" name="payment_method" value="{{ $m['value'] }}" class="absolute opacity-0" {{ old('payment_method', 'mpesa') == $m['value'] ? 'checked' : '' }} onchange="this.closest('label').querySelector('.pm-radio').classList.add('ring-2','ring-primary','ring-offset-2')">
                                <span class="pm-radio w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0 {{ old('payment_method', 'mpesa') == $m['value'] ? 'ring-2 ring-primary ring-offset-2' : '' }}">
                                    <span class="w-2.5 h-2.5 rounded-full {{ old('payment_method', 'mpesa') == $m['value'] ? 'bg-primary' : '' }}"></span>
                                </span>
                                <i class="{{ $m['icon'] }} text-lg text-primary/70"></i>
                                <div>
                                    <span class="font-semibold text-dark text-sm">{{ $m['label'] }}</span>
                                    <p class="text-[11px] text-gray-400">{{ $m['desc'] }}</p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 text-sm font-bold flex items-center justify-center shrink-0"><i class="fas fa-pen text-xs"></i></span>
                            <div>
                                <h2 class="text-lg font-bold text-dark">Order Notes</h2>
                                <p class="text-xs text-gray-400">Special instructions (optional)</p>
                            </div>
                        </div>
                        <textarea name="notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none text-sm transition bg-gray-50/50 hover:bg-white focus:bg-white" placeholder="Any special instructions for your order?">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:w-[40%]">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:sticky lg:top-28">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-receipt text-primary text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-base">Your Order</h3>
                                <p class="text-xs text-gray-400">{{ count($items) }} {{ Str::plural('item', count($items)) }}</p>
                            </div>
                        </div>

                        <div class="space-y-3 max-h-64 overflow-y-auto pr-1 -mr-1">
                            @foreach($items as $item)
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center shrink-0 overflow-hidden">
                                    @if($item['type'] === 'book' && !empty($item['cover_image']))
                                        <img src="{{ asset($item['cover_image']) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas {{ $item['type'] === 'appointment' ? 'fa-calendar-check' : 'fa-book' }} text-sm text-gray-300"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-dark truncate">{{ $item['title'] }}</p>
                                    <p class="text-xs text-gray-400">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 shrink-0">{{ $item['currency'] ?? 'USD' }} {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100 pt-4 mt-4 space-y-2.5">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="font-semibold text-dark">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Shipping</span>
                                <span class="font-semibold {{ $shipping > 0 ? 'text-dark' : 'text-emerald-600' }}">{{ $shipping > 0 ? '$' . number_format($shipping, 2) : 'Free' }}</span>
                            </div>
                            @if($shipping > 0)
                            <div class="flex justify-between text-xs text-gray-400 pl-2">
                                <span>Delivery</span>
                                <span>3-7 business days</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Tax</span>
                                <span class="font-semibold text-dark">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-100 pt-3 flex justify-between items-baseline">
                                <span class="font-bold text-dark text-lg">Total</span>
                                <span class="font-bold text-primary text-2xl">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit"
                                class="mt-6 w-full bg-primary hover:bg-[#6a1b9a] text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2"
                                onclick="this.disabled=true;this.innerHTML='<i class=\'fas fa-spinner fa-spin\'></i> Placing Order...';this.form.submit();">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="mt-3 w-full block text-center text-sm text-gray-400 hover:text-primary transition">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Cart
                        </a>

                        <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-center gap-4 text-xs text-gray-400">
                            <span class="flex items-center gap-1"><i class="fas fa-shield-alt text-emerald-500"></i> Secure checkout</span>
                            <span class="flex items-center gap-1"><i class="fas fa-lock text-emerald-500"></i> Encrypted</span>
                        </div>

                        <div class="mt-3 flex items-center justify-center gap-3 text-gray-300">
                            <i class="fab fa-cc-visa text-2xl"></i>
                            <i class="fab fa-cc-mastercard text-2xl"></i>
                            <i class="fab fa-cc-amex text-2xl"></i>
                            <i class="fas fa-mobile-alt text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
function copyBilling() {
    const map = {'name':'shipping_name','email':'shipping_email','phone':'shipping_phone','address':'shipping_address','city':'shipping_city','state':'shipping_state','country':'shipping_country'};
    Object.entries(map).forEach(([srcId, dstId]) => {
        const src = document.getElementById('billing_' + srcId);
        const dst = document.getElementById(dstId);
        if (src && dst) dst.value = src.value;
    });
}
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.pm-radio').forEach(el => {
            el.classList.remove('ring-2','ring-primary','ring-offset-2');
            el.querySelector('span')?.classList.remove('bg-primary');
        });
        const label = this.closest('label');
        if (label) {
            const dot = label.querySelector('.pm-radio');
            dot.classList.add('ring-2','ring-primary','ring-offset-2');
            dot.querySelector('span').classList.add('bg-primary');
        }
    });
});
</script>
@endpush