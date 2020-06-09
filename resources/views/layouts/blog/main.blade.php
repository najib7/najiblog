<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ URL::asset('/img/logo.svg') }}" type="image/x-icon"/>
        
        <!-- css files -->
        <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">
        <link href="{{ mix('css/blog.css') }}" rel="stylesheet">
        
        <!-- js files -->
        <script src="{{ mix('js/manifest.js') }}" defer></script>
        <script src="{{ mix('js/vendor.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>

<body>

    {{-- header --}}
    @include('parts.blog.header')

    <main role="main" class="container">
        @if(!Route::is('profile.show'))
            <div class="row">
                {{-- blog posts --}}
                <div class="col-md-8 blog-main">
                    {{-- carousel --}}
                    @if (Route::is('home') && !isset($_GET["page"]))
                        @include('parts.blog.carousel')   
                    @endif

                    @yield('content')
                </div>

                {{-- sidbar --}}
                @include('parts.blog.sidebar')
            </div>
        @else

            @yield('content')

        @endif
    </main>

    {{-- footer --}}
    @include('parts.blog.footer')

    @stack('scripts')
</body>



</html>