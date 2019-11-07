<nav class="navbar navbar-expand-md navbar-light bg-white top-navbar">
    {{-- <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a> --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-navbar"
        aria-controls="top-navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="top-navbar">


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                    @role('admin|author')
                    <a class="dropdown-item" href="{{ route('my-posts') }}">My posts</a>
                    @endrole
                    @auth
                    <a class="dropdown-item" href="{{ route('profile.show', auth()->user()) }}">Profile</a>
                    <div class="dropdown-divider"></div>
                    @endauth
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @role('admin')
            <li class="nav-item">
                <a class="nav-link red" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            @endrole
            @endguest
        </ul>

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-facebook-square"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-twitter-square"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-linkedin"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-youtube-square"></i></a></li>
        </ul>
    </div>
</nav>
