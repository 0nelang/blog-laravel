<nav class="navbar sticky-top navbar-expand navbar-light bg-light border border-top-0 border-end-0 border-start-0 border-2">
  <div class="container-fluid">
    <a id="navbar-brand" class="navbar-brand m-auto fw-bolder text-alert" href="/">Journal 404</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-2 mb-2 mb-lg-0 fw-bold">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Browse
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/categories">Categories</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/latest">latest</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Community
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">About Journal 404</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">rules</a></li>
          </ul>
        </li>
        
      </ul>
      <form class="d-flex" method="GET" action="{{ route('search') }}">
        <input class="border-0 border-bottom" type="text" name="query" placeholder="Search" aria-label="Search" style="outline: none; background: none;">
        <button class="btn btn-link outline-0 shadow-none border-0" type="submit"><i class="fas fa-search text-dark"></i></button>
      </form>
    </div>
  </div>
  <div class="ms-auto me-3 d-flex"> 
      @auth
      @if (auth()->user()->image)
        <div id="profilePicture" style="background-image: url({{ asset('storage/' . auth()->user()->image) }})" class="ms-auto">
        </div>
      @else
        <div id="profilePicture" style="background-image: url(/css/img/defaultProfile.png)" class="ms-auto"></div>
      @endif        
      
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ auth()->user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="/dashboard/user">My Profile</a></li>
          <li><a class="dropdown-item" href="/dashboard/posts/create">Write</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><form action="/logout" method="post">
            <button class="logout dropdown-item" type="submit">Logout</button>
            @csrf
            </form>
          </li>
        </ul>
      </div>
      @else
        <a class="nav-link " href="/register" style="color: black">Register</a>
      @endauth
  </div>
</nav>