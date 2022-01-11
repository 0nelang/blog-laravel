@extends('auth.dashboard.layouts.maindash')


@section('container')
{{-- <div class="jumbotron jumbotron-fluid bg-secondary">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center flex-column pt-3 pb-2 mb-3">
    @if (auth()->user()->image)      
      <div id="profilePicture" style="background-image: url({{ asset('storage/' . auth()->user()->image) }})">
    @else
      <div id="profilePicture" style="background-image: url('/css/img/defaultProfile.png')">
    @endif
  </div>
    <h1 class="h2">{{ auth()->user()->name }}</h1>
    <h6>{{ auth()->user()->email }}</h6>
    <p class="mb-0">posts: {{ auth()->user()->posts_count }}</p>
    <p class="mb-0">Followers: {{ auth()->user()->follows->count() }}</p>
    <a href="/dashboard/user/{{ auth()->user()->name }}" class="btn btn-primary ms-auto me-2"><span data-feather="edit-3"></span> edit</a>
  </div>

</div> --}}
@include('partials.userheader')

<ul class="nav nav-tabs d-flex justify-content-evenly">
  <li class="nav-item">
    <a id="1" class="nav-link active" aria-current="page" href="#">favorite</a>
  </li>
  <li class="nav-item">
    <a id="2" class="nav-link" href="/dashboard/posts">Post</a>
  </li>
  <li class="nav-item">
    <a id="2" class="nav-link" href="/dashboard/following">Following</a>
  </li>
</ul>

<div class="post mt-5">
  
  @forelse ($posts as $post)
  <article class="mb-5 container">
    <div class="d-inline">
        <h3 class="d-inline">
            <a href="/posts/{{ $post->likeable->slug }}" class="text-decoration-none" style="color: #2e2d2b;" class="d-inline">{{ $post->likeable->title }}</a>
          </h3>
          <p class="d-inline"><i class="fas fa-heart"></i> {{ $post->likeable->likes->count() }}</p>
    </div>
    <p>{{ $post->likeable->excerpt }}</p>
  </article>
  @empty
    <div class="d-flex justify-content-center">
      <h2 style="color: #dedede">No Liked Post</h2>
    </div>
  @endforelse
</div>

  
@endsection