@extends('layouts.client')

@section('title', 'My Appointments | MBG Wellness')

@section('hero')
<section class="pt-32 pb-16 relative overflow-hidden bg-primary text-white">
    <div class="container mx-auto px-6 relative z-10">
        <div>
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-1">Client Panel</span>
            <h1 class="text-4xl font-bold">My <span class="text-gradient">Appointments</span></h1>
            <p class="text-gray-200 text-sm mt-1">Track the status of your booked sessions and view confirmations.</p>
        </div>
    </div>
</section>
@endsection

@section('client-content')
<div class="space-y-6">
    @if($appointments->isEmpty())
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-12 text-center shadow-sm">
            <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="far fa-calendar-alt text-3xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold text-dark mb-2">No Appointments Yet</h3>
            <p class="text-sm text-gray-500 mb-8 max-w-xs mx-auto">You haven't booked any sessions yet. Start your wellness journey today.</p>
            <a href="javascript:void(0)" onclick="openBookModal()" class="bg-primary hover:bg-[#6a1b9a] text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center gap-2 text-sm">
                <i class="fas fa-calendar-plus"></i> Book a Session
            </a>
        </div>
    @else
        @foreach($appointments as $app)
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-6 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-calendar-check text-primary text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark">{{ $app->title }}</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-semibold rounded-full
                                    @if($app->status == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($app->status == 'approved') bg-green-50 text-green-700 border border-green-200
                                    @elseif($app->status == 'declined') bg-red-50 text-red-700 border border-red-200
                                    @else bg-gray-50 text-gray-700 border border-gray-200
                                    @endif">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="far fa-calendar text-primary text-xs w-4"></i>
                                <span>{{ $app->appointment_date->format('l, M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="far fa-clock text-primary text-xs w-4"></i>
                                <span>{{ $app->formatted_time_range }}</span>
                            </div>
                            @if($app->price > 0)
                            <div class="flex items-center gap-2">
                                <i class="fas fa-tag text-primary text-xs w-4"></i>
                                <span>{{ $app->currency }} {{ number_format($app->price, 2) }}</span>
                            </div>
                            @endif
                        </div>

                        @if($app->status == 'approved')
                            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-xl">
                                <p class="text-xs text-green-800 font-medium flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                    Your session has been confirmed! Please arrive on time.
                                </p>
                            </div>
                        @elseif($app->status == 'declined')
                            <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                                <p class="text-xs text-red-800 font-medium flex items-center gap-2">
                                    <i class="fas fa-times-circle text-red-600"></i>
                                    Unfortunately, this session could not be accommodated.
                                </p>
                            </div>
                        @else
                            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-xl">
                                <p class="text-xs text-yellow-800 font-medium flex items-center gap-2">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                    Awaiting confirmation from our team. We'll notify you once approved.
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="shrink-0">
                        <div class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider {{ $app->status == 'approved' ? 'bg-green-50 text-green-700' : ($app->status == 'declined' ? 'bg-red-50 text-red-600' : 'bg-yellow-50 text-yellow-700') }}">
                            @if($app->status == 'approved')
                                <i class="fas fa-check-circle mr-1"></i> Confirmed
                            @elseif($app->status == 'declined')
                                <i class="fas fa-times-circle mr-1"></i> Declined
                            @else
                                <i class="fas fa-hourglass-half mr-1"></i> Pending
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
