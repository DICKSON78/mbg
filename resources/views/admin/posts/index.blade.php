@extends('layouts.admin')

@section('title', 'Blog Posts | MBG Wellness')

@section('hero')
    <section class="pt-28 pb-10 relative overflow-hidden" style="background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);">
        <div class="max-w-[1440px] mx-auto px-6 relative z-10">
            <span class="text-xs font-semibold text-yellow-300 uppercase tracking-widest">Admin Workspace</span>
            <h1 class="text-3xl font-bold text-white mt-1">Blog Posts</h1>
            <p class="text-white/70 text-sm mt-1">Manage blog articles and announcements.</p>
        </div>
    </section>
@endsection

@section('admin-content')
    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-purple-100 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 text-sm">All Posts</h3>
                <p class="text-xs text-gray-400 mt-0.5">Blog articles, announcements, and new book releases</p>
            </div>
            <button onclick="openPostModal()" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New Post</button>
        </div>

        @if ($posts->isEmpty())
            <div class="text-center py-16 text-gray-400"><i class="fas fa-newspaper text-4xl mb-4"></i><p class="text-sm">No posts yet. Create your first one!</p></div>
        @else
            <div class="overflow-x-auto">
                <table class="tbl-shadcn">
                    <thead>
                        <tr><th class="w-10 text-center">#</th><th>Title</th><th>Category</th><th>Status</th><th>Published</th><th class="text-right">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $i => $p)
                        <tr>
                            <td class="text-center text-gray-400 text-xs">{{ $posts->firstItem() + $i }}</td>
                            <td>
                                <div class="font-medium text-gray-900 text-sm">{{ $p->title }}</div>
                                <div class="text-xs text-gray-400">{{ Str::limit(strip_tags($p->excerpt ?? $p->content), 80) }}</div>
                            </td>
                            <td><span class="text-xs text-gray-500">{{ $p->category ?? '—' }}</span></td>
                            <td>
                                <span class="badge {{ $p->status === 'published' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="text-xs text-gray-400">{{ $p->published_at ? $p->published_at->format('M d, Y') : '—' }}</td>
                            <td class="text-right">
                                <button onclick='openPostModal(@json($p))' class="btn btn-ghost btn-xs"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('admin.posts.delete', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete this post?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-purple-100">{{ $posts->links() }}</div>
        @endif
    </div>

    <!-- Post Modal -->
    <div id="postModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-6 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden transition-all duration-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900" id="postModalTitle">New Post</h3>
                <button onclick="closePostModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times text-lg"></i></button>
            </div>
            <form id="postForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" id="postMethod" name="_method" value="POST">

                <div>
                    <label class="input-label">Title*</label>
                    <input type="text" name="title" id="postTitle" required class="input">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="input-label">Category</label>
                        <input type="text" name="category" id="postCategory" class="input" placeholder="e.g. Book Release, News">
                    </div>
                    <div>
                        <label class="input-label">Author</label>
                        <input type="text" name="author" id="postAuthor" class="input" placeholder="Dr. Susan O. Bamidele">
                    </div>
                </div>

                <div>
                    <label class="input-label">Excerpt</label>
                    <textarea name="excerpt" id="postExcerpt" rows="2" class="input" placeholder="Brief summary..."></textarea>
                </div>

                <div>
                    <label class="input-label">Content*</label>
                    <textarea name="content" id="postContent" rows="8" required class="input" placeholder="Write your post content here..."></textarea>
                </div>

                <div>
                    <label class="input-label">Featured Image</label>
                    <input type="file" name="featured_image" id="postImage" accept="image/*" class="input">
                    <p class="text-xs text-gray-400 mt-1">Max 2MB. JPEG, PNG, WebP.</p>
                </div>

                <div>
                    <label class="input-label">Status*</label>
                    <select name="status" id="postStatus" required class="input">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closePostModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium text-sm transition">Cancel</button>
                    <button type="submit" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">Save Post</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const postModal = document.getElementById('postModal');
        const postForm = document.getElementById('postForm');
        const postMethod = document.getElementById('postMethod');
        const postTitle = document.getElementById('postModalTitle');

        function openPostModal(post = null) {
            if (post) {
                postTitle.textContent = 'Edit Post';
                postForm.action = '{{ url("admin/posts") }}/' + post.id;
                postMethod.value = 'PUT';
                document.getElementById('postTitle').value = post.title;
                document.getElementById('postCategory').value = post.category || '';
                document.getElementById('postAuthor').value = post.author || '';
                document.getElementById('postExcerpt').value = post.excerpt || '';
                document.getElementById('postContent').value = post.content;
                document.getElementById('postStatus').value = post.status;
            } else {
                postTitle.textContent = 'New Post';
                postForm.action = '{{ route("admin.posts.store") }}';
                postMethod.value = 'POST';
                postForm.reset();
                document.getElementById('postStatus').value = 'draft';
            }
            postModal.classList.remove('hidden');
        }

        function closePostModal() {
            postModal.classList.add('hidden');
        }
    </script>
@endsection
