<?php

/**
 * This controller manages the retrieval and display of posts and categories,
 * caching the categories for 3 days and showing posts with their details.
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retrieve categories from cache or database, filtering only those with published posts,
        // and cache the result for 3 days.
        $categories = Cache::remember('categories', now()->addDays(3), function () {
            return Category::whereHas('posts', function ($query) {
                $query->published();
            })->take(10)->get();
        });

        // Return the view for listing posts, passing the categories to the view.
        return view(
            'posts.index',
            [
                'categories' => $categories,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        return view(
            'posts.show',
            [
                'post' => $post,
            ]
        );
    }
}
