@extends('layouts.app')

@push('styles')
<style>
:root {
    --primary: #842988;
    --primary-light: rgba(132, 41, 136, 0.08);
    --primary-dark: #6a1b9a;
    --sidebar-width: 240px;
    --border: #e5e7eb;
    --bg-muted: #f9fafb;
    --text-muted: #6b7280;
    --radius: 8px;
}

/* Sidebar */
.sidebar { width: var(--sidebar-width); }
.side-link {
    display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 6px;
    font-size: 13px; font-weight: 500; color: #374151; transition: all 0.15s;
    text-decoration: none; position: relative;
}
.side-link i { width: 16px; text-align: center; font-size: 14px; color: #9ca3af; transition: color 0.15s; }
.side-link:hover { background: var(--primary-light); color: var(--primary); }
.side-link:hover i { color: var(--primary); }
.side-link.active { background: var(--primary); color: white; }
.side-link.active i { color: white; }
.side-link.active::before {
    content: ''; position: absolute; left: -16px; top: 50%; transform: translateY(-50%);
    width: 3px; height: 20px; background: var(--primary); border-radius: 0 3px 3px 0;
}
.side-section-title {
    font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;
    color: #9ca3af; padding: 16px 12px 6px;
}

/* Card */
.card-shadcn {
    background: white; border-radius: 10px; border: 1px solid var(--border);
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
}
.card-shadcn:hover { box-shadow: 0 1px 4px rgba(0,0,0,0.04); }

/* Table */
.tbl-shadcn { width: 100%; border-collapse: collapse; }
.tbl-shadcn th {
    padding: 10px 16px; font-size: 11px; font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.04em; color: var(--text-muted); background: var(--bg-muted);
    text-align: left; border-bottom: 1px solid var(--border);
}
.tbl-shadcn td { padding: 12px 16px; font-size: 13px; border-bottom: 1px solid #f3f4f6; }
.tbl-shadcn tr:last-child td { border-bottom: none; }
.tbl-shadcn tbody tr { transition: background 0.1s; }
.tbl-shadcn tbody tr:hover { background: var(--bg-muted); }

/* Metric Card */
.metric { padding: 20px; }
.metric-label { font-size: 12px; font-weight: 500; color: var(--text-muted); }
.metric-value { font-size: 28px; font-weight: 700; color: #111827; margin-top: 2px; letter-spacing: -0.02em; }
.metric-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; }

/* Badge */
.badge {
    display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 9999px;
    font-size: 11px; font-weight: 500; line-height: 1.4; border: 1px solid transparent;
}

/* Buttons */
.btn {
    display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 6px;
    font-size: 13px; font-weight: 500; transition: all 0.12s; cursor: pointer; border: none; text-decoration: none;
}
.btn-primary { background: var(--primary); color: white; }
.btn-primary:hover { background: var(--primary-dark); }
.btn-ghost { background: transparent; color: #374151; }
.btn-ghost:hover { background: var(--bg-muted); }
.btn-outline { background: white; color: #374151; border: 1px solid var(--border); }
.btn-outline:hover { background: var(--bg-muted); }
.btn-sm { padding: 5px 10px; font-size: 12px; border-radius: 5px; }
.btn-xs { padding: 3px 8px; font-size: 11px; border-radius: 4px; }
.btn-icon { width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 6px; }

/* Input */
.input { 
    border: 1px solid var(--border); border-radius: 6px; padding: 7px 11px; font-size: 13px;
    width: 100%; transition: all 0.12s; background: white;
}
.input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(132,41,136,0.08); }
.input-label { display: block; font-size: 12px; font-weight: 500; color: #374151; margin-bottom: 4px; }

/* Filter tabs */
.filter-tab {
    padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 500;
    transition: all 0.12s; cursor: pointer; text-decoration: none; border: 1px solid var(--border);
    color: #374151; background: white;
}
.filter-tab:hover { background: var(--bg-muted); }
.filter-tab.active { background: var(--primary); color: white; border-color: var(--primary); }

/* Avatar colors (Google Contacts style) */
.av { width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #fff; flex-shrink: 0; }
.av-a, .av-m, .av-x { background: #d50000; }
.av-b, .av-v { background: #e67c00; }
.av-c, .av-y { background: #f9a825; color: #333; }
.av-d, .av-w { background: #7cb342; }
.av-e, .av-q { background: #0b8043; }
.av-f { background: #009688; }
.av-g, .av-r { background: #039be5; }
.av-h, .av-s { background: #4285f4; }
.av-i, .av-t { background: #3949ab; }
.av-j, .av-z { background: #5e35b1; }
.av-k, .av-u { background: #8e24aa; }
.av-l { background: #d81b60; }
.av-n { background: #f4511e; }
.av-o { background: #f6bf26; color: #333; }
.av-p { background: #33b679; }

/* Modal */
.modal-overlay { background: rgba(0,0,0,0.3); backdrop-filter: blur(2px); }
.modal-content { border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.12); }

/* Section title */
.section-title { font-size: 14px; font-weight: 600; color: #111827; }
.section-icon { width: 18px; text-align: center; }

/* Separator */
.sep { height: 1px; background: var(--border); margin: 16px 0; }

/* Page header */
.page-head { margin-bottom: 24px; }
.page-head h1 { font-size: 20px; font-weight: 700; color: #111827; }
.page-head p { font-size: 13px; color: var(--text-muted); margin-top: 2px; }
</style>
@endpush

@section('content')
    @yield('hero')

    <div class="bg-[#f5f5f7] min-h-[600px]">
        <div class="max-w-[1440px] mx-auto px-6 py-8">
            <div class="flex gap-8">
                <!-- Sidebar -->
                <aside class="sidebar shrink-0 hidden lg:block">
                    <div>
                        <div class="side-section-title">Main</div>
                        <a href="{{ route('admin.dashboard') }}" class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.appointments') }}" class="side-link {{ request()->routeIs('admin.appointment*') || request()->routeIs('admin.appointments*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i> Appointments
                        </a>
                        <a href="{{ route('admin.books') }}" class="side-link {{ request()->routeIs('admin.book*') || request()->routeIs('admin.books*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i> Books
                        </a>
                        <a href="{{ route('admin.orders') }}" class="side-link {{ request()->routeIs('admin.order*') || request()->routeIs('admin.orders*') ? 'active' : '' }}">
                            <i class="fas fa-shopping-bag"></i> Orders
                        </a>
                        <div class="side-section-title">Configuration</div>
                        <a href="{{ route('admin.services') }}" class="side-link {{ request()->routeIs('admin.service*') || request()->routeIs('admin.services*') ? 'active' : '' }}">
                            <i class="fas fa-tag"></i> Services
                        </a>
                        <a href="{{ route('admin.time-slots') }}" class="side-link {{ request()->routeIs('admin.time-slot*') || request()->routeIs('admin.time-slots*') ? 'active' : '' }}">
                            <i class="fas fa-clock"></i> Time Slots
                        </a>
                        <a href="{{ route('admin.clients') }}" class="side-link {{ request()->routeIs('admin.client*') || request()->routeIs('admin.clients*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Clients
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
                    @yield('admin-content')
                </div>
            </div>
        </div>
    </div>
@endsection
