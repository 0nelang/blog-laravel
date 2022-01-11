@extends('layouts.child')

@section('main')
    <h2>{{ $title }}</h2>
    <div class="container align-item-center">
        <div class="row">
            @foreach ($categories as $category)
            {{-- <li><a href="/category/{{ $category->slug }}">{{ $category->category }}</a></li> --}}
            <div class="col-2 p-1">
                <div class="card p-1 bg-transparent rounded-0" style="width: 100%; height: 400px; border: 3px solid #575651;">
                    <img src="/css/img/{{ $category->gambar }}" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title">{{ $category->category }}</h5>
                      <a href="/category/{{ $category->slug }}" class="btn btn-primary mt-auto">Go somewhere</a>
                    </div>
                  </div>
            </div>
            
            @endforeach
        </div>
    </div>
    
    
@endsection