@extends('layouts.admin')

@section('title', 'Books | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Books</h1>
            <p class="text-white/70 text-sm mt-1">Manage your book catalog.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h1 class="text-lg font-bold text-gray-900">All Books</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $books->total() }} book(s) in catalog</p>
        </div>
        <button onclick="openBookModal()" class="btn btn-primary"><i class="fas fa-plus"></i> Add Book</button>
    </div>

    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        @if ($books->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-book-open text-4xl mb-4"></i><p class="text-sm">No books yet.</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th class="w-14">Cover</th><th>Title & Author</th><th>Price</th><th>Type</th><th>Status</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $i => $b)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $books->firstItem() + $i }}</td>
                            <td>
                                @if ($b->cover_image)
                                    <img src="{{ asset($b->cover_image) }}" alt="" class="h-11 w-8 object-cover rounded border border-gray-100">
                                @else
                                    <div class="h-11 w-8 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-gray-300"><i class="fas fa-image text-xs"></i></div>
                                @endif
                            </td>
                            <td><div class="font-medium text-gray-900 text-sm">{{ $b->title }}</div><div class="text-xs text-gray-400">By {{ $b->author }}</div></td>
                            <td class="font-semibold text-gray-900 text-sm">{{ $b->currency }} {{ number_format($b->price, 2) }}</td>
                            <td><span class="badge {{ $b->status == 'active' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-600 border-gray-200' }}">{{ ucfirst($b->status) }}</span></td>
                            <td class="text-right">
                                <button onclick='openEditBookModal({!! json_encode($b) !!})' class="btn btn-ghost btn-xs"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('admin.book.delete', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this book?')">@csrf @method('DELETE')
                                    <button class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $books->links() }}</div>
        @endif
    </div>

    <!-- Book Modal (Add / Edit) -->
    <div id="bookModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-6 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all duration-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 id="bookModalTitle" class="font-bold text-lg text-gray-900">Add Book</h3>
                <button onclick="closeBookModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <form id="bookForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <div id="bookMethodContainer"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="input-label">Title *</label>
                        <input type="text" id="b_title" name="title" required class="input" placeholder="Book title">
                    </div>
                    <div>
                        <label class="input-label">Author *</label>
                        <input type="text" id="b_author" name="author" required class="input" placeholder="Dr. Susan O. Bamidele">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="input-label">Price *</label>
                        <input type="number" id="b_price" name="price" step="0.01" min="0" required class="input">
                    </div>
                    <div>
                        <label class="input-label">Currency *</label>
                        <select id="b_currency" name="currency" required class="input">
                            <option value="USD">USD ($)</option>
                            <option value="TZS">TZS (Tsh)</option>
                            <option value="QAR">QAR (QR)</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="input-label">Description</label>
                    <textarea id="b_description" name="description" rows="3" class="input" placeholder="Brief overview..."></textarea>
                </div>
                <div>
                    <label class="input-label">Cover Image (max 2MB)</label>
                    <div id="b_cover_zone" class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-primary hover:bg-purple-50/30 transition" onclick="document.getElementById('b_cover').click()">
                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-500">Drag & drop or <span class="text-primary font-semibold">browse</span></p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP (max 2MB)</p>
                        <input type="file" id="b_cover" name="cover_image" accept="image/*" class="hidden" onchange="previewCover(this)">
                        <img id="b_cover_preview" class="hidden mt-3 mx-auto max-h-32 rounded shadow-sm object-contain">
                    </div>
                    <p id="b_cover_hint" class="text-xs text-gray-400 mt-1 hidden">Leave blank to keep existing.</p>
                </div>
                <div class="flex items-center gap-5">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" id="b_advert" name="is_advertisement" value="1" class="rounded border-gray-300" style="color: #842988;">
                        <span class="text-sm text-gray-600">Feature on banner</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Status:</span>
                        <select id="b_status" name="status" class="input w-auto px-2.5 py-1 text-xs">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </label>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeBookModal()" class="btn btn-outline">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Book</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function openBookModal() {
    document.getElementById('bookModalTitle').textContent = 'Add Book';
    document.getElementById('bookForm').action = '{{ route("admin.book.store") }}';
    document.getElementById('bookMethodContainer').innerHTML = '';
    document.getElementById('b_title').value = '';
    document.getElementById('b_author').value = 'Dr. Susan O. Bamidele';
    document.getElementById('b_price').value = '';
    document.getElementById('b_currency').value = 'USD';
    document.getElementById('b_description').value = '';
    document.getElementById('b_cover').value = '';
    document.getElementById('b_cover_hint').classList.add('hidden');
    document.getElementById('b_advert').checked = false;
    document.getElementById('b_status').value = 'active';
    document.getElementById('bookModal').classList.remove('hidden');
}

function openEditBookModal(b) {
    document.getElementById('bookModalTitle').textContent = 'Edit Book';
    document.getElementById('bookForm').action = '/admin/books/' + b.id;
    document.getElementById('bookMethodContainer').innerHTML = '@method("PUT")';
    document.getElementById('b_title').value = b.title;
    document.getElementById('b_author').value = b.author;
    document.getElementById('b_price').value = b.price;
    document.getElementById('b_currency').value = b.currency;
    document.getElementById('b_description').value = b.description || '';
    document.getElementById('b_cover').value = '';
    document.getElementById('b_cover_hint').classList.remove('hidden');
    document.getElementById('b_advert').checked = b.is_advertisement;
    document.getElementById('b_status').value = b.status || 'active';
    document.getElementById('bookModal').classList.remove('hidden');
}

function closeBookModal() {
    document.getElementById('bookModal').classList.add('hidden');
    resetCoverUpload();
}

function previewCover(input) {
    const preview = document.getElementById('b_cover_preview');
    const zone = document.getElementById('b_cover_zone');
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            zone.querySelector('.fa-cloud-upload-alt').classList.add('hidden');
            zone.querySelectorAll('p').forEach(p => p.classList.add('hidden'));
        };
        reader.readAsDataURL(file);
    }
}

function resetCoverUpload() {
    const preview = document.getElementById('b_cover_preview');
    const zone = document.getElementById('b_cover_zone');
    document.getElementById('b_cover').value = '';
    preview.classList.add('hidden');
    preview.src = '';
    zone.querySelector('.fa-cloud-upload-alt').classList.remove('hidden');
    zone.querySelectorAll('p').forEach(p => p.classList.remove('hidden'));
}

// Drag & drop support
document.addEventListener('DOMContentLoaded', function() {
    const zone = document.getElementById('b_cover_zone');
    if (!zone) return;
    zone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-primary', 'bg-purple-50/50');
    });
    zone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-primary', 'bg-purple-50/50');
    });
    zone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-primary', 'bg-purple-50/50');
        const files = e.dataTransfer.files;
        if (files.length) {
            document.getElementById('b_cover').files = files;
            previewCover(document.getElementById('b_cover'));
        }
    });
});
</script>
@endpush