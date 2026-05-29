@extends('layouts.client')

@section('title', 'My Books | MBG Wellness')

@section('hero')
<section class="pt-32 pb-16 relative overflow-hidden bg-primary text-white">
    <div class="container mx-auto px-6 relative z-10">
        <div>
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-1">My Library</span>
            <h1 class="text-4xl font-bold">My <span class="text-gradient">Books</span></h1>
            <p class="text-gray-200 text-sm mt-1">Browse and download books you've purchased.</p>
        </div>
    </div>
</section>
@endsection

@section('client-content')
<div class="space-y-6">
    @if($purchases->isEmpty())
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-12 text-center shadow-sm">
            <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-book-open text-3xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold text-dark mb-2">No Books Purchased Yet</h3>
            <p class="text-sm text-gray-500 mb-8 max-w-xs mx-auto">Browse our bookstore and start your reading journey.</p>
            <a href="{{ route('books') }}" class="bg-primary hover:bg-[#6a1b9a] text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center gap-2 text-sm">
                <i class="fas fa-store"></i> Browse Bookstore
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($purchases as $p)
                <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 overflow-hidden hover:shadow-md transition">
                    <div class="flex">
                        <div class="w-28 shrink-0 bg-white">
                            @if ($p->book->cover_image)
                                <img src="{{ asset($p->book->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-book text-3xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col justify-between flex-1">
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $p->book->title }}</h3>
                                <p class="text-xs text-gray-500 mb-2">By {{ $p->book->author }}</p>
                                <p class="text-xs text-gray-600 font-semibold">
                                    {{ $p->currency }} {{ number_format($p->price, 2) }}
                                </p>
                                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-bold rounded-full 
                                    @if($p->status == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($p->status == 'completed') bg-green-50 text-green-700 border border-green-200
                                    @else bg-red-50 text-red-700 border border-red-200
                                    @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </div>
                            <div class="mt-3 flex items-center gap-2">
                                @if($p->status === 'completed')
                                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i> Delivered
                                    </span>
                                @elseif($p->status === 'pending')
                                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <i class="fas fa-clock"></i> Processing
                                    </span>
                                @else
                                    <span class="text-xs font-semibold text-red-600 bg-red-50 px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <i class="fas fa-times-circle"></i> Cancelled
                                    </span>
                                @endif
                                <span class="text-[10px] text-gray-400">Manual Payment</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
