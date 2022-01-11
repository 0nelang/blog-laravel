@extends('auth.dashboard.layouts.maindash')

@section('container')
<form action="/dashboard/user/{{ $user->name }}" method="post" enctype="multipart/form-data">
  @method('put')
  @csrf
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Profile</h1>
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Profile Picture</label>
    <input type="hidden" name="oldImage" value="{{ $user->image }}">
    {{-- @if ($user->image)    
      <img src="{{ asset('storage/' . $user->image ) }}" id="output" class="mb-3 img-fluid">
    @else
      <img id="output" class="mb-3 img-fluid">
    @endif --}}
    <input type="hidden" name="oldImage" value="{{ $user->image }}">
    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" accept="image/*" name="image" onchange="loadFile(event)">
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter your name" name="name" value="{{ $user->name }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
  </div>
  
  <button class="btn btn-primary" type="submit">submit</button>
</form>





  @endsection
