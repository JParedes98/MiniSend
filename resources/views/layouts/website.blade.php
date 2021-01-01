<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('/images/logo.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/website.css') }}" rel="stylesheet">
</head>
<body>
    <div id="website">
        @yield('navbar')

        @yield('content')

        @yield('footer')
    </div>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/67ee180fdd.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/website.js') }}"></script>
</body>
</html>