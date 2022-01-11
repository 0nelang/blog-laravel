<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\Category;
use \App\Models\User;
use \App\Models\Like;
use \App\Models\Follow;


class PostController extends Controller
{
    public function index()
    {
        $top_posts = Post::orderBy('like', 'desc')->take(10)->get();
        $categories = Category::all();
        $data_category = [];
        foreach ($categories as $category) {
            $data_category[$category->category] = Post::orderBy('like', 'desc')->where('category_id', $category->id)->take(10)->get();
        }

        return view('featured', [
            'title' => 'Home',
            // 'posts' => Post::all()
            'posts' => Post::With(['user', 'category'])->paginate(5),
            'top_posts' => $top_posts,
            'data_category' => $data_category
        ]);
    }

    public function search(Request $request){
        $posts = Post::orderBy('like', 'desc');
        if (request('query')) {
            $key = request('query');
            $posts = $posts->where('title', 'LIKE', '%' .$key. '%')->with('user', 'category');
            $user = User::where('name', 'LIKE', '%' .$key. '%');

            return view('search', [
                'posts' => $posts->paginate(7, $columns = ["*"], $pageName = "pagepost"),
                'users' => $user->paginate(7, $columns = ["*"], $pageName = "pageuser")
            ]);
        }else{
            return view('search', [
                'posts' => Post::With(['user', 'category'])->paginate(7)
            ]);
        }
    }
    // public function search()
    // {
    //     return view('/posts', [
    //         'title' => 'Home',
    //         // 'posts' => Post::all()
    //         'posts' => Post::latest()->filter(request(['search','category','user']))
    //     ]);
    // }

    public function show(Post $post)
    {
        return view('post',[
            'title' => 'Post',
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('create', [
            'title' => 'Create'
        ]);
    }

    public function author(User $user)
    {
        if ($user->id == auth()->user()->id) {
            return view('auth.dashboard.user.home', [
                'posts' => Like::where([
                    ['user_id', auth()->user()->id],
                    ['likeable_type', 'App\Models\Post']
                ])->get()
            ]);
        }
        // $follow = Follow::with('user')->find($user);
        return view('/userPosts', [
            'title' => 'User Posts',
            'follows' => $user->following,
            'user' => $user,
            'posts' => $user->posts,
            'favorite' => Like::where([
                ['user_id', $user->id],
                ['likeable_type', 'App\Models\Post']
            ])->get()
        ]);
        
    }

    public function latest()
    {
        return view("/posts", [
            "posts" => Post::With(['user', 'category'])->latest()->paginate(5),
            "title" => "latest"
        ]);
    }

}
