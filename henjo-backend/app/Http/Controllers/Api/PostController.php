<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Get all blog posts with pagination
     */
    public function index(Request $request)
    {
        $query = Post::with(['tags', 'author'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc');

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        $posts = $query->paginate(9);

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    /**
     * Get a single blog post by slug
     */
    public function show($slug)
    {
        $post = Post::with(['tags', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // Increment view count
        // $post->increment('views');

        // Get related posts (same tags)
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('status', 'published')
            ->whereHas('tags', function ($q) use ($post) {
                $q->whereIn('id', $post->tags->pluck('id'));
            })
            ->limit(3)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'post' => $post,
                'related' => $relatedPosts
            ]
        ]);
    }

    /**
     * Get featured blog posts for homepage
     */
    public function featured()
    {
        $posts = Post::with(['tags', 'author'])
            ->where('status', 'published')
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    /**
     * Get all tags
     */
    public function tags()
    {
        $tags = Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tags
        ]);
    }

    /**
     * Get posts by tag
     */
    public function postsByTag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        if (!$tag) {
            return response()->json([
                'success' => false,
                'message' => 'Tag not found'
            ], 404);
        }

        $posts = Post::with(['tags', 'author'])
            ->where('status', 'published')
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('id', $tag->id);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return response()->json([
            'success' => true,
            'data' => [
                'tag' => $tag,
                'posts' => $posts
            ]
        ]);
    }
}
