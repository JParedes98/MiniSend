<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MiniSend') }}</title>
    <meta name="logged-in-user-id" content="{{ Auth::check() ? Auth::user()->id : null}}">
    <meta name="logged-in-user-name" content="{{ Auth::check() ? Auth::user()->name : null}}">
    <meta name="logged-in-user-email" content="{{ Auth::check() ? Auth::user()->email : null}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <form id="logout-form" action="/logout" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/67ee180fdd.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        function toggleSidebar(){
            var position = 0;
            if( $('#sidebar').position().left == 0) {
                position = -350;
            }
            $('#sidebar').animate({"left":position + "px"}, 200);
        }
    </script>
</body>
</html>
