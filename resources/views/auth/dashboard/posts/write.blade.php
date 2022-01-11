@extends('auth.dashboard.layouts.maindash')

@section('container')
  <div class="mb-3">
    <label for="body" class="form-label">Your story</label>
    <input id="body" type="hidden" name="body">
    <trix-editor input="body"></trix-editor>
    
  </div>
  
  <a href="create/write" class="btn btn-warning">next</a>
  @endsection