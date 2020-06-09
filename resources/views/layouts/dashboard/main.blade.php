<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} - dahsboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ URL::asset('/img/logo.svg') }}" type="image/x-icon"/>

    <!-- css files -->
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('css/dashboard.css') }}" rel="stylesheet">

    <!-- js files -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('scripts')
</head>

<body>
    <div class="dashboard-main-wrapper">

        @include('parts.dashboard.header')

        @include('parts.dashboard.sidbar')

        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">@yield('title')</h2>
                        </div>
                    </div>
                </div>

                <div class="dashboard-body">
                    @yield('dashboard-body')
                </div>
            </div>
        </div>

    </div>

    <div class="footer">
        <div class="row">
            <div class="text-md-right footer-links ml-auto">
                Copyright ©2020 Najiblog.
            </div>
        </div>
    </div>
</body>
 
</html>