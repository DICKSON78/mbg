@extends('layouts.admin')

@section('title', 'Pre-order - '.$purchase->buyer_name.' | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <h1 class="text-3xl font-bold text-white">Pre-order #{{ $purchase->id }}</h1>
            <p class="text-white/70 text-sm mt-1">Manage buyer inquiry and fulfillment.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-primary transition mb-5"><i class="fas fa-arrow-left text-xs"></i> Back to Pre-orders</a>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-4"><i class="fas fa-book" style="color: var(--primary);"></i> Book Details</h3>
                <div class="flex items-center gap-4">
                    @if ($purchase->book->cover_image)
                        <img src="{{ asset($purchase->book->cover_image) }}" alt="{{ $purchase->book->title }}" class="w-20 h-28 object-cover rounded-lg shadow-sm border border-gray-200">
                    @else
                        <div class="w-20 h-28 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 border border-gray-200"><i class="fas fa-book text-3xl"></i></div>
                    @endif
                    <div>
                        <h4 class="font-bold text-gray-900">{{ $purchase->book->title ?? 'N/A' }}</h4>
                        <p class="text-sm text-gray-500">By {{ $purchase->book->author ?? 'N/A' }}</p>
                        <p class="text-lg font-bold mt-2" style="color: var(--primary);">{{ $purchase->currency }} {{ number_format($purchase->price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-4"><i class="fas fa-truck" style="color: var(--primary);"></i> Fulfillment Status</h3>
                <form id="statusForm" method="POST" action="{{ route('admin.order.update', $purchase->id) }}" class="space-y-4" onsubmit="return updateStatus(this, event)">@csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="input-label">Status</label>
                            <select name="status" class="input">
                                <option value="pending" {{ $purchase->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $purchase->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="delivered" {{ $purchase->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $purchase->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div><label class="input-label">Admin Notes</label><textarea name="notes" rows="2" class="input" placeholder="Internal notes about this pre-order">{{ $purchase->buyer_notes }}</textarea></div>
                    <div class="flex justify-end"><button type="submit" id="statusSubmitBtn" class="btn btn-primary">Update Status</button></div>
                </form>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-user" style="color: var(--primary);"></i> Buyer</h3>
                <div class="space-y-1.5 text-sm">
                    <p><span class="text-gray-500">Name:</span> <span class="font-medium text-gray-900">{{ $purchase->buyer_name }}</span></p>
                    <p><span class="text-gray-500">Email:</span> <span class="font-medium text-gray-900">{{ $purchase->buyer_email }}</span></p>
                    <p><span class="text-gray-500">Phone:</span> <span class="font-medium text-gray-900">{{ $purchase->buyer_phone }}</span></p>
                </div>
            </div>

            @if ($purchase->buyer_address)
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> Delivery Address</h3>
                <p class="text-sm text-gray-600">{{ $purchase->buyer_address }}</p>
            </div>
            @endif

            @if ($purchase->buyer_notes)
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-sticky-note" style="color: var(--primary);"></i> Buyer Notes</h3>
                <p class="text-sm text-gray-600">{{ $purchase->buyer_notes }}</p>
            </div>
            @endif

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
                <h3 class="section-title flex items-center gap-2 mb-3"><i class="fas fa-calendar" style="color: var(--primary);"></i> Timeline</h3>
                <div class="space-y-1.5 text-sm">
                    <p><span class="text-gray-500">Pre-ordered:</span> <span class="font-medium text-gray-900">{{ $purchase->created_at->format('M d, Y g:i A') }}</span></p>
                    @if ($purchase->updated_at != $purchase->created_at)
                        <p><span class="text-gray-500">Last updated:</span> <span class="font-medium text-gray-900">{{ $purchase->updated_at->format('M d, Y g:i A') }}</span></p>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('admin.order.destroy', $purchase->id) }}" onsubmit="return confirm('Delete this pre-order?')" class="block">
                @csrf @method('DELETE')
                <button type="submit" class="w-full text-center text-sm font-medium text-red-600 hover:text-red-700 py-2.5 rounded-lg border border-red-200 hover:bg-red-50 transition"><i class="fas fa-trash-alt mr-1.5"></i> Delete Pre-order</button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="statusSuccessModal" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8 text-center transform transition-all duration-300">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-2xl text-green-600"></i>
            </div>
            <h3 class="text-lg font-bold text-dark mb-2">Status Updated</h3>
            <p class="text-sm text-gray-600">Pre-order status updated successfully.</p>
            <button onclick="document.getElementById('statusSuccessModal').classList.add('hidden')" class="mt-6 bg-primary hover:bg-[#6a1b9a] text-white px-8 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                Done
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function updateStatus(form, event) {
    event.preventDefault();
    const btn = document.getElementById('statusSubmitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
    btn.classList.add('opacity-60', 'cursor-not-allowed');

    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(r => {
        if (!r.ok) return r.json().then(err => Promise.reject(err));
        return r.json();
    })
    .then(data => {
        document.getElementById('statusSuccessModal').classList.remove('hidden');
        btn.disabled = false;
        btn.innerHTML = 'Update Status';
        btn.classList.remove('opacity-60', 'cursor-not-allowed');
    })
    .catch(err => {
        const msg = err?.errors ? Object.values(err.errors).flat().join(', ') : (err?.message || 'Something went wrong.');
        alert(msg);
        btn.disabled = false;
        btn.innerHTML = 'Update Status';
        btn.classList.remove('opacity-60', 'cursor-not-allowed');
    });

    return false;
}
</script>
@endpush
