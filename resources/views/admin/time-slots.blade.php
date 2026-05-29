@extends('layouts.admin')

@section('title', 'Time Slots | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Time Slots</h1>
            <p class="text-white/70 text-sm mt-1">Manage available appointment times.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-purple-100 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 text-sm">Available Time Slots</h3>
                <p class="text-xs text-gray-400 mt-0.5">Configure when clients can book sessions</p>
            </div>
            <button onclick="openSlotModal()" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Slot</button>
        </div>
        @if($timeSlots->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-clock text-4xl mb-4"></i><p class="text-sm">No time slots configured.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Label</th><th>Days</th><th>Start</th><th>End</th><th>Status</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($timeSlots as $i => $slot)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $timeSlots->firstItem() + $i }}</td>
                            <td class="font-medium text-gray-900 text-sm">{{ $slot->label ?? '—' }}</td>
                            <td class="text-gray-500 text-sm">{{ $slot->day_label }}</td>
                            <td class="font-medium text-gray-700 text-sm">{{ $slot->start_formatted }}</td>
                            <td class="text-gray-500 text-sm">{{ $slot->end_formatted }}</td>
                            <td><span class="badge {{ $slot->is_active ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-600 border-gray-200' }}">{{ $slot->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td class="text-right">
                                <button onclick='openEditSlotModal({!! json_encode($slot) !!})' class="btn btn-ghost btn-xs"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('admin.time-slot.delete', $slot->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                    <button class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $timeSlots->links() }}</div>
        @endif
    </div>

    <div id="slotModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-6 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transition-all duration-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 id="slotModalTitle" class="font-semibold text-gray-900">Add Time Slot</h3>
                <button onclick="closeSlotModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times text-lg"></i></button>
            </div>
            <form id="slotForm" method="POST" class="p-6 space-y-5">@csrf <div id="slotMethodContainer"></div>
                <div><label class="input-label">Label</label><input type="text" id="sl_label" name="label" class="input" placeholder="e.g. Morning Slot 1"></div>
                <div><label class="input-label">Day of Week</label>
                    <select id="sl_day" name="day_of_week" class="input">
                        <option value="">All Days</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="0">Sunday</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="input-label">Start *</label><input type="time" id="sl_start" name="start_time" required class="input"></div>
                    <div><label class="input-label">End *</label><input type="time" id="sl_end" name="end_time" required class="input"></div>
                </div>
                <div class="flex items-center gap-2"><input type="checkbox" id="sl_active" name="is_active" value="1" checked class="rounded border-gray-300" style="color: #842988;"><label for="sl_active" class="text-sm text-gray-600">Active</label></div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeSlotModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium text-sm transition">Cancel</button>
                    <button type="submit" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function openSlotModal() {
    document.getElementById('slotModalTitle').textContent = 'Add Time Slot';
    document.getElementById('slotForm').action = '{{ route("admin.time-slot.store") }}';
    document.getElementById('slotMethodContainer').innerHTML = '';
    document.getElementById('sl_label').value = ''; document.getElementById('sl_day').value = '';
    document.getElementById('sl_start').value = '09:00'; document.getElementById('sl_end').value = '09:45';
    document.getElementById('sl_active').checked = true;
    document.getElementById('slotModal').classList.remove('hidden');
}
function openEditSlotModal(s) {
    document.getElementById('slotModalTitle').textContent = 'Edit Time Slot';
    document.getElementById('slotForm').action = '/admin/time-slots/' + s.id;
    document.getElementById('slotMethodContainer').innerHTML = '@method("PUT")';
    document.getElementById('sl_label').value = s.label || ''; document.getElementById('sl_day').value = s.day_of_week ?? '';
    document.getElementById('sl_start').value = s.start_time.substring(0,5); document.getElementById('sl_end').value = s.end_time.substring(0,5);
    document.getElementById('sl_active').checked = s.is_active;
    document.getElementById('slotModal').classList.remove('hidden');
}
function closeSlotModal() { document.getElementById('slotModal').classList.add('hidden'); }
</script>
@endpush
