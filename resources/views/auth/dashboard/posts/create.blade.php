@extends('auth.dashboard.layouts.maindash')

@section('container')
<div class="row">
  <div class="col-8 mx-auto">

    <form action="/dashboard/posts" method="post" enctype="multipart/form-data">
      @csrf
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create post</h1>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
      </div>
      {{-- <div class="mb-3">
        <label for="excerpt" class="form-label">Description</label>
        <textarea class="form-control @error('title') is-invalid @enderror" id="excerpt" rows="3" name="slug"></textarea>
        @error('excerpt')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
      </div> --}}
      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" name="category_id" >
          <option value="" selected disabled hidden>Select category</option>
          @foreach ($categories as $item)    
            <option value="{{ $item->id }}">{{ $item->category }}</option>
          @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
      </div>

      <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select name="tags[]" id="tag" class="form-select" multiple="multiple">
          @foreach ($tags as $tag)
              <option value="{{ $tag->tag }}">{{ $tag->tag }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">your cover</label>
        <img id="output" class="mb-3">
        <input class="form-control @error('category_id') is-invalid @enderror" type="file" id="image" accept="image/*" name="image" onchange="loadFile(event)">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Your story</label>
        <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror" value="{{ old('body') }}">
        <trix-editor input="body"></trix-editor>
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
      </div>
      <button class="btn btn-primary" type="submit">submit</button>
    </form>

  </div>
</div>
  <script>
    $(document).ready(function () {
      
        $("#tag").select2({
          placeholder: "select tag",
          tags:true
        });
        
    });
    // function previewImage() {

    // const image = document.querySelector('#image'); 
    // const imgPreview = document.querySelector('.img-preview'); 

    // imgPreview.style.display = 'block';
    
    // const oFReader = new FileReader();
    // oFReader.readAsDataURL( image.files[0]);

    // OFReader.onload = function(oFREvent) {
    //   imgPreview.src = oFREvent.target.result;
    // }
    // }
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
      output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  </script>
  @endsection
