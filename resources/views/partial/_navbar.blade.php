<nav class="navbar navbar-expand-lg my-5 py-0 navbar-light" id="main-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
        aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-home {{ Route::is('home') ? 'active' : '' }}">
                <a class="nav-home" href="{{ url('/') . '/' }}"><i class="fas fa-home fa-lg"></i></span></a>
            </li>
            <li class="nav-item {{ Route::is('posts.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
            </li>
            <li class="nav-item {{ Route::is('categories.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
            </li>
        </ul>
        @role('admin|author')
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">Create Post</a></li>
        </ul>
        @endrole
    </div>
</nav>
