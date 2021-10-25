<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand logo" href="{{ url('/') }}">
                    <img src="{{ url('image/l-grad-logo.png') }}" title="{{ config('app.name', 'Auction') }}" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a class="pl-2" href="{{ url('/profile') }}">
                                            <i class="fa fa-btn fa-sign-out"></i>{{ __('translate.Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="pl-2" href="{{ url('/logout') }}">
                                            <i class="fa fa-btn fa-sign-out"></i>{{ __('translate.Logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid header-down">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <form class="form-inline">
                            <button type="submit" id="submit" name="submit" class="btn btn-danger text-uppercase">
                                {{ __('translate.Add Auction') }}
                            </button>
                        </form>
                    </div>
                    <div class="col-4">
                        <form class="form-inline" method="get" action="{{ route('search_auctions') }}">
                            <input type="text" class="form-control mr-2" id="term" name="term" autofocus value="{{ request('term') }}" />
                            <button type="submit" id="submit" name="submit" class="btn btn-primary text-uppercase">
                                {{ __('translate.Search') }}
                            </button>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </form>
                    </div>
                    <div class="col-4">
                        <div class="float-right">
                            @guest
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-warning pull-left text-uppercase" role="button">{{ __('translate.Register') }}</a>
                                @endif
                                <a href="{{ route('login') }}" class="btn btn-success pull-right text-uppercase" role="button">{{ __('translate.Login') }}</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <main class="py-4">
            @yield('content')
        </main>

        <div class="container-fluid">
            <div class="row bg-gray gray-ribbon">
                Hello world
            </div>
        </div>

        <div class="footer">

            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <span class="copyright">
                            {{ date('d.m.Y. h:m:s') }}
                        </span>
                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-3">
                        <span class="copyright">
                            @ {{ date('Y') }} {{ config('app.name', 'Auction') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>
</html>
