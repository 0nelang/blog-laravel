@extends('layouts.login')

@section('main')
@if (session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('loginFailed'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('loginFailed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<main class="form-signin">
    <form action="/login" method="POST">
      @csrf
      <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
  
      <div class="form-floating">
        <input type="email" name="email"class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
        <label for="email">Email address</label>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    </form>
    <div class="text-center">

      <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Password?') }}
      </a>
      <p>Don't have an account?
        <a class="" href="/register">
          Register
        </a>
      </p>

    </div>

  </main>
@endsection