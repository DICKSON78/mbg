@extends('layouts.admin')

@section('title', 'Clients | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Clients</h1>
            <p class="text-white/70 text-sm mt-1">Directory of consultation clients.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-purple-100">
            <h3 class="font-semibold text-gray-900 text-sm">All Clients</h3>
            <p class="text-xs text-gray-400 mt-0.5">Unique clients registered through booking forms</p>
        </div>

        @if ($clients->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-users-slash text-4xl mb-4"></i><p class="text-sm">No clients found.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Client</th><th>Email</th><th>Phone</th><th>Appointments</th><th>Last Session</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $i => $c)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $clients->firstItem() + $i }}</td>
                            <td><div class="flex items-center gap-2"><span class="av av-{{ strtolower(substr($c->name, 0, 1)) }}">{{ strtoupper(substr($c->name, 0, 1)) }}</span><span class="font-medium text-gray-900 text-sm">{{ $c->name }}</span></div></td>
                            <td class="text-gray-500 text-sm">{{ $c->email }}</td>
                            <td class="text-gray-500 text-sm">{{ $c->phone }}</td>
                            <td><span class="badge bg-purple-50 text-[#842988] border-purple-200 font-medium">{{ $c->total_appointments }} session(s)</span></td>
                            <td class="text-gray-500 text-sm">{{ date('M d, Y', strtotime($c->last_appointment_date)) }}</td>
                            <td class="text-right"><a href="{{ route('admin.client.details', urlencode($c->email)) }}" class="btn btn-ghost btn-xs"><i class="fas fa-folder-open"></i> Profile</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $clients->links() }}</div>
        @endif
    </div>
@endsection
