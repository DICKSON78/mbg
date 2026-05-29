@extends('layouts.admin')

@section('title', 'Appointments | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Appointments</h1>
            <p class="text-white/70 text-sm mt-1">Manage client bookings and sessions.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-purple-100">
            <h3 class="font-semibold text-gray-900 text-sm">All Appointments</h3>
            <p class="text-xs text-gray-400 mt-0.5">Filter by status below</p>
        </div>
        <div class="flex flex-wrap gap-2 px-5 py-3 border-b border-purple-100/50">
            <a href="{{ route('admin.appointments') }}" class="filter-tab {{ !$status ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.appointments', ['status' => 'pending']) }}" class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">Pending</a>
            <a href="{{ route('admin.appointments', ['status' => 'approved']) }}" class="filter-tab {{ $status == 'approved' ? 'active' : '' }}">Approved</a>
            <a href="{{ route('admin.appointments', ['status' => 'completed']) }}" class="filter-tab {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
            <a href="{{ route('admin.appointments', ['status' => 'declined']) }}" class="filter-tab {{ $status == 'declined' ? 'active' : '' }}">Declined</a>
        </div>
        @if ($appointments->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-calendar-times text-4xl mb-4"></i><p class="text-sm">No appointments found.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Client</th><th>Service</th><th>Date & Time</th><th>Status</th><th>Submitted</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $i => $a)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $appointments->firstItem() + $i }}</td>
                            <td><div class="flex items-center gap-2"><span class="av av-{{ strtolower(substr($a->name, 0, 1)) }}">{{ strtoupper(substr($a->name, 0, 1)) }}</span><div><div class="font-medium text-gray-900 text-sm">{{ $a->name }}</div><div class="text-xs text-gray-400">{{ $a->email }}</div></div></div></td>
                            <td class="text-gray-600 text-sm capitalize">{{ $a->service }}</td>
                            <td><div class="font-medium text-gray-900 text-sm">{{ $a->appointment_date->format('M d, Y') }}</div><div class="text-xs text-gray-400">{{ date('h:i A', strtotime($a->appointment_time)) }}</div></td>
                            <td>
                                <span class="badge {{ $a->status == 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($a->status == 'approved' ? 'bg-green-50 text-green-700 border-green-200' : ($a->status == 'declined' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-purple-50 text-purple-700 border-purple-200')) }}">{{ ucfirst($a->status) }}</span>
                            </td>
                            <td class="text-xs text-gray-400">{{ $a->created_at->format('M d, Y') }}</td>
                            <td class="text-right">
                                <button onclick='openEditModal({!! json_encode($a) !!})' class="btn btn-ghost btn-xs"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('admin.appointment.delete', $a->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                    <button class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $appointments->links() }}</div>
        @endif
    </div>

    <div id="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-6 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transition-all duration-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Update Appointment</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times text-lg"></i></button>
            </div>
            <form id="editForm" method="POST" class="p-6 space-y-5">@csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="input-label">Date</label><input type="date" id="modal_date" name="appointment_date" required class="input"></div>
                    <div><label class="input-label">Time</label><input type="time" id="modal_time" name="appointment_time" required class="input"></div>
                </div>
                <div><label class="input-label">Status</label><select id="modal_status" name="status" required class="input">
                    <option value="pending">Pending</option><option value="approved">Approved</option><option value="declined">Declined</option><option value="completed">Completed</option>
                </select></div>
                <div><label class="input-label">Notes</label><textarea id="modal_notes" name="notes" rows="3" class="input" placeholder="Session notes..."></textarea></div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium text-sm transition">Cancel</button>
                    <button type="submit" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function openEditModal(a) {
    document.getElementById('editForm').action = '/admin/appointments/' + a.id;
    document.getElementById('modal_date').value = new Date(a.appointment_date).toISOString().split('T')[0];
    document.getElementById('modal_time').value = a.appointment_time.substring(0, 5);
    document.getElementById('modal_status').value = a.status;
    document.getElementById('modal_notes').value = a.notes || '';
    document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }
</script>
@endpush
