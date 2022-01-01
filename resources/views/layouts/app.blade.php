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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/app.css" rel="stylesheet">
    <link href="{{ $admin_source }}/plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.webp" type="image/x-icon">
</head>
<body>
    <div class="loader z-50 bg-white">
        <div class="w-full h-max absolute top-1/2 transform -translate-y-1/2">
            <img src="images/logo.png" alt="Logo" class="mx-auto">
        </div>
        <div class="bar"></div>
    </div>
    <div class="mobile-nav bg-gradient-to-b from-gray-200 to-white w-screen hidden z-50 h-screen fixed">
        <header class="md:hidden">
            <nav class="flex items-center justify-between w-full">
                <div class="pl-3">
                    <img src="images/logo.png" alt="Logo" class="mx-auto sm:w-44 w-28">
                </div>
                <div class="pr-3">
                    <ul class="flex justify-between items-center">
                        <!-- <li><a href="{{ route('order') }}" class="font-semibold text-white rounded sm:text-lg py-2 px-3 bg-yellow-500">Book Now</a></li> -->
                        <li class="relative outline-none">
                        <div class="menu-icon">
                            <input class="menu-icon__cheeckbox" type="checkbox"/>
                            <div>
                                <span></span>
                                <span></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="mx-5 px-3 xs:px-5 my-24">
            <ul class="font-extrabold text-yellow-900 text-2xl">
                <li class="my-6">Home</li>
                <li class="my-6">Booking</li>
                <li class="my-6">Testimonials</li>
                <li class="my-6">Contact</li>
            </ul>
        </div>
    </div>
    <div id="app" class="hidden">
        <div class="min-h-screen">
        <header class="hidden md:flex mx-2 mb-3 md:mb-5 items-center h-auto justify-between bg-white">
            <a class="ml-3" href="{{ url('/') }}">
                <img src="images/logo.webp" alt="McSonia Logistics" class="h-8">
            </a>
            <!-- <button class="hidden navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="mt-3">
                <ul class="flex flex-row text-xs">
                    <li class="px-4 uppercase {{ (strpos(Route::currentRouteName(), 'about') === 0) ? 'text-yellow-500' : 'hover:text-yellow-400' }}"><a href="/about">About</a></li>
                    <li class="px-4 uppercase {{ (strpos(Route::currentRouteName(), 'order') === 0) ? 'text-yellow-500' : 'hover:text-yellow-400' }}"><a href="/request">Booking</a></li>
                    <li class="px-4 uppercase {{ (strpos(Route::currentRouteName(), 'testimonial') === 0) ? 'text-yellow-500' : 'hover:text-yellow-400' }}"><a href="/testimonial">Testimonials</a></li>
                    <li class="px-4 uppercase {{ (strpos(Route::currentRouteName(), 'contact') === 0) ? 'text-yellow-500' : 'hover:text-yellow-400' }}"><a href="/solution">Contact-Us</a></li>
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
        <header class="md:hidden">
            <nav class="flex items-center justify-between w-full">
                <div class="pl-3">
                    <img src="images/logo.png" alt="Logo" class="mx-auto sm:w-44 w-28">
                </div>
                <div class="pr-3">
                    <ul class="flex justify-between items-center">
                        <li class="hidden xs:block"><a href="{{ route('order') }}" class="font-semibold text-white rounded sm:text-lg py-2 px-3 bg-yellow-500">Book Now</a></li>
                        <li class="relative outline-none">
                        <div class="menu-icon">
                            <input class="menu-icon__cheeckbox" type="checkbox" />
                            <div>
                                <span></span>
                                <span></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- <div class="central mx-auto mt-5">
                <div class="absolute block top-1/2 left-1/4">
                    <img src="images/logo.png" alt="Logo" class="mx-auto">
                </div>
                <div class="smaller one"></div>
                <div class="smaller four"></div>
                <div class="smaller seven"></div>
            </div> -->
        </header>

        <main class="mt-3 md:mt-5 py-5 mx-5">
            @yield('content')
        </main>
        </div>
        <footer class="container mx-auto mt-12">
            <div class="hidden w-full bg-yellow-100 text-xl flex justify-around">
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
    <!-- Toastr -->
    <script src="{{ $admin_source }}/plugins/toastr/js/toastr.min.js"></script>
    <script src="{{ $admin_source }}/plugins/toastr/js/toastr.init.js"></script>
    @yield('extraScripts')
    <script src="js/main.js"></script>
    <script>
        $('.menu-icon__cheeckbox').click( () => {
            $('.mobile-nav').toggleClass('hidden')
            $('.menu-icon__cheeckbox').toggleClass('checked')
        })
    </script>
    @yield('custom-script')
</body>
</html>
