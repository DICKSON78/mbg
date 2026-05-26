@extends('layouts.client')

@section('title', 'My Orders | MBG Wellness')

@section('hero')
<section class="pt-32 pb-16 relative overflow-hidden bg-primary text-white">
    <div class="container mx-auto px-6 relative z-10">
        <div>
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-1">Order History</span>
            <h1 class="text-4xl font-bold">My <span class="text-gradient">Orders</span></h1>
            <p class="text-gray-200 text-sm mt-1">Track and manage your purchases and appointments</p>
        </div>
    </div>
</section>
@endsection

@section('client-content')
<section class="min-h-[500px]">
    <div class="container mx-auto px-6">
        @if($orders->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100 max-w-lg mx-auto">
                <i class="fas fa-receipt text-6xl text-gray-300 mb-4"></i>
                <h2 class="text-2xl font-bold text-dark mb-2">No orders yet</h2>
                <p class="text-gray-500 mb-8">You haven't placed any orders.</p>
                <a href="{{ route('books') }}" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg inline-flex items-center">
                    <i class="fas fa-book mr-2"></i> Browse Books
                </a>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Order</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Date</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Items</th>
                            <th class="text-right px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Total</th>
                            <th class="text-right px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-5 py-4">
                                <a href="{{ route('orders.show', $order->id) }}" class="font-semibold text-dark hover:text-primary transition">#{{ $order->order_number }}</a>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                    @if($order->status == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($order->status == 'processing') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($order->status == 'completed') bg-green-50 text-green-700 border border-green-200
                                    @elseif($order->status == 'cancelled') bg-red-50 text-red-700 border border-red-200
                                    @else bg-gray-50 text-gray-700 border border-gray-200
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-5 py-4 text-gray-500">{{ $order->items_count }} {{ Str::plural('item', $order->items_count) }}</td>
                            <td class="px-5 py-4 text-right font-bold text-primary">{{ $order->currency }} {{ number_format($order->total, 2) }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-primary hover:text-[#6a1b9a] transition text-xs font-semibold">
                                    View <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
