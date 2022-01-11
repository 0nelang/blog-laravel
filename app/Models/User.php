<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Contracts\Likeable;
use App\Models\Like;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
        {
            return $this->hasMany(Post::class);
        }
    
    public function getPostsCountAttribute(){
        return $this->posts()->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // public function like(Likeable $likeable): self
    // {
    //     if (! $this->hasLiked($likeable)) {
    //         return $this;
    //     }

    //     $likeable->likes()
    //         ->whereHas('user', fn($q) => $q->whereId($this->id))
    //         ->delete();

    //     return $this;
    // }

    // public function hasliked(Likeable $likeable): bool
    // {
    //     if (! $likeable->exists) {
    //         return false;
    //     }

    //     return $likeable->likes()
    //         ->whereHas('user', fn($q) => $q->whereId($this->id))
    //         ->exists();
    // }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'followed_id', 'id');
    }
    
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id', 'id');
    }

    // public function followers()
    // {
    //     return $this->hasMany(Follow::class, 'follower_id', 'id');
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
