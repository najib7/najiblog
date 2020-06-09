<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="fa fa-fw fa-tachometer-alt"></i>Dashboard <span class="badge badge-success">6</span>
                        </a>
                    </li>
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('dashboard.users.index') ? 'active' : '' }}" href="{{ route('dashboard.users.index') }}"><i class="fa fa-fw fa-users"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('dashboard.posts') ? 'active' : '' }}" href="{{ route('dashboard.posts') }}"><i class="fa fa-fw fa-table"></i>Posts</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('dashboard.categories') ? 'active' : '' }}" href="{{ route('dashboard.categories') }}"><i class="fa fa-fw fa-tags"></i>Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('dashboard.comments') ? 'active' : '' }}" href="{{ route('dashboard.comments') }}"><i class="fa fa-fw fa-comments"></i>Comments</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>