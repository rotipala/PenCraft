<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model representing categories with title, slug, text color, and background color fields.
class Category extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment.
    protected $fillable = [
        'title',
        'slug',
        'text_color',
        'bg_color',
    ];

    // Define relationship with posts through a many-to-many association.
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
