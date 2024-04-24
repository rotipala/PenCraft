<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Model representing a blog post with methods for accessing related data,
 * filtering posts, and generating post excerpts, reading time, and thumbnail URLs.
 */
class Post extends Model
{
    /* These lines apply the HasFactory
    and SoftDeletes traits to the Post model,
    enabling factory support and soft deletes respectively. */
    use HasFactory;
    use SoftDeletes;

    // This property specifies which attributes can be mass-assigned when creating or updating a Post instance.
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured',
    ];

    // This property specifies attribute casting, ensuring the published_at attribute is treated as a datetime.
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /* This method defines a relationship between the Post model and the User model,
    indicating that a post belongs to a user. */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* This method defines a many-to-many relationship between the Post model
    and the Category model, indicating that a post can belong to multiple categories. */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /* This method defines a one-to-many relationship between the Post model
    and the Comment model, indicating that a post can have multiple comments. */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* This method defines a many-to-many relationship between the Post model
    and the User model for post likes, with timestamps. */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    // This method defines a query scope for retrieving only published posts.
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    // This method defines a query scope for retrieving posts with a specific category.
    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    // This method defines a query scope for retrieving featured posts.
    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    // This method defines a query scope for retrieving popular posts based on the number of likes.
    public function scopePopular($query)
    {
        $query->withCount('likes')
            ->orderBy('likes_count', 'desc');
    }

    // This method defines a query scope for searching posts by title.
    public function scopeSearch($query, string $search = '')
    {
        $query->where('title', 'like', "%{$search}%");
    }

    // This method generates an excerpt for the post by stripping HTML tags and limiting the text to 150 characters.
    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }

    // This method calculates the estimated reading time for the post based on the word count, assuming 250 words per minute.
    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) / 250);

        return ($mins < 1) ? 1 : $mins;
    }

    // This method retrieves the URL for the post's thumbnail image, either from an external URL or from local storage.
    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->image, 'http');

        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);
    }
}
