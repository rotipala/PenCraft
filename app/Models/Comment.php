<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* This model represents a comment in the application. It extends the Eloquent Model class
and defines the relationships with the User and Post models. It allows for storing user ID,
post ID, and the comment content, facilitating operations such as retrieving user and post
information associated with the comment. */

class Comment extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable.
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    // Define the relationship with the User model.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Post model.
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
