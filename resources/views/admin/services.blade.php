@extends('layouts.admin')

@section('title', 'Services | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Services</h1>
            <p class="text-white/70 text-sm mt-1">Manage consultation services and pricing.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h1 class="text-lg font-bold text-gray-900">Consultation Services</h1>
            <p class="text-sm text-gray-500 mt-0.5">Configure services, durations, and pricing</p>
        </div>
        <button onclick="openServiceModal()" class="btn btn-primary"><i class="fas fa-plus"></i> Add Service</button>
    </div>

    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        @if($services->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-concierge-bell text-4xl mb-4"></i><p class="text-sm">No services configured.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Service</th><th>Duration</th><th>Price</th><th>Status</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($services as $i => $svc)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $services->firstItem() + $i }}</td>
                            <td><div class="font-medium text-gray-900 text-sm">{{ $svc->name }}</div><div class="text-xs text-gray-400">{{ $svc->slug }}</div>@if($svc->description)<div class="text-xs text-gray-400 mt-0.5 max-w-xs truncate">{{ $svc->description }}</div>@endif</td>
                            <td class="text-gray-500 text-sm">{{ $svc->duration_minutes }} min</td>
                            <td class="font-semibold text-gray-900 text-sm">{{ $svc->currency }} {{ number_format($svc->price, 2) }}</td>
                            <td><span class="badge {{ $svc->is_active ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-600 border-gray-200' }}">{{ $svc->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td class="text-right">
                                <button onclick='openEditServiceModal({!! json_encode($svc) !!})' class="btn btn-ghost btn-xs"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('admin.service.delete', $svc->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                    <button class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $services->links() }}</div>
        @endif
    </div>

    <div id="serviceModal" class="fixed inset-0 z-50 modal-overlay flex items-center justify-center p-6 hidden">
        <div class="bg-white modal-content w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 id="serviceModalTitle" class="font-semibold text-gray-900">Add Service</h3>
                <button onclick="closeServiceModal()" class="btn btn-ghost btn-icon"><i class="fas fa-times"></i></button>
            </div>
            <form id="serviceForm" method="POST" class="p-6 space-y-5">@csrf <div id="serviceMethodContainer"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="input-label">Name *</label><input type="text" id="s_name" name="name" required class="input" oninput="document.getElementById('s_slug').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')"></div>
                    <div><label class="input-label">Slug *</label><input type="text" id="s_slug" name="slug" required class="input"></div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="input-label">Price *</label><input type="number" id="s_price" name="price" step="0.01" min="0" required class="input"></div>
                    <div><label class="input-label">Currency</label><select id="s_currency" name="currency" required class="input"><option value="USD">USD</option><option value="TZS">TZS</option><option value="QAR">QAR</option></select></div>
                    <div><label class="input-label">Duration *</label><input type="number" id="s_duration" name="duration_minutes" value="45" min="15" max="240" required class="input"></div>
                </div>
                <div><label class="input-label">Description</label><textarea id="s_description" name="description" rows="3" class="input"></textarea></div>
                <div class="flex items-center gap-2"><input type="checkbox" id="s_active" name="is_active" value="1" checked class="rounded border-gray-300" style="color: #842988;"><label for="s_active" class="text-sm text-gray-600">Active</label></div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeServiceModal()" class="btn btn-outline">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function openServiceModal() {
    document.getElementById('serviceModalTitle').textContent = 'Add Service';
    document.getElementById('serviceForm').action = '{{ route("admin.service.store") }}';
    document.getElementById('serviceMethodContainer').innerHTML = '';
    ['s_name','s_slug','s_price','s_description'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('s_currency').value = 'USD'; document.getElementById('s_duration').value = '45'; document.getElementById('s_active').checked = true;
    document.getElementById('serviceModal').classList.remove('hidden');
}
function openEditServiceModal(s) {
    document.getElementById('serviceModalTitle').textContent = 'Edit Service';
    document.getElementById('serviceForm').action = '/admin/services/' + s.id;
    document.getElementById('serviceMethodContainer').innerHTML = '@method("PUT")';
    document.getElementById('s_name').value = s.name; document.getElementById('s_slug').value = s.slug; document.getElementById('s_price').value = s.price;
    document.getElementById('s_currency').value = s.currency; document.getElementById('s_duration').value = s.duration_minutes;
    document.getElementById('s_description').value = s.description || ''; document.getElementById('s_active').checked = s.is_active;
    document.getElementById('serviceModal').classList.remove('hidden');
}
function closeServiceModal() { document.getElementById('serviceModal').classList.add('hidden'); }
</script>
@endpush
