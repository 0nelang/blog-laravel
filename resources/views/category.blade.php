
@extends('layouts.main')

@section('featured-genre')

    <img src="/css/img/{{ $gambar }}" alt="" style="height: 60%; width: 100%;">
    <div class="genre-desc">
        <header><h3>Lorem Ipsum</h3></header>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, nam. </p>
    </div>
@endsection

@section('main')

<div class="row bg-light">
    
    <div class="col-10 mx-auto">
        <h2>Top-Posts</h2>
        <div class="owl-carousel owl-theme bg-light">
            @foreach ($top_posts as $item) 
        
            
                <div class="card border-0 rounded mx-2" style="width: 200px">
                    <div style="height: 300px !important; background-color:#dedede;  display: flex;
                    justify-content: center;
                    align-items: center;">
                        @if ($item->image)    
                            <a href="/posts/{{ $item->slug }}"><img src="{{ asset('storage/' . $item->image) }}" alt="" style="max-height:100%; max-width: 100%;"></a>
                        @else
                            <a href="/posts/{{ $item->slug }}"><img src="https://source.unsplash.com/400x600?{{ $item->category->category }}" style="height: 200px overflow:hidden"></a>                       
                        @endif
                    </div>
                    <p class="d-inline"><i class="fas fa-heart"></i> {{ $item->likes->count() }}</p>
                </div>
            
            @endforeach
            
        </div>
    </div>
    
    <div class="col-10 mx-auto">
        <h2>{{ $title }}</h2>

        @foreach ($posts as $post)
        <div class="d-flex mb-5">
            
                <div style="height: 200px; background-color:#dedede;  display: flex;
                justify-content: center;
                align-items: center;">
                    @if ($item->image)    
                        <a href="/posts/{{ $item->slug }}"><img src="{{ asset('storage/' . $post->image) }}" alt="" style="max-height:100%; max-width:100%"></a>
                    @else
                        <a href="/posts/{{ $item->slug }}"><img src="https://source.unsplash.com/400x600?{{ $post->category->category }}" style="height: 200px; overflow:hidden"></a>                       
                    @endif
                </div>
            

            <article class="ms-3 my-auto">
                <h3>
                    <a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a>
                </h3>
                <h6>BY <a href="/author/{{ $post->user->username }}">{{ $post->user->name }}</a> in <a href="/category/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->category }}</a> STORY</h6>
                <p>{{ $post->excerpt }}</p>
                <a href="/posts/{{ $post->slug }}">read more</a>
            </article>
        </div>
        @endforeach

    </div>
</div>
@endsection