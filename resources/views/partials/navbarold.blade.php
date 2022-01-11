<nav class="navbar navbar-expand-xl navbar-light bg-transparent">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">JOURNAL 404</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-2">
        <li class="nav-item">
          <a class="nav-link " href="/categories">Categories</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Community
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/forum">Forum</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/faq">FAQ</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/about">about</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/rules">rules</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" action="/posts">
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        @if (request('user'))
            <input type="hidden" name="user" value="{{ request('user') }}">
        @endif
        <input name="search"class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>