<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

    protected $fillable = ['likeable_id', 'likeable_type', 'user_id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    
    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    public function likeable()
    {
        return $this->morphTo();
    }
}
