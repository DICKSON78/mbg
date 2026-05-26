@extends('layouts.client')

@section('title', 'My Profile | MBG Wellness')

@section('hero')
    <section class="pt-32 pb-16 relative overflow-hidden bg-primary text-white">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-1">Client Dashboard</span>
                    <h1 class="text-4xl font-bold">Welcome, <span class="text-gradient">{{ $user->name }}</span></h1>
                    <p class="text-gray-200 text-sm mt-1">Manage your consultations, view your purchased books, and read therapeutic feedback.</p>
                </div>
                <div class="bg-white bg-opacity-10 border border-white border-opacity-10 px-5 py-3 rounded-xl backdrop-blur-md shrink-0">
                    <div class="text-xs text-gray-300">Registered Email</div>
                    <div class="font-semibold text-sm">{{ $user->email }}</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('client-content')
    <section class="min-h-[500px]">
        <div class="space-y-8">
            
            <!-- Appointment Consultations -->
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-dark flex items-center">
                        <i class="fas fa-calendar-alt text-primary mr-2"></i> My Appointment Schedule
                    </h2>
                    <a href="{{ route('appointment.status') }}" class="text-xs text-primary hover:underline font-semibold">
                        View All
                    </a>
                </div>

                @if ($appointments->isEmpty())
                    <div class="text-center py-12 text-gray-400">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="far fa-calendar-times text-2xl text-primary"></i>
                        </div>
                        <p class="text-sm text-gray-500">You haven't requested any appointment sessions yet.</p>
                        <a href="javascript:void(0)" onclick="openBookModal()" class="mt-5 inline-flex bg-primary hover:bg-[#6a1b9a] text-white text-xs font-semibold px-5 py-2.5 rounded-full transition-all shadow-lg hover:shadow-xl items-center gap-1.5">
                            <i class="fas fa-calendar-plus"></i> Schedule Session
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($appointments->take(3) as $app)
                            <div class="bg-white rounded-xl border border-purple-100 p-5 hover:shadow-md transition">
                                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                                    <div>
                                        <h3 class="font-bold text-gray-800 capitalize">{{ $app->service }} Therapy Session</h3>
                                        <div class="text-xs text-gray-500 mt-1 flex flex-wrap gap-x-4">
                                            <span><i class="far fa-calendar mr-1 text-primary"></i> {{ $app->appointment_date->format('M d, Y') }}</span>
                                            <span><i class="far fa-clock mr-1 text-primary"></i> {{ date('h:i A', strtotime($app->appointment_time)) }}</span>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                        @if($app->status == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                        @elseif($app->status == 'approved') bg-green-50 text-green-700 border border-green-200
                                        @elseif($app->status == 'declined') bg-red-50 text-red-700 border border-red-200
                                        @else bg-purple-50 text-purple-700 border border-purple-200
                                        @endif">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </div>

                                <div class="mt-3 pt-3 border-t border-purple-100">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Message / Session Notes from Doctor</h4>
                                    <div class="bg-purple-50/50 p-4 rounded-lg border border-purple-100 text-sm text-gray-600 italic whitespace-pre-line leading-relaxed">
                                        {{ $app->notes ?: 'Waiting for doctor\'s clinical response/feedback notes. These will appear here once the session is reviewed or completed.' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($appointments->count() > 3)
                            <div class="text-center pt-2">
                                <a href="{{ route('appointment.status') }}" class="text-sm text-primary hover:underline font-semibold">
                                    View All {{ $appointments->count() }} Appointments <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Quick Links -->
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-dark flex items-center mb-4">
                    <i class="fas fa-link text-primary mr-2"></i> Quick Links
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{ route('my-books') }}" class="flex items-center gap-3 p-4 rounded-xl bg-white border border-purple-100 hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary"><i class="fas fa-book-open"></i></div>
                        <div><div class="font-semibold text-sm text-gray-800">My Books</div><div class="text-xs text-gray-400">Purchased library</div></div>
                    </a>
                    <a href="{{ route('appointment.status') }}" class="flex items-center gap-3 p-4 rounded-xl bg-white border border-purple-100 hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary"><i class="fas fa-calendar-check"></i></div>
                        <div><div class="font-semibold text-sm text-gray-800">Appointments</div><div class="text-xs text-gray-400">View status</div></div>
                    </a>
                    <a href="{{ route('orders.index') }}" class="flex items-center gap-3 p-4 rounded-xl bg-white border border-purple-100 hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary"><i class="fas fa-receipt"></i></div>
                        <div><div class="font-semibold text-sm text-gray-800">My Orders</div><div class="text-xs text-gray-400">Order history</div></div>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
