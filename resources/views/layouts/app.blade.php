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
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>
<body class="">
    <div id="app">
        <div class="row">
            <div class="col-sm-1"></div>
            @guest
            <nav class="sidebar close" style="float: left;">
                <header>
                    <div class="image-text">
                        <span class="image">
                            <img src="img/pfp.jpeg" alt="">
                        </span>
            
                        <div class="text logo-text">
                            <span class="name">Please Login</span>
                            <span class="profession">Or Register</span>
                        </div>
                    </div>
            
                    <i class='bx bx-chevron-right toggle'></i>
                </header>
            
                <div class="menu-bar">
                    <div class="menu">
            
                        <li class="search-box">
                            <i class='bx bx-search icon'></i>
                            <input type="text" placeholder="Search...">
                        </li>
            
                        <ul class="menu-links">
                            {{-- Dashboard list item --}}
                            <li class="nav-link {{ Request::is('login*') ? 'nav-link-active' : 'nav-link' }}">
                                <a href="{{ url('/login') }}">
                                    <i class='icon'><x-gmdi-login style="height: 20px;" /></i>
                                    <span class="text nav-text">{{ __('Login') }}</span>
                                </a>
                            </li>
            
                            {{-- Inbox list item --}}
                            <li class="nav-link {{ Request::is('register*') ? 'nav-link-active' : 'nav-link' }}">
                                <a href="{{ url('/register') }}">
                                    <i class='icon'><x-ri-registered-line style="height: 20px;" /></i>
                                    <span class="text nav-text">{{ __('Register') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
            
                    <div class="bottom-content">
            
                        {{-- Form to log out --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
            
                        {{-- Light/Dark mode slider item --}}
                        <li class="mode">
                            <div class="sun-moon">
                                <i class='bx bx-moon icon moon'></i>
                                <i class='bx bx-sun icon sun'></i>
                            </div>
                            <span class="mode-text text">Dark mode</span>
            
                            <div class="toggle-switch">
                                <span class="switch"></span>
                            </div>
                        </li>
                        
                    </div>
                </div>
            
            </nav>
                @else
                    @include('layouts.navigation')
            @endguest
            
            <div class="col-sm-11">
                <div class="py-2"></div>
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>