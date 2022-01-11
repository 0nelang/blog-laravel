@extends('layouts.main')

@section('main')

<div class="row bg-light">
    
    <div class="col-10 mx-auto">
        <h2>Top-Posts</h2>
        <div class="owl-carousel owl-theme bg-light">
            @foreach ($top_posts as $item) 
        
            
                <div class="card border-0 rounded mx-2" style="width: 200px">
                    <div style="height: 300px; background-color:#dedede;  display: flex;
                    justify-content: center;
                    align-items: center;">
                        @if ($item->image)    
                            <a href="/posts/{{ $item->slug }}"><img src="{{ asset('storage/' . $item->image) }}" alt="" style="max-height:100%; max-width:100%"></a>
                        @else
                            <a href="/posts/{{ $item->slug }}"><img src="https://source.unsplash.com/400x600?{{ $item->category->category }}" style="height: 200px overflow:hidden"></a>                       
                        @endif
                    </div>
                    <p class="d-inline"><i class="fas fa-heart"></i> {{ $item->likes->count() }}</p>
                </div>
            
            @endforeach
            
        </div>
    </div>
</div>

@foreach ($data_category as $category_index => $category_row)
<div class="row bg-light">
    <div class="col-10 mx-auto">

        <h2>{{ $category_index }}</h2> 
        <div class="owl-carousel owl-theme">
            @foreach ($category_row as $item) 
            
            <div class="card border-0 rounded mx-2" style="width: 200px">
                <div style="height: 300px; background-color:#dedede;  display: flex;
                justify-content: center;
                align-items: center;">
                    @if ($item->image)    
                        <a href="/posts/{{ $item->slug }}"><img src="{{ asset('storage/' . $item->image) }}" alt="" style=""></a>
                    @else
                        <a href="/posts/{{ $item->slug }}"><img src="https://source.unsplash.com/400x600?{{ $item->category->category }}" style="height: 200px overflow:hidden"></a>                       
                    @endif
                </div>
                <p class="d-inline"><i class="fas fa-heart"></i> {{ $item->likes->count() }}</p>
            </div>

            {{-- <div class="me-2 ms-2" style="height:300px">
                <div class="card border-0 rounded" style="height: 280px">
                    <div style="height: 100%; overflow:hidden">
                        @if ($item->image)    
                        <a href="/posts/{{ $item->slug }}"><img src="{{ asset('storage/' . $item->image) }}" alt="" style="height: 200px;"></a>
                        @else
                        <a href="/posts/{{ $item->slug }}"><img src="https://source.unsplash.com/400x600?{{ $item->category->category }}" style="height: 200px overflow:hidden"></a>                       
                        @endif
                    </div>
                    <p class="d-inline"><i class="fas fa-heart"></i> {{ $item->likes->count() }}</p>
                </div>
            </div> --}}
            @endforeach       
        </div>

    </div>
</div>

@endforeach

    {{-- @foreach ($posts as $post)
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
    @endforeach
    {{ $posts->links() }} --}}
@endsection

{{-- @section('featured')
    <div class="featured3-items">
        <div class="row">
        <article class="col-xl-12 col-lg-4">
            <header><h3>Lorem Ipsum</h3></header>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse cumque ut beatae quisquam delectus nobis excepturi quis eum possimus sed tempore temporibus culpa, nemo, dolorum facere ex id quo hic.
        </article>
        <article class="col-xl-12 col-lg-4">
            <header><h3>Lorem Ipsum</h3></header>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse cumque ut beatae quisquam delectus nobis excepturi quis eum possimus sed tempore temporibus culpa, nemo, dolorum facere ex id quo hic.
        </article>
        <article class="col-xl-12 col-lg-4">
            <header><h3>Lorem Ipsum</h3></header>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse cumque ut beatae quisquam delectus nobis excepturi quis eum possimus sed tempore temporibus culpa, nemo, dolorum facere ex id quo hic.
        </article>
        </div>
    </div>
@endsection --}}

