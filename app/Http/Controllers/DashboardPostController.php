<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.dashboard.posts.index',[
                'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.dashboard.posts.create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);
        
        
        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('post-image');
        }
        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 100);
        $post = Post::create($validated);
        
        if ($request->tags != null) {
            $tags = $request->tags;
            
            foreach ($tags as $key) {
                $tag = Tag::where('tag', $key)->first();
                if ($tag === null) {
                    Tag::create(['tag' => $key]);
                    $tagId = Tag::where('tag', $key)->first()->id;
                    
                    Post_tag::create([
                        'tag_id' => $tagId,
                        'post_id' => $post->id
                    ]);
                }else{
                    $tagId = $tag->id;
                    Post_tag::create([
                        'tag_id' => $tagId,
                        'post_id' => $post->id
                    ]);
                }
                
            }
        }
        
        return redirect('/dashboard/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('auth.dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $oldTag = [];
        foreach ($post->tags as $key) {
            array_push($oldTag, $key->tag->tag);
        }

        return view('auth.dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'oldTag' =>$oldTag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {   
        
        Post_tag::where('post_id', $post->id)->delete();
        
        if ($request->tags != null) {
            $tags = explode(' ', $request->tags);
            
            foreach ($tags as $key) {
                $tag = Tag::where('tag', $key)->first();
                if ($tag === null) {
                    Tag::create(['tag' => $key]);
                    $tagId = Tag::where('tag', $key)->first()->id;
                    
                    Post_tag::create([
                        'tag_id' => $tagId,
                        'post_id' => $post->id
                    ]);
                }else{
                    $tagId = $tag->id;
                    Post_tag::create([
                        'tag_id' => $tagId,
                        'post_id' => $post->id
                    ]);
                }
                
            }
        }

        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        $validated = $request->validate($rules);
        
        
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('post-image');
        }
        
        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 100);
        $validated['slug'] = self::slugify($request->title);
        
        // @dd($validated);
        Post::where('id', $post->id)
        ->update($validated);
        // $post->update(['title' => 'My New Title']);
        
        return redirect('/dashboard/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        if ($post->image) {
            Storage::delete($post->image);
        }
        Post_tag::where('post_id', $post->id)->delete();
        Post::destroy($post->id);
        return redirect('/dashboard/posts');
    }

    public function slugify($text,$divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
