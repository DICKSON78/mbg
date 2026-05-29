<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-dark">All <span class="text-primary">Articles</span></h2>
            <p class="text-gray-600 mt-2">Browse our latest posts and announcements</p>
            <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
        </div>

        @if ($posts->isNotEmpty())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover-scale transition-all flex flex-col">
                        @if ($post->featured_image)
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-primary flex items-center justify-center">
                                <i class="fas fa-newspaper text-5xl text-white/40"></i>
                            </div>
                        @endif
                        <div class="p-6 flex-1 flex flex-col">
                            @if ($post->category)
                                <span class="text-xs font-semibold text-primary uppercase tracking-wider mb-1">{{ $post->category }}</span>
                            @endif
                            <h3 class="text-lg font-bold text-dark mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-600 text-sm flex-1">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}</p>
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100 text-xs text-gray-400">
                                <span>{{ $post->published_at->format('M d, Y') }}</span>
                                <span class="text-primary font-medium">Read More &rarr;</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-newspaper text-4xl mb-3 text-primary opacity-50"></i>
                <p class="text-gray-500">No articles yet.</p>
            </div>
        @endif
    </div>
</section>
