<header class="blog-header">
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg top-nav">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">register</a>
                        </li>
                    @else
                        @role('admin')
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{ route('dashboard.index') }}"><i class="fas fa-external-link-square-alt"></i>Dashboard</a>
                            </li>
                        @endrole
                        @role('admin|author')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.create') }}"><i class="fas fa-plus-circle"></i>New Post</a>
                            </li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                {{ Auth::user()->username }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                @role('admin|author')
                                    <a class="dropdown-item" href="{{ route('my-posts') }}">My posts</a>
                                @endrole
                                <a class="dropdown-item" href="{{ route('profile.show', Auth::user()) }}">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logout-button">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- logo --}}
    <div class="container py-5">
        <a class="blog-header-logo text-dark" href="#">
            <img src="/img/logo.svg" width="100" alt="">
        </a>
    </div>

    {{-- main navbar --}}
    <div class="mb-5">
        <nav class="main-nav">
            <div class="container">
                <div class="nav">
                    <a class="nav-item nav-home" href="/">Home</a>
                    @foreach (config('blog.categories_in_navbar') as $categorie)
                    <a class="nav-item" href="{{ route('categories.show', $categorie) }}">{{ $categorie }}</a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
</header>