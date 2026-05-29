<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Book;

class BlogController extends Controller
{
    public function index()
    {
        $releases = Post::published()
            ->where('category', 'Book Release')
            ->orderBy('published_at', 'desc')
            ->paginate(2, ['*'], 'releases');

        $excludeIds = $releases->pluck('id')->toArray();

        $posts = Post::published()
            ->whereNotIn('id', $excludeIds)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $featuredBook = Book::where('status', 'active')->first();

        if (request()->ajax() && request()->filled('section')) {
            $section = request('section');
            if ($section === 'releases') {
                return view('blog.partials._releases', compact('releases', 'featuredBook'));
            }
            if ($section === 'articles') {
                return view('blog.partials._articles', compact('posts'));
            }
        }

        return view('blog.index', compact('releases', 'posts', 'featuredBook'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $recent = Post::published()
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $relatedBook = null;
        if ($post->category === 'Book Release') {
            $relatedBook = Book::where('status', 'active')->first();
        }

        return view('blog.show', compact('post', 'recent', 'relatedBook'));
    }
}
