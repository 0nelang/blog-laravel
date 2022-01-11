@extends('auth.dashboard.layouts.maindash')

@section('container')
    @include('partials.userheader')
    
    <ul class="nav nav-tabs d-flex justify-content-evenly">
        <li class="nav-item">
          <a id="1" class="nav-link" aria-current="page" href="/dashboard/user">favorite</a>
        </li>
        <li class="nav-item">
          <a id="2" class="nav-link" href="/dashboard/posts">Post</a>
        </li>
        <li class="nav-item">
          <a id="2" class="nav-link active" href="/dashboard/following">Following</a>
        </li>
      </ul>

      <div class="row">
          <div class="col-6 mx-auto mt-3">

              @forelse ($following as $user)
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
                @empty
                <div class="mt-4 d-flex justify-content-center">
                  <h2 style="color: #dedede">User doesn't follow anyone</h2>
                </div>
                  {{-- <h3>{{ $follow->following->name }}</h3> --}}
              @endforelse

          </div>
      </div>

@endsection