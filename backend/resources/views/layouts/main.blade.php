<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <!-- Styles -->
        <link href="{{ asset('css/reset.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/common.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/top_menu.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/hall.css?').date('is') }}" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

    </head>
    <body>
        <div class="header-box">
            @include('parts.header')
        </div>
        <main>
            @yield('content')
        </main>
        @yield('script')
    </body>
</html>
