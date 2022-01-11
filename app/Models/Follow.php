<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['followed_id', 'follower_id'];

    public function follower()
    {
        return $this->belongsTo(user::class, 'follower_id', 'id');
    }   
    
    public function following()
    {
        return $this->belongsTo(user::class, 'followed_id', 'id');
    }   

}
