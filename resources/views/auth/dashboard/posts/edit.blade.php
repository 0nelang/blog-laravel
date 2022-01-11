@extends('auth.dashboard.layouts.maindash')

@section('container')
<form action="/dashboard/posts/{{ $post->slug }}" method="post" enctype="multipart/form-data">
  @method('put')
  @csrf
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit post</h1>
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="enter your title" name="title" value="{{ old('title', $post->title) }}">
    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select id="category" class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" name="category_id" >
      @foreach ($categories as $item)
      @if (old('category_id', $post->category_id) == $item->id)
        <option value="{{ $item->id }}" selected>{{ $item->category }}</option>
      @endif    
        <option value="{{ $item->id }}">{{ $item->category }}</option>
      @endforeach
    </select>
    @error('category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
  </div>

  <div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <select name="tags[]" id="tag" class="form-select" multiple="multiple">
      @foreach ($tags as $tag)
          <option value="{{ $tag->tag }}" @if (in_array($tag->tag, $oldTag))
              selected
          @endif>{{ $tag->tag }}</option>
      @endforeach
    </select>
  </div>
  {{-- <div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <input type="text" class="form-control @error('tags') is-invalid @enderror" id="title" name="tags" value="@foreach ($post->tags as $t){{$t->tag->tag }} @endforeach" placeholder="use space betwen tag">
    @error('tags')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
  </div> --}}

  <div class="mb-3">
    <label for="image" class="form-label">your cover</label>
    <input type="hidden" name="oldImage" value="{{ $post->image }}">
    @if ($post->image)    
      <img src="{{ asset('storage/' . $post->image ) }}" id="output" class="mb-3 img-fluid">
    @else
      <img id="output" class="mb-3 img-fluid">
    @endif
    <input class="form-control @error('category_id') is-invalid @enderror" type="file" id="image" accept="image/*" name="image" onchange="loadFile(event)">
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="body" class="form-label">Your story</label>
    <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror" value="{{ old('body', $post->body)}}">
    <trix-editor input="body"></trix-editor>
    @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
  </div>
  <button class="btn btn-primary" type="submit">submit</button>
</form>




<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
      output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  $(document).ready(function () {
      
      $("#tag").select2({
        placeholder: "select tag",
        tags:true
      });
      
  });
</script>
  @endsection
