@extends('layouts.admin')

@section('title', 'Client Profile | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <h1 class="text-3xl font-bold text-white mt-1">Client Profile</h1>
            <p class="text-white/70 text-sm mt-1">Consultation history and notes.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <a href="{{ route('admin.clients') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-primary transition mb-5"><i class="fas fa-arrow-left text-xs"></i> Back to Clients</a>
    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5 mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0" style="background: var(--primary);">{{ strtoupper(substr($clientInfo->name, 0, 1)) }}</div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">{{ $clientInfo->name }}</h2>
                <div class="flex flex-wrap gap-x-4 text-xs text-gray-500 mt-0.5">
                    <span><i class="fas fa-envelope mr-1" style="color: var(--primary);"></i> {{ $clientInfo->email }}</span>
                    <span><i class="fas fa-phone mr-1" style="color: var(--primary);"></i> {{ $clientInfo->phone }}</span>
                </div>
            </div>
        </div>
        <div class="px-4 py-2.5 rounded-lg text-center md:text-left shrink-0" style="background: rgba(132,41,136,0.08); border: 1px solid rgba(132,41,136,0.15);">
            <span class="text-xs text-gray-500 block">Total Sessions</span>
            <span class="text-xl font-bold" style="color: var(--primary);">{{ count($history) }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5">
            <h3 class="section-title flex items-center gap-2 mb-5"><i class="fas fa-history" style="color: var(--primary);"></i> Session History</h3>
            @if ($history->isEmpty())
                <p class="text-gray-400 py-8 text-center text-sm">No history recorded.</p>
            @else
                <div class="relative pl-8 space-y-6" style="border-left: 2px solid rgba(132,41,136,0.2);">
                    @foreach ($history as $session)
                    <div class="relative">
                        <span class="absolute -left-[33px] top-0.5 w-5 h-5 rounded-full border-2 border-white flex items-center justify-center text-[9px] font-bold shadow-sm
                            {{ $session->status == 'approved' ? 'bg-green-500 text-white' : ($session->status == 'pending' ? 'bg-amber-500 text-white' : ($session->status == 'completed' ? 'bg-[#842988] text-white' : 'bg-red-500 text-white')) }}">
                            <i class="fas {{ $session->status == 'approved' ? 'fa-check' : ($session->status == 'pending' ? 'fa-clock' : ($session->status == 'completed' ? 'fa-check-double' : 'fa-times')) }}"></i>
                        </span>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <div><p class="font-semibold text-gray-900 text-sm capitalize">{{ $session->service }} Therapy</p><p class="text-xs text-gray-400">{{ $session->appointment_date->format('M d, Y') }} at {{ date('h:i A', strtotime($session->appointment_time)) }}</p></div>
                                <span class="badge {{ $session->status == 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($session->status == 'approved' ? 'bg-green-50 text-green-700 border-green-200' : ($session->status == 'declined' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-purple-50 text-purple-700 border-purple-200')) }}">{{ ucfirst($session->status) }}</span>
                            </div>
                            <div class="text-xs text-gray-600 mt-2 bg-white p-3 rounded-lg border border-gray-100 italic whitespace-pre-line">{{ $session->notes ?: 'No notes recorded.' }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm p-5 self-start">
            <h3 class="section-title flex items-center gap-2 mb-4"><i class="fas fa-book-open" style="color: var(--primary);"></i> Book Orders</h3>
            @if ($purchases->isEmpty())
                <p class="text-gray-400 py-6 text-center text-sm">No book orders.</p>
            @else
                <div class="space-y-4">
                    @foreach ($purchases as $p)
                    <div class="p-3 rounded-lg bg-gray-50 border border-gray-100 space-y-2">
                        <div class="flex items-start gap-3">
                            @if ($p->book->cover_image)
                                <img src="{{ asset($p->book->cover_image) }}" alt="" class="w-10 h-14 object-cover rounded border border-gray-100 shrink-0">
                            @else
                                <div class="w-10 h-14 bg-white border border-gray-100 flex items-center justify-center text-gray-300 rounded shrink-0"><i class="fas fa-book text-sm"></i></div>
                            @endif
                            <div><p class="font-semibold text-gray-900 text-sm">{{ $p->book->title }}</p><p class="text-xs text-gray-400">By {{ $p->book->author }}</p><p class="text-xs font-semibold mt-0.5" style="color: var(--primary);">{{ $p->currency }} {{ number_format($p->price, 2) }}</p></div>
                        </div>
                        <div class="text-[10px] text-gray-400 border-t border-gray-200 pt-1.5 space-y-0.5">
                            <div>Buyer: <span class="font-semibold text-gray-600">{{ $p->buyer_name }}</span></div>
                            <div>Contact: <span class="font-semibold text-gray-600">{{ $p->buyer_email }} / {{ $p->buyer_phone }}</span></div>
                            @if ($p->buyer_address)
                                <div>Address: <span class="font-semibold text-gray-600">{{ $p->buyer_address }}</span></div>
                            @endif
                            @if ($p->buyer_notes)
                                <div>Notes: <span class="font-semibold text-gray-600">{{ $p->buyer_notes }}</span></div>
                            @endif
                            <div>Method: <span class="font-semibold text-gray-600 uppercase">{{ str_replace('_', ' ', $p->payment_method) }}</span></div>
                            <div>Date: <span class="font-semibold text-gray-600">{{ $p->created_at->format('M d, Y') }}</span></div>
                        </div>
                        <form method="POST" action="{{ route('admin.order.update', $p) }}" class="border-t border-gray-200 pt-1.5">@csrf @method('PUT')
                            <div class="flex gap-2">
                                <select name="status" class="input text-[10px] px-1.5 py-1">
                                    <option value="pending" {{ $p->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $p->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ $p->status === 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-xs">Save</button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
