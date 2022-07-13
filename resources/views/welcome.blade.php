<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="icon" href="{{ url('images') }}/logo-icon.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2/select2.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/select2/select2.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Navbar</a>
        <div class="form-inline">
            @auth
                <a href="{{ url('/home') }}" class="nav-link">Главная</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Войти</a>
            @endauth
        </div>
    </nav>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <img src="{{ url('images/logo.png') }}" alt="">
        </div>
        <div class="d-flex justify-content-center text-center pt-4">
            <h4>Добро пожаловать в систему электронной документации компании.</h4>
        </div>
    </div>
</div>
</body>
</html>
