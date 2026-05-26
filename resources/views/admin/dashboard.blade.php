@extends('layouts.admin')

@section('title', 'Admin Dashboard | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Dashboard</h1>
            <p class="text-white/70 text-sm mt-1">Overview of your business metrics.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="page-head">
        <h1>Overview</h1>
        <p>Key metrics at a glance</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-5 shadow-sm flex items-center justify-between">
            <div>
                <div class="metric-label">Pending Bookings</div>
                <div class="metric-value">{{ $stats['pending_appointments'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500"><i class="fas fa-clock"></i></div>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-5 shadow-sm flex items-center justify-between">
            <div>
                <div class="metric-label">Approved Sessions</div>
                <div class="metric-value">{{ $stats['approved_appointments'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center text-green-500"><i class="fas fa-check-circle"></i></div>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-5 shadow-sm flex items-center justify-between">
            <div>
                <div class="metric-label">Books for Sale</div>
                <div class="metric-value">{{ $stats['total_books'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: rgba(132,41,136,0.1); color: #842988;"><i class="fas fa-book"></i></div>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-5 shadow-sm flex items-center justify-between">
            <div>
                <div class="metric-label">Unique Clients</div>
                <div class="metric-value">{{ $stats['total_clients'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500"><i class="fas fa-users"></i></div>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-5 shadow-sm flex items-center justify-between">
            <div>
                <div class="metric-label">Total Orders</div>
                <div class="metric-value">{{ $stats['total_orders'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500"><i class="fas fa-shopping-bag"></i></div>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-5 shadow-sm flex items-center justify-between">
            <div>
                <div class="metric-label">Pending Orders</div>
                <div class="metric-value">{{ $stats['pending_orders'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center text-red-500"><i class="fas fa-hourglass-half"></i></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm">
            <div class="px-5 py-4 border-b border-purple-100 flex items-center justify-between">
                <h3 class="section-title flex items-center gap-2"><i class="fas fa-calendar-check text-green-500 section-icon"></i> Upcoming Sessions</h3>
                <a href="{{ route('admin.appointments', ['status' => 'approved']) }}" class="text-xs font-medium" style="color: var(--primary);">View all</a>
            </div>
            @if ($upcomingSessions->isEmpty())
                <div class="text-center py-12 text-gray-400"><i class="fas fa-calendar-times text-3xl mb-3"></i><p class="text-sm">No upcoming sessions.</p></div>
            @else
                <div class="divide-y divide-purple-50">
                    @foreach ($upcomingSessions as $s)
                    <div class="px-5 py-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0" style="background: rgba(132,41,136,0.1); color: #842988;">{{ strtoupper(substr($s->name, 0, 1)) }}</div>
                            <div><p class="text-sm font-medium text-gray-800">{{ $s->name }}</p><p class="text-xs text-gray-400">{{ ucfirst($s->service) }}</p></div>
                        </div>
                        <div class="text-right text-xs"><p class="font-medium text-gray-700">{{ $s->appointment_date->format('M d, Y') }}</p><p class="text-gray-400">{{ date('h:i A', strtotime($s->appointment_time)) }}</p></div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm">
            <div class="px-5 py-4 border-b border-purple-100 flex items-center justify-between">
                <h3 class="section-title flex items-center gap-2"><i class="fas fa-inbox section-icon" style="color: var(--primary);"></i> Recent Requests</h3>
                <a href="{{ route('admin.appointments') }}" class="text-xs font-medium" style="color: var(--primary);">View all</a>
            </div>
            @if ($recentAppointments->isEmpty())
                <div class="text-center py-12 text-gray-400"><i class="fas fa-inbox text-3xl mb-3"></i><p class="text-sm">No requests yet.</p></div>
            @else
                <div class="divide-y divide-purple-50">
                    @foreach ($recentAppointments as $a)
                    <div class="px-5 py-3.5 flex items-center justify-between">
                        <div><p class="text-sm font-medium text-gray-800">{{ $a->name }}</p><p class="text-xs text-gray-400">{{ $a->phone }}</p></div>
                        <div class="flex items-center gap-3">
                            <span class="badge {{ $a->status == 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($a->status == 'approved' ? 'bg-green-50 text-green-700 border-green-200' : ($a->status == 'declined' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-gray-50 text-gray-600 border-gray-200')) }}">{{ ucfirst($a->status) }}</span>
                            <a href="{{ route('admin.appointments') }}" class="text-xs font-medium" style="color: var(--primary);">Manage</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
