@extends('auth.dashboard.layouts.maindash')

@section('container')
@include('partials.userheader')

<ul class="nav nav-tabs d-flex justify-content-evenly">
  <li class="nav-item">
    <a id="1" class="nav-link" aria-current="page" href="/dashboard/user">favorite</a>
  </li>
  <li class="nav-item">
    <a id="2" class="nav-link active" href="/dashboard/posts">Post</a>
  </li>
  <li class="nav-item">
    <a id="2" class="nav-link" href="/dashboard/following">Following</a>
  </li>
</ul>

<div class="row pt-5">
  
  @if ($posts->isEmpty())
  
  <div class="d-flex justify-content-center" st>
    <h4 style="color: #dedede">You dont have any post, go make some</h4>
    <a href="posts/create" class="btn btn-primary ms-3"><span data-feather="file-plus"></span> create</a>
  </div>
  
  @else

    <div class="table-responsive col-8 mx-auto">
    <a href="posts/create" class="btn btn-primary"><span data-feather="file-plus"></span> create</a>

      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#no</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->category->category }}</td>
              <td>
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('delete post?')"><span data-feather="trash-2"></span></button>
                </form>
              </td>
            </tr>
            @endforeach
            
        </tbody>
      </table>

    </div>

  @endif
      
</div>
@endsection