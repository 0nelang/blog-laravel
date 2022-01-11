<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        Comment::create($request->all());
        return redirect()->back();
    }

    public function reply(Request $request)
    {
        Comment::create($request->all());
        return redirect()->back();
    }

    public function delete(Comment $comment)
    {
        if ($comment->commentable_type == 'App\Models\Post') {
            Comment::where([
                ["commentable_type", "App\Models\Comment"],
                ['commentable_id', $comment->id]
            ])->delete();
        }

        Comment::destroy($comment->id);
        return redirect()->back();
    }

    public function edit(Request $request, Comment $comment)
    {
        Comment::where('id', $comment->id)->update(['text' => $request->text]);

        return redirect()->back();
    }

}
