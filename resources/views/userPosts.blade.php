
@extends('auth.dashboard.layouts.maindash')

@section('container')
  <div class="jumbotron jumbotron-fluid bg-secondary" >
    <div class="d-flex align-items-center flex-column pt-4 mb-auto  ">
      @if ($user->image)      
        <div id="profilePicture" style="background-image: url({{ asset('storage/' . $user->image) }})">
      @else
        <div id="profilePicture" style="background-image: url('/css/img/defaultProfile.png')">
        </div>
      @endif
      <h1 class="h2">{{ $user->name }}</h1>
      <p class="mb-0">posts: {{ $user->posts_count }}</p>
      <p>follower: {{ $user->follows->count() }}</p>
    
    </div>

    @if (in_array(auth()->user()->id, $user->follows->pluck('follower_id')->toArray()))
        <form action="/unfollow/{{ $user->id }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-light ms-auto me-1 mb-2">unfollow</button>
        </form>
    @else
        
      <form action="/follow/{{ $user->id }}" method="POST" class="d-flex">
        @csrf
      <input type="hidden" value="{{ auth()->user()->id }}" name="follower_id">
      <input type="hidden" value="{{ $user->id }}" name="followed_id">
      <button type="submit" class="btn btn-danger ms-auto me-1 mb-2">Follow</button>
      </form>

    @endif

  </div>
  <ul class="nav nav-tabs d-flex justify-content-evenly">
    <li class="nav-item">
      <a id="1" class="nav-link active" aria-current="page" href="#">favorite</a>
    </li>
    <li class="nav-item">
      <a id="2" class="nav-link" href="#">Post</a>
    </li>
    <li class="nav-item">
      <a id="3" class="nav-link" href="#">Following</a>
    </li>
  </ul>
    {{-- <h2>{{ $user->name }} Post's</h2> --}}

    <div class="post mt-4">

        <div class="favorite-post hilzam">
          @if ($favorite->isNotEmpty())
              
            
              <h1>fav posts</h1>
                @foreach ($favorite as $fav)
                <article class="mb-5 container">
                  <div class="d-inline">
                      <h3 class="d-inline">
                          <a href="" class="text-decoration-none" style="color: #2e2d2b;" class="d-inline">{{ $fav->likeable->title }}</a>
                        </h3>
                        <p class="d-inline"><i class="fas fa-heart"></i> {{ $fav->likeable->likes->count() }}</p>
                  </div>
                  <p>{{ $fav->likeable->excerpt }}</p>
                </article>     
                @endforeach
            

          @else

            <div class="d-flex justify-content-center">
              <h2 style="color: #dedede">this user hasn't like any post</h2>
            </div>

          @endif
        </div>

        <div class="user-post hilzam">
          @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
              <article class="mb-5 container">
                  <h3>
                      <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                  </h3>
                  <h6>{{ $post->author }}</h6>
                  <p>{{ $post->excerpt }}</p>
              </article>
            @endforeach
          @else
            <div class="d-flex justify-content-center">
              <h2 style="color: #dedede">this user doesn't have any post</h2>
            </div>
          @endif
            
        </div>

        <div class="following hilzam">
          @if ($follows->isNotEmpty())
            @foreach ($follows as $user)
              <div class="users mb-3 border-bottom pb-3">
                <div class="d-flex">
                    @if ($user->following->image)
                        
                    <div id="profilePicture" style="background-image: url({{ asset('storage/' . $user->following->image) }})">
                    </div>
                    @else
                    <img id="profilePicture" src="/css/img/defaultProfile.png">              
                    @endif
                    <div class="lol ms-3">
                        <h6 class="my-auto">
                            <a href="/author/{{ $user->following->name }}">{{ $user->following->name }}</a>
                        </h6>
                        <div class="d-flex flex-row">
                            <div class="me-2">posts: {{ $user->following->posts_count }}</div>
                            <div>followers: {{ $user->following->follows->count() }}</div>
                        </div>
                    </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="d-flex justify-content-center">
              <h2 style="color: #dedede">this user doesn't follow anyone</h2>
            </div>
          @endif
          
        </div>

    </div>


    <script>
        $(document).ready(function() {
          $(".user-post").hide();
          $(".following").hide();
          $(".nav-tabs li").click(function() {
              index = $(this).index();
              $(".nav-tabs li a").removeClass("active");
              $(".post div.hilzam").hide();
              $(this).children("a").addClass("active");
              $(".post div.hilzam").eq(index).show();
           });
        })
    </script>
@endsection