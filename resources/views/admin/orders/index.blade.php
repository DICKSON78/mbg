@extends('layouts.admin')

@section('title', 'Orders | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Orders</h1>
            <p class="text-white/70 text-sm mt-1">Manage customer orders and fulfillment.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h1 class="text-lg font-bold text-gray-900">All Orders</h1>
            <p class="text-sm text-gray-500 mt-0.5">Filter by status below</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mb-5">
        <a href="{{ route('admin.orders') }}" class="filter-tab {{ !$status ? 'active' : '' }}">All</a>
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ route('admin.orders', ['status' => 'processing']) }}" class="filter-tab {{ $status == 'processing' ? 'active' : '' }}">Processing</a>
        <a href="{{ route('admin.orders', ['status' => 'completed']) }}" class="filter-tab {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
        <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="filter-tab {{ $status == 'cancelled' ? 'active' : '' }}">Cancelled</a>
    </div>

    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        @if ($orders->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-shopping-cart text-4xl mb-4"></i><p class="text-sm">No orders found.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Order #</th><th>Customer</th><th>Items</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $i => $o)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $orders->firstItem() + $i }}</td>
                            <td class="font-medium text-gray-900 text-sm">{{ $o->order_number }}</td>
                            <td><div class="flex items-center gap-2"><span class="av av-{{ strtolower(substr($o->billing_name, 0, 1)) }}">{{ strtoupper(substr($o->billing_name, 0, 1)) }}</span><div><div class="font-medium text-gray-900 text-sm">{{ $o->billing_name }}</div><div class="text-xs text-gray-400">{{ $o->billing_email }}</div></div></div></td>
                            <td class="text-gray-500 text-sm">{{ $o->items_count }}</td>
                            <td class="font-semibold text-gray-900 text-sm">{{ $o->currency }} {{ number_format($o->total, 2) }}</td>
                            <td><span class="badge {{ $o->payment_status == 'paid' ? 'bg-green-50 text-green-700 border-green-200' : ($o->payment_status == 'failed' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-amber-50 text-amber-700 border-amber-200') }}">{{ ucfirst($o->payment_status) }}</span></td>
                            <td><span class="badge {{ $o->status == 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($o->status == 'processing' ? 'bg-blue-50 text-blue-700 border-blue-200' : ($o->status == 'completed' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200')) }}">{{ ucfirst($o->status) }}</span></td>
                            <td class="text-xs text-gray-400">{{ $o->created_at->format('M d, Y') }}</td>
                            <td class="text-right"><a href="{{ route('admin.order.show', $o->id) }}" class="btn btn-ghost btn-xs"><i class="fas fa-eye"></i> Manage</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $orders->links() }}</div>
        @endif
    </div>
@endsection
