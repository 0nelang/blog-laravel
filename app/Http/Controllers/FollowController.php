<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        Follow::create($request->all());
        $total_follower = Follow::where('followed_id', $request->followed_id)->count();
        user::where('id', $request->followed_id)
        ->Update(['follower'=> $total_follower]);
        return redirect()->back(); 
    }

    public function unfollow(User $user)
    {
        Follow::destroy($user->follows->where("follower_id", auth()->user()->id));
        return redirect()->back();
    }
}
