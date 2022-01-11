<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Like;
use \App\Models\Post;
use \App\Models\Follow;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.dashboard.user.home', [
            'posts' => Like::where([
                ['user_id', auth()->user()->id],
                ['likeable_type', 'App\Models\Post']
            ])->get()
        ]);
    }
    
    public function following()
    {
        return view('auth.dashboard.user.following', [
            'following' => Follow::where('follower_id', auth()->user()->id)->get()
        ]);
    }

    public function edit(User $user)
    {
        return view('auth.dashboard.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'image' => 'image|file|max:1024',
            'name' => 'required|max:25'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('user-image');
        }

        user::where('id', $user->id)
        ->update($validated);

         return redirect('/dashboard/user');
    }
}
