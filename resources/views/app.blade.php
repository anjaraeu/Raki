<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AnjaraFiles') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('head')
</head>
<body>
    <div id="app">
        <nav class="ui fixed inverted large menu">
            <div class="ui container">
                <a class="header item" href="{{ url('/') }}">
                    {{ config('app.name', 'AnjaraFiles') }}
                </a>
                <div href="#" class="ui dropdown item">
                    <i class="info icon"></i><i class="dropdown icon"></i>

                    <div class="menu">
                        <a href="/privacy" class="item">{{ __('layout.menu.privacy') }}</a>
                        <a href="/legal" class="item">{{ __('layout.menu.legal') }}</a>
                    </div>
                </div>
                <div href="#" class="ui dropdown item">
                    <i class="wrench icon"></i><i class="dropdown icon"></i>

                    <div class="menu">
                        <a href="/manage" class="item">{{ __('layout.menu.manage') }}</a>
                    </div>
                </div>
                <div class="right menu" id="navbarSupportedContent">
                    <div href="#" class="ui dropdown item">
                        <i class="language icon"></i><i class="dropdown icon"></i>

                        <div class="menu">
                            @foreach (config('app.locales') as $lang => $language)
                                <a href="/language/{{ $lang }}" class="item">{{ $language }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="minimargin" {{-- v-if="lang" --}}>
            <noscript>
                <div class="ui container">
                    <div class="ui negative message">
                        <div class="header">
                            {{ __('layout.js._') }}
                        </div>
                        <p>{{ __('layout.js.tooltip') }}</p>
                    </div>
                </div>
                <br/>
            </noscript>
            @yield('content')
        </main>
    </div>
</body>
</html>
