<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        Like::create($request->all());
        // $total_like = Like::where('post_id', $request->post_id)->count();
        // Post::where('id', $request->post_id)
        // ->Update(['like'=> $total_like]);
        return redirect()->back(); 
    }

    public function unlike(Post $post)
    {     
        Like::destroy($post->likes->where('user_id', auth()->user()->id));
        // $total_like = Like::where('post_id', $post->id)->count();
        // Post::where('id', $post->id)
        // ->Update(['like'=> $total_like]);
        return redirect()->back();
    }

    public function likeComment(Request $request)
    {
        Like::create($request->all());
        // $total_like = Like::where('post_id', $request->post_id)->count();
        // Post::where('id', $request->post_id)
        // ->Update(['like'=> $total_like]);
        return redirect()->back(); 
    }

    public function unlikeComment(Comment $comment)
    {     
        Like::destroy($comment->likes->where('user_id', auth()->user()->id));
        // $total_like = Like::where('post_id', $post->id)->count();
        // Post::where('id', $post->id)
        // ->Update(['like'=> $total_like]);
        return redirect()->back();
    }
}
