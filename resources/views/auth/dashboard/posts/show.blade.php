@extends('auth.dashboard.layouts.maindash')

@section('container')

    <div style="height: 300px;" class="bg-light mt-2">
        <img src="{{ asset('storage/' . $post->image) }}" alt="" style="height:100%;">
    </div>
    <h2>{{ $post ->title }}</h2> 
    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button class="badge bg-danger border-0" onclick="return confirm('delete post?')"><span data-feather="trash-2"></span></button>
        </form>

    
<article>
    <p>{!! $post->body !!}</p>
    <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> back to my post</a>                  
                     
</article>
@endsection