@extends('layouts.admin')

@section('title', 'Pre-orders | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Pre-orders</h1>
            <p class="text-white/70 text-sm mt-1">Manage book pre-orders and buyer inquiries.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-purple-100">
            <h3 class="font-semibold text-gray-900 text-sm">All Pre-orders</h3>
            <p class="text-xs text-gray-400 mt-0.5">Filter by status below</p>
        </div>
        <div class="flex flex-wrap gap-2 px-5 py-3 border-b border-purple-100/50">
            <a href="{{ route('admin.orders') }}" class="filter-tab {{ !$status ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">Pending</a>
            <a href="{{ route('admin.orders', ['status' => 'processing']) }}" class="filter-tab {{ $status == 'processing' ? 'active' : '' }}">Processing</a>
            <a href="{{ route('admin.orders', ['status' => 'delivered']) }}" class="filter-tab {{ $status == 'delivered' ? 'active' : '' }}">Delivered</a>
            <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="filter-tab {{ $status == 'cancelled' ? 'active' : '' }}">Cancelled</a>
        </div>
        @if ($purchases->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-book-open text-4xl mb-4"></i><p class="text-sm">No pre-orders found.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Buyer</th><th>Book</th><th>Price</th><th>Phone</th><th>Status</th><th>Date</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $i => $p)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $purchases->firstItem() + $i }}</td>
                            <td><div class="flex items-center gap-2"><span class="av av-{{ strtolower(substr($p->buyer_name, 0, 1)) }}">{{ strtoupper(substr($p->buyer_name, 0, 1)) }}</span><div><div class="font-medium text-gray-900 text-sm">{{ $p->buyer_name }}</div><div class="text-xs text-gray-400">{{ $p->buyer_email }}</div></div></div></td>
                            <td class="font-medium text-gray-900 text-sm">{{ $p->book->title ?? 'N/A' }}</td>
                            <td class="font-semibold text-gray-900 text-sm">{{ $p->currency }} {{ number_format($p->price, 2) }}</td>
                            <td class="text-sm text-gray-600">{{ $p->buyer_phone }}</td>
                            <td><span class="badge {{ $p->status == 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($p->status == 'processing' ? 'bg-blue-50 text-blue-700 border-blue-200' : ($p->status == 'delivered' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200')) }}">{{ ucfirst($p->status) }}</span></td>
                            <td class="text-xs text-gray-400">{{ $p->created_at->format('M d, Y') }}</td>
                            <td class="text-right"><a href="{{ route('admin.order.show', $p->id) }}" class="btn btn-ghost btn-xs"><i class="fas fa-eye"></i> View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $purchases->links() }}</div>
        @endif
    </div>
@endsection
