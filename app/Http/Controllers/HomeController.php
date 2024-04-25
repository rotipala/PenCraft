<?php

// Controller for handling the home page request.
// Retrieves and caches featured and latest posts, then renders the home view.

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Retrieve featured posts from cache or database
        $featuredPosts = Cache::remember('featuredPosts', now()->addDay(), function () {
            return Post::published()->featured()->with('categories')->latest('published_at')->take(3)->get();
        });

        // Retrieve latest posts from cache or database
        $latestPosts = Cache::remember('latestPosts', now()->addDay(), function () {
            return Post::published()->with('categories')->latest('published_at')->take(9)->get();
        });

        // Render the home view with retrieved posts
        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
