<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string|max:500',
            'category'       => 'nullable|string|max:100',
            'author'         => 'nullable|string|max:255',
            'status'         => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $name  = 'post-' . time() . '.' . $image->extension();
            $image->move(public_path('assets/img/posts'), $name);
            $validated['featured_image'] = 'assets/img/posts/' . $name;
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Post::create($validated);

        return redirect()->route('admin.posts')->with('success', 'Post created successfully.');
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string|max:500',
            'category'       => 'nullable|string|max:100',
            'author'         => 'nullable|string|max:255',
            'status'         => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image && file_exists(public_path($post->featured_image))) {
                @unlink(public_path($post->featured_image));
            }
            $image = $request->file('featured_image');
            $name  = 'post-' . time() . '.' . $image->extension();
            $image->move(public_path('assets/img/posts'), $name);
            $validated['featured_image'] = 'assets/img/posts/' . $name;
        }

        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image && file_exists(public_path($post->featured_image))) {
            @unlink(public_path($post->featured_image));
        }
        $post->delete();

        return redirect()->route('admin.posts')->with('success', 'Post deleted successfully.');
    }
}
