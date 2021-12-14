<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="js/app.js" defer></script>
    <script src="js/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('pageStyles')

    <link href="css/app.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.webp" type="image/x-icon">
</head>
<body>
    <div class="loader z-50 bg-white">
        <div class="w-full h-max absolute top-1/2 transform -translate-y-1/2">
            <img src="images/logo.png" alt="Logo" class="mx-auto">
        </div>
        <div class="bar"></div>
    </div>
    <div id="app" class="hidden">
        <header class="hidden lg:flex mx-2 mb-3 md:mb-5 items-center h-auto justify-between bg-white">
            <a class="ml-3" href="{{ url('/') }}">
                <img src="images/logo.webp" alt="McSonia Logistics" class="h-8">
            </a>
            <!-- <button class="hidden navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="mt-3">
                <ul class="flex flex-row text-xs">
                    <li class="px-4 uppercase text-yellow-400"><a href="/about">About</a></li>
                    <li class="px-4 uppercase hover:text-yellow-400"><a href="/request">Booking</a></li>
                    <li class="px-4 uppercase hover:text-yellow-400"><a href="/testimonial">Testimonials</a></li>
                    <li class="px-4 uppercase hover:text-yellow-400"><a href="/solution">Solutions</a></li>
                </ul>
            </div>

            <nav class="flex flex-row justify-end">
                <ul class="flex flex-row justify-around text-xs text-yellow-500 mt-3 mr-2">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="px-4 py-2">
                                <a class="uppercase" href="{{ route('login') }}">Log In</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="cursor-pointer px-4 py-2 border rounded border-yellow-500 hover:bg-yellow-500 hover:text-white">
                                <a class="uppercase" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @endif
                    @else
                        <li class="">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname }}
                            </a>

                            <div class="" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </nav>
        </header>
        <main class="mt-3 md:mt-5 py-5 mx-5">
            @yield('content')
        </main>
        <footer class="container mx-auto mt-12">
            <div class="w-full bg-yellow-100 text-xl flex justify-around">
                <span class="flex-grow">Get Connected </span>
                <div class="flex flex-grow justify-around"> 
                    <a href="">Facebook</a>
                    <a href="">Instagram</a>
                </div>
            </div>
            <div class="mx-auto w-full text-center">
                Copyright &copy; {{ date('Y') }}{{' '}}{{ config('app.name') }} Powered by <a class="text-blue-400 hover:text-yellow-500" href="https://www.hoffenheimtechnologies.com">Hoffenheim Technologies</a>
            </div>
        </footer>
    </div>
    <script src="js/jquery.nice-select.min.js"></script>
    @yield('extraScripts')
</body>
</html>
