<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ mix('css/err.css') }}">

        <title>@yield('title')</title>
    </head>
    <body>
        <div class="box">
            <h1 class="code">
                @yield('code')
            </h1>

            <div class="message">
                <strong>@yield('message')</strong>
            </div>

            @yield('additional')

            <div class="home">
                <a href="{{ url('/') }}">{{ __('errors.home') }}</a>
            </div>
        </div>
    </body>
</html>
