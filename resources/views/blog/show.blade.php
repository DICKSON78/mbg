@extends('layouts.app')

@section('title', $post->title . ' | MBG Wellness Blog')

@section('content')
    <!-- Post Hero -->
    <section class="pt-32 pb-16 md:pt-40 md:pb-20 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center text-yellow-300 hover:text-yellow-200 text-sm font-semibold mb-4">
                <i class="fas fa-arrow-left mr-2"></i> Back to Blog
            </a>
            @if ($post->category)
                <span class="inline-block text-xs font-semibold bg-white/20 text-white px-3 py-1 rounded-full mb-3">{{ $post->category }}</span>
            @endif
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">{{ $post->title }}</h1>
            <div class="flex items-center text-white/70 text-sm mt-4 gap-4">
                @if ($post->author)
                    <span><i class="fas fa-user mr-1"></i> {{ $post->author }}</span>
                @endif
                <span><i class="fas fa-calendar mr-1"></i> {{ $post->published_at->format('F d, Y') }}</span>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                @if ($relatedBook)
                    <!-- Book Showcase Card -->
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden mb-10">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-2/5 p-6 flex items-center justify-center bg-white">
                                <div class="relative">
                                    @if ($post->featured_image)
                                        <img src="{{ asset($post->featured_image) }}" alt="{{ $relatedBook->title }}" class="rounded-xl shadow-lg w-full max-w-xs mx-auto">
                                    @elseif ($relatedBook->cover_image)
                                        <img src="{{ asset($relatedBook->cover_image) }}" alt="{{ $relatedBook->title }}" class="rounded-xl shadow-lg w-full max-w-xs mx-auto">
                                    @else
                                        <div class="w-full max-w-xs mx-auto aspect-[3/4] bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border">
                                            <i class="fas fa-book-open text-5xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute -bottom-3 -right-3 bg-primary text-white px-4 py-2 rounded-xl shadow-md">
                                        <p class="text-sm font-bold">{{ $relatedBook->currency }} {{ number_format($relatedBook->price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-3/5 p-6 md:p-8 flex flex-col justify-center">
                                <span class="text-xs font-semibold text-primary uppercase tracking-wider">Book Release</span>
                                <h2 class="text-2xl font-bold text-dark mt-1 mb-2">{{ $relatedBook->title }}</h2>
                                <p class="text-sm text-gray-500 mb-4">Written by {{ $relatedBook->author }}</p>

                                <div class="bg-white p-4 rounded-xl border border-purple-100 mb-5">
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $relatedBook->description }}</p>
                                </div>

                                <div class="flex flex-wrap gap-3">
                                    <button onclick='openPreorderModal({{ json_encode($relatedBook) }})'
                                            class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-full font-semibold text-sm transition-all shadow-md hover:shadow-lg inline-flex items-center gap-2">
                                        <i class="fas fa-cart-plus"></i> Pre-order Now
                                    </button>
                                    @if ($relatedBook->purchase_url)
                                        <a href="{{ $relatedBook->purchase_url }}" target="_blank" class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-6 py-2.5 rounded-full font-semibold text-sm transition-all inline-flex items-center gap-2">
                                            <i class="fas fa-external-link-alt"></i> View on Amazon
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($post->featured_image && !$relatedBook)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow-lg mb-10">
                @endif

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Share -->
    <section class="pb-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="pt-8 border-t border-gray-100">
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-semibold text-gray-600">Share this post:</span>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('blog.show', $post->slug)) }}" target="_blank" class="w-9 h-9 rounded-full bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-100 transition"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title . ' ' . route('blog.show', $post->slug)) }}" target="_blank" class="w-9 h-9 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center hover:bg-sky-100 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Posts -->
    @if ($recent->isNotEmpty())
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold text-dark">Recent <span class="text-primary">Posts</span></h2>
                    <div class="w-16 h-1 bg-secondary mx-auto mt-3"></div>
                </div>
                <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    @foreach ($recent as $r)
                        <a href="{{ route('blog.show', $r->slug) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover-scale transition-all">
                            @if ($r->featured_image)
                                <img src="{{ asset($r->featured_image) }}" alt="{{ $r->title }}" class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-primary flex items-center justify-center">
                                    <i class="fas fa-newspaper text-4xl text-white/40"></i>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold text-dark text-sm">{{ $r->title }}</h3>
                                <p class="text-xs text-gray-400 mt-1">{{ $r->published_at->format('M d, Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center text-primary font-semibold text-sm hover:underline">
                        View All Posts <i class="fas fa-arrow-right ml-1.5"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif
@endsection
