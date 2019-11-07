<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- script -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <div class="container">
        @include('partial._main-navbar')
        @include('partial._header')
        @include('partial._navbar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="footer text-center">
            <span class="text-light">Najib <span class="green">{{ date('Y') }}</span></span>
        </footer>
    </div>


</body>

</html>
