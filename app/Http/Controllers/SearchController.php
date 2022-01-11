<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\User;
use \App\Models\Post_tag;
use \App\Models\Tag;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $posts = Post::orderBy('like', 'desc');
        if (request('query')) {
            $key = request('query');
            $posts = $posts->where('title', 'LIKE', '%' .$key. '%')->with('user', 'category');
            $user = User::where('name', 'LIKE', '%' .$key. '%');

            return view('search', [
                'tags' => Tag::all(),
                'posts' => $posts->paginate(7, $columns = ["*"], $pageName = "pagepost"),
                'users' => $user->paginate(7, $columns = ["*"], $pageName = "pageuser"),
                'query' => request('query')
            ]);
        }else{
            return view('search', [
                'tags' => Tag::all(),
                'posts' => Post::With(['user', 'category'])->paginate(7)
            ]);
        }
    }

    public function tag(Request $request)
    {
        $query = $request->input('search');
        $tag = $request->input('tagFilter');
        $posts = Post::orderBy('like', 'desc');
        $user = User::where('name', 'LIKE', '%' .$query. '%');
        
        $tagQuery = array();
        if ($query) {
            $posts = $posts->where('title', 'LIKE', '%' .$query. '%')->with('user', 'category');
        }
        
        if ($tag) {
            if (count($tag) > 1) {
                
                foreach ($tag as $key => $k) {
                    $filtered = $posts->whereHas('tags', function($t) use ($k) {
                       
                        $t->whereHas('tag',function($tg) use($k) {
                            
                            $tg->where('tag', $k);
                                
                        });
                    });
                }
                
                
                
            } else {
                
                $filtered = $posts->whereHas('tags', function($t) use ($tag,$tagQuery) {
                
                   
                    $t->whereHas('tag',function($tg) use($tag,$tagQuery) {
                        
                        $tg->where('tag', $tag);
                        
                    } );
                });
                
            
            }
            
            
            // dd($filtered->get());

            return view('search', [
                'tags' => Tag::all(),
                'posts' => $filtered->paginate(7, $columns = ["*"], $pageName = "pagepost"),
                'query' => $query,
                'users' => $user
            ]);
        }
        
        return redirect()->back();
        
    }
}
