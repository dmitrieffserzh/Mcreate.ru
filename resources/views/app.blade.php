<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title','A default title')</title>
        <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
        <meta name="description" content="@yield('meta_description','default description')">
        <link rel="canonical" href="{{url()->current()}}"/>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
    <header class="header">
        <div class="container">
            HEADER
        </div>
    </header>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
