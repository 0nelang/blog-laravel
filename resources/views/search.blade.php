@extends('layouts.main')

@section('main')

<ul class="nav nav-tabs me-auto mt-4">
    <li class="nav-item ms-4">
        <a class="btn nav-link active">Story</a>
    </li>
    <li class="nav-item">
        <a class="btn nav-link">User</a>
    </li>
</ul>
<div class="row mt-2">

    <div class="col-3 ms-5">
        <h2>Add a filter</h2>
        <form action="/search/filter" method="POST" class="d-flex">
            @csrf
            <select name="tagFilter[]" id="tag" class="form-select" multiple="multiple">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->tag }}">{{ $tag->tag }}</option>
                @endforeach
              </select>
            @if (isset($query))               
            <input type="hidden" value="{{ $query }}" name="search">
            @endif
            <button class="btn btn-link outline-0 shadow-none border-0" type="submit"><i class="fas fa-search text-dark"></i></button>
        </form>
    </div>
    
    <div class="col-8  mt-3 result">
    
        
        <div class="container hilzam">
        
            @forelse ($posts as $post)
            <article class="mb-5 container">
                
                <div class="d-flex">
                    <h3>
                        <a href="/posts/{{ $post->slug }}" class="text-decoration-none" style="color: #2e2d2b;" class="d-inline">{{ $post->title }}</a>
                    </h3>
                    @if (in_array(auth()->user()->id, $post->likes->pluck('user_id')->toArray()))
                        <form action="/unlike/{{ $post->slug }}" method="post">
                            @csrf
                            
                            <button type="submit" class="ms-2 btn btn-link d-inline"><i class="fas fa-heart"></i></button>
                            <p class="d-inline">{{ $post->likes->count() }}</p>
                        </form>
                    @else
                        <form action="/like/{{ $post->slug }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $post->id }}" name="post_id">
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                <button type="submit" class="ms-2 btn btn-link d-inline"><i class="far fa-heart"></i></button>
                                <p class="d-inline">{{ $post->likes->count() }}</p>
                            </form>
                    @endif
                </div>
                <h6>BY <span><a href="/posts?user={{ $post->user->name }}" class="text-decoration-none" style="color: #2e2d2b;">{{ $post->user->name }}</a></span> in <span><a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none " style="color: #2e2d2b;">{{ $post->category->category }}</a></span> STORY</h6>
                <p>{{ $post->excerpt }}</p>
            </article>
            @empty
                <div class="text-center">
        
                    <h2>nggak ada bego</h2>
                    <p>lol cari yang lain</p>
                </div>
            @endforelse
        
            @if (isset($post))
                {{ $posts->appends(Request::all())->links() }}
            @endif
        
        </div>
        @if (isset($users))
            
        <div id="userHilzam" class="container hilzam">
            @forelse ($users as $user)
            <div class="users mb-3 border-bottom pb-3">
                <div class="d-flex">
                    @if ($user->image)
                        
                    <div id="profilePicture" style="background-image: url({{ asset('storage/' . $user->image) }})">
                    </div>
                    @else
                    <img id="profilePicture" src="/css/img/defaultProfile.png">              
                    @endif
                    <div class="lol ms-3">
                        <h6 class="my-auto">
                            <a href="/author/{{ $user->name }}">{{ $user->name }}</a>
                        </h6>
                        <div class="d-flex flex-row">
                            <div class="me-2">posts: {{ $user->posts_count }}</div>
                            <div>followers: {{ $user->follows->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h2>Tidak ada user bego</h2>
            @endforelse
        </div>
        @endif
    </div>
</div>
    
<script>
    $(document).ready(function() {
        
      $("#tag").select2({
        placeholder: "select tag",
        tags:true
      });

        $("#userHilzam").hide();
      $(".nav-tabs li").click(function() {
        index = $(this).index();
        $(".nav-tabs li a").removeClass("active");
        $(".result div.hilzam").hide();
        $(this).children("a").addClass("active");
        $(".result div.hilzam").eq(index).show();
      });
    })
  </script>
@endsection