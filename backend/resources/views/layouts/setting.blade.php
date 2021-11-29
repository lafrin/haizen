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

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
          <!-- app.scssにある --> 

        <!-- Styles -->
        <link href="{{ asset('css/app.css?').date('is') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css?').date('is') }}" rel="stylesheet"> 
        <link href="{{ asset('css/common.css?').date('is') }}" rel="stylesheet"> 
        <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

    </head>
    <body>

    
        <div class="header-box">
            @include('parts.header')
        </div>
        <main>
            <div class="" style="display:flex">
                <div class="side-menu" style="">
                    <div style="">  
                        @include('parts.side_menu')
                    </div>
                </div>

                <div class="" style="width:calc(100% - 200px);height:100%;">
                    @yield('content')
                    
                </div>
            </div>
        </main>
        @yield('script')
    </body>
</html>
