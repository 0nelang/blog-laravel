<?php

namespace App\Models;

use Auth;
use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model implements Likeable
{
    use HasFactory, Sluggable, Likes;

    protected $guarded = ['id'];


        // public function scopeFilter($query, array $filters)
        // {
            

        //     $query->when($filters['search'] ?? false, function($query, $search) {
        //         return $query->where('title', 'like', '%' . $search . '%');
        //     });

        //     $query->when($filters['category'] ?? false, function($query, $category) {
        //         return $query->whereHas('category', function($query) use ($category){
        //             $query->where('slug', $category);
        //         });
        //     });

        //     $query->when($filters['user'] ?? false, function($query, $user) {
        //         return $query->whereHas('user', function($query) use ($user){
        //             $query->where('username', $user);
        //         });
        //     });
        // }
    
        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        public function tags()
        {
            return $this->hasMany(Post_tag::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }
        
        
        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }

        public function getRouteKeyName()
        {
            return 'slug';
        }

        public function likes()
        {
            return $this->morphMany('App\Models\Like', 'likeable');
        }

        public function comments()
        {
            return $this->morphMany('App\Models\Comment', 'commentable');
        }

        // function isLiked(){
        //     $id = auth()->user()->id;
        
        //     foreach ($this->$likes as $like):

        //         array_push($liked, $like->user_id);
            
        //     endforeach;

        //     if (is_array($id, $liked)){
        //         return true;
        //     }

        //     die;
            
        // }

}
