<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- script -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <!-- header -->
        @include('partial._main-navbar')
        @include('partial._header')
        @include('partial._navbar')
        @yield('content')
    </div>


</body>
</html>
