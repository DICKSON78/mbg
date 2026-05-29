<section class="py-16 bg-gray-50 border-b border-gray-100">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <span class="text-xs font-semibold text-primary uppercase tracking-widest">Latest Post</span>
            <h2 class="text-3xl font-bold text-dark mt-2">Featured <span class="text-primary">Article</span></h2>
        </div>

        @if ($releases->isNotEmpty())
            <div class="space-y-6">
                @foreach ($releases as $release)
                    @php $releaseImg = $release->featured_image ?: ($featuredBook ? $featuredBook->cover_image : null); @endphp
                    <a href="{{ route('blog.show', $release->slug) }}" class="block bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover-scale transition-all">
                        <div class="flex flex-col lg:flex-row">
                            @if ($releaseImg)
                                <div class="lg:w-2/5 lg:order-2 flex items-center justify-center bg-gray-50 p-8">
                                    <img src="{{ asset($releaseImg) }}" alt="{{ $release->title }}" class="w-full max-w-[180px] max-h-56 object-contain rounded-xl">
                                </div>
                            @endif
                            <div class="p-8 lg:w-3/5 lg:order-1 flex flex-col justify-center">
                                @if ($release->category)
                                    <span class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">{{ $release->category }}</span>
                                @endif
                                <h3 class="text-2xl font-bold text-dark mb-3">{{ $release->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $release->excerpt ?? Str::limit(strip_tags($release->content), 200) }}</p>
                                <div class="flex items-center text-xs text-gray-400">
                                    @if ($release->author)
                                        <span class="font-medium text-gray-600 mr-3">{{ $release->author }}</span>
                                    @endif
                                    <span>{{ $release->published_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $releases->appends(request()->except('releases'))->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-book-open text-4xl mb-3 text-primary opacity-50"></i>
                <p class="text-gray-500">No new releases at this time.</p>
            </div>
        @endif
    </div>
</section>
