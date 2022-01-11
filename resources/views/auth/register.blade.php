@extends('layouts.login')

@section('main')



<main class="form-registration">
    <form autocomplete="off" method="POST">
        @csrf
      <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>

      <div class="form-floating">
        <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" value="{{ old('name') }}">
        <label for="name">name</label>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-floating">
        <input type="email" name="email"class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
        <label for="email">Email address</label>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      
    <div class="form-floating">
        

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <label for="password">Password</label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

    </div>

    <div class="form-floating">
        
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
    </div>

      


      <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
    </form>
    <small class="d-block text-center mt-3">Already registered?<a href="/login">Login</a></small>
  </main>
@endsection