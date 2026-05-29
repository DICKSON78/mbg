@extends('layouts.app')

@section('title', 'Blog | MBG Wellness')

@section('content')
    <!-- Blog Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Our <span class="text-gradient">Blog</span></h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Insights, updates, and new book releases from MBG Wellness</p>
            </div>
        </div>
    </section>

    @if ($releases->isEmpty() && $posts->isEmpty())
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-6 text-center">
                <div class="max-w-lg mx-auto py-16 text-gray-400 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <i class="fas fa-newspaper text-5xl mb-4 text-primary opacity-50"></i>
                    <p class="text-lg font-semibold text-gray-700">No posts yet</p>
                    <p class="text-sm text-gray-500 mt-1">Check back soon for updates and new releases.</p>
                </div>
            </div>
        </section>
    @else
        <!-- New Releases -->
        @if ($releases->isNotEmpty())
            <div data-section="releases">
                @include('blog.partials._releases')
            </div>
        @endif

        <!-- All Articles -->
        @if ($posts->isNotEmpty())
            <div data-section="articles">
                @include('blog.partials._articles')
            </div>
        @endif
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('click', function(e) {
    const link = e.target.closest('[data-section] a.pjax-link');
    if (!link) return;

    const section = link.closest('[data-section]');
    if (!section) return;

    const sectionName = section.dataset.section;
    const url = new URL(link.href);

    if (url.pathname !== window.location.pathname) return;
    if (url.hostname !== window.location.hostname) return;

    e.preventDefault();

    url.searchParams.set('section', sectionName);

    section.style.opacity = '0.4';
    section.style.transition = 'opacity 0.2s ease';

    fetch(url.toString(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => {
        if (!r.ok) throw new Error('Network error');
        return r.text();
    })
    .then(html => {
        section.innerHTML = html;
        section.style.opacity = '1';
        window.history.pushState({}, '', link.href);
    })
    .catch(() => {
        section.style.opacity = '1';
        window.location.href = link.href;
    });
});

window.addEventListener('popstate', function() {
    window.location.reload();
});
</script>
@endpush
