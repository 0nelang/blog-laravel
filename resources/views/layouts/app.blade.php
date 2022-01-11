<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/chomsky" type="text/css"/>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light border border-top-0 border-end-0 border-start-0 border-2 mb-4">
        <div class="container-fluid">
          <a id="navbar-brand" class="navbar-brand me-auto fw-bolder text-alert" href="/">Journal 404</a>
        <div class="ms-auto me-3 d-flex"> 
            @auth        
            <div id="profilePicture" style="background-image: url({{ asset('storage/' . auth()->user()->image) }})" class="ms-auto">
            </div>
            <div class="nav-item dropdown">
              <form action="/logout" method="post">
                <button class="logout dropdown-item" type="submit">Logout</button>
                @csrf
                </form>
            </div>
            @else
              <a class="nav-link " href="/register" style="color: black">Register</a>
            @endauth
        </div>
      </nav>

        <main class="py-4">
            @yield('content')
        </main>
    
</body>
</html>
