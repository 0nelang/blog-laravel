<div class="jumbotron jumbotron-fluid bg-secondary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center flex-column pt-3 pb-2 mb-3">
      @if (auth()->user()->image)      
        <div id="profilePicture" style="background-image: url({{ asset('storage/' . auth()->user()->image) }})">
      @else
        <div id="profilePicture" style="background-image: url('/css/img/defaultProfile.png')">
      @endif
    </div>
      <h1 class="h2">{{ auth()->user()->name }}</h1>
      <h6>{{ auth()->user()->email }}</h6>
      <p class="mb-0">posts: {{ auth()->user()->posts_count }}</p>
      <p class="mb-0">Followers: {{ auth()->user()->follows->count() }}</p>
      <a href="/dashboard/user/{{ auth()->user()->name }}" class="btn btn-primary ms-auto me-2"><span data-feather="edit-3"></span> edit</a>
    </div>
  
  </div>