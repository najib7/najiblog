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
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <!-- header -->
    @include('partial._header')
    @include('partial._navbar')
    @yield('content')


</body>
</html>
