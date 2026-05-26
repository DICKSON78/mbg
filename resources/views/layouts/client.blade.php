@extends('layouts.app')

@push('styles')
<style>
.client-sidebar { width: 220px; }
.side-link {
    display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 6px;
    font-size: 13px; font-weight: 500; color: #374151; transition: all 0.15s;
    text-decoration: none; position: relative;
}
.side-link i { width: 16px; text-align: center; font-size: 14px; color: #9ca3af; transition: color 0.15s; }
.side-link:hover { background: rgba(132, 41, 136, 0.08); color: #842988; }
.side-link:hover i { color: #842988; }
.side-link.active { background: #842988; color: white; }
.side-link.active i { color: white; }
.side-link.active::before {
    content: ''; position: absolute; left: -16px; top: 50%; transform: translateY(-50%);
    width: 3px; height: 20px; background: #842988; border-radius: 0 3px 3px 0;
}
.side-section-title {
    font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;
    color: #9ca3af; padding: 16px 12px 6px;
}

/* Card */
.card-shadcn {
    background: white; border-radius: 10px; border: 1px solid #e5e7eb;
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
}

/* Buttons */
.btn {
    display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 6px;
    font-size: 13px; font-weight: 500; transition: all 0.12s; cursor: pointer; border: none; text-decoration: none;
}
.btn-primary { background: #842988; color: white; }
.btn-primary:hover { background: #6a1b9a; }
.btn-ghost { background: transparent; color: #374151; }
.btn-ghost:hover { background: #f9fafb; }

/* Input */
.input { 
    border: 1px solid #e5e7eb; border-radius: 6px; padding: 7px 11px; font-size: 13px;
    width: 100%; transition: all 0.12s; background: white;
}
.input:focus { outline: none; border-color: #842988; box-shadow: 0 0 0 3px rgba(132,41,136,0.08); }
.input-label { display: block; font-size: 12px; font-weight: 500; color: #374151; margin-bottom: 4px; }

/* Badge */
.badge {
    display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 9999px;
    font-size: 11px; font-weight: 500; line-height: 1.4; border: 1px solid transparent;
}

/* Section title */
.section-title { font-size: 14px; font-weight: 600; color: #111827; }
</style>
@endpush

@section('content')
    @yield('hero')

    <div class="bg-[#f5f5f7] min-h-[600px]">
        <div class="max-w-[1200px] mx-auto px-6 py-8">
            <div class="flex gap-8">
                <!-- Sidebar -->
                <aside class="client-sidebar shrink-0 hidden lg:block">
                    <div>
                        <div class="side-section-title">Main</div>
                        <a href="{{ route('profile') }}" class="side-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="fas fa-chart-pie"></i> Overview
                        </a>
                        <a href="{{ route('orders.index') }}" class="side-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                            <i class="fas fa-shopping-bag"></i> My Orders
                        </a>
                        <a href="{{ route('appointment.status') }}" class="side-link {{ request()->routeIs('appointment.status') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i> My Appointments
                        </a>

                        <div class="side-section-title">Library</div>
                        <a href="{{ route('my-books') }}" class="side-link {{ request()->routeIs('my-books') ? 'active' : '' }}">
                            <i class="fas fa-book"></i> My Books
                        </a>
                    </div>
                </aside>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    @if(session('success'))
                        <div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm flex items-center gap-2">
                            <i class="fas fa-exclamation-circle text-red-500 text-xs"></i> {{ session('error') }}
                        </div>
                    @endif
                    @yield('client-content')
                </div>
            </div>
        </div>
    </div>
@endsection
