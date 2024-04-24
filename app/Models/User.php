<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Model representing users in the application, extending Laravel's Authenticatable.
 * Provides functionalities for user roles, access control, and relationships with posts and comments.
 */
class User extends Authenticatable implements FilamentUser
{
    /**
     * This line declares the User class, extending Laravel's Authenticatable class
     * and implementing the FilamentUser contract.
     */
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /*  These lines apply various traits to the User class,
        providing additional functionality such as API token management,
        factory support, profile photo handling, notification capabilities,
        and two-factor authentication. */

    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_EDITOR = 'EDITOR';
    public const ROLE_USER = 'USER';
    public const ROLE_DEFAULT = self::ROLE_USER;

    // These lines define constants for different user roles, with 'USER' being the default role.
    public const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_EDITOR => 'Editor',
        self::ROLE_USER => 'User',
    ];

    // This line defines an array mapping user role constants to human-readable labels.
    public function canAccessPanel(Panel $panel): bool
    {
        // This line declares a method that checks if the user can access a specific administrative panel.
        return $this->can('view-admin', User::class);
    }

    // This line checks the user's permissions using Laravel's authorization system.
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // This line checks the user's permissions using Laravel's authorization system.
    public function isEditor()
    {
        return $this->role === self::ROLE_EDITOR;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
