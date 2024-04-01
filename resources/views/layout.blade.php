<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
       @vite('resources/css/app.css')
{{--    <link href="{{ Vite::asset('resources/css/app.css') }}" rel="stylesheet">--}}
</head>
<body class="antialiased">
<div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-200 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @yield('content')
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@yield('scripts')
</html>
