@extends('layouts.child')

@section('main')
    <h2>Posts</h2>

    @forelse ($posts as $post)
  <article class="mb-5 container">
    <div class="d-inline">
        <h3 class="d-inline">
            <a href="/posts/{{ $post->slug }}" class="text-decoration-none" style="color: #2e2d2b;" class="d-inline">{{ $post->title }}</a>
          </h3>
          <p class="d-inline"><i class="fas fa-heart"></i> {{ $post->likes->count() }}</p>
    </div>
    <p>{{ $post->excerpt }}</p>
  </article>
  @empty
    <div class="d-flex justify-content-center">
      <h2 style="color: #dedede">No Liked Post</h2>
    </div>
  @endforelse
@endsection