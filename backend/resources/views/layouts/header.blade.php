<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <style>
        .aaa{
        }
    </style>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{-- config('app.name','Haizen') --}}Haizen</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/reset.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css?').date('is') }}" rel="stylesheet"> 
        <link href="{{ asset('css/common.css?').date('is') }}" rel="stylesheet"> 
        <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

    </head>
    <body>
        <main>
            <header>
                <div class="back"><i class="fas fa-reply"></i></div> 
                <div class="text">HAIZEN</div>
                <div class="menu">menu</div>
            </header>
            
            <div class="b-content">
                @yield('content')
            </div>
            
        </main>
        @yield('script')
    </body>
</html>
