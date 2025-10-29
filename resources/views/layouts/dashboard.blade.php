<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <base href="{{config('app.url')}}/">

    <!-- Scripts -->
    <script src="js/app.js" defer></script>
    <script src="js/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('pageStyles')


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
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

    <div id="app" class="hidden">
        <div class="flex flex-row">
            <div class="fixed left-0 h-screen bg-black w-1/6 text-white font-semibold">
                <a class="w-full pt-2 pb-8 hidden lg:block" href="{{ url('/') }}">
                    <img src="images/logo-dark.webp" alt="Logo" class="mx-auto w-7/12">
                </a>
                <div class="w-full absolute top-1/2 transform -translate-y-1/2">
                    <ul class="px-1 xs:px-3 xsm:px-5 sm:px-8 lg:px-3">
                        <li class="rounded-lg w-full py-2 sm:py-3">
                            <a href="{{ url('home') }}" class="lg:px-3 justify-center lg:justify-start flex items-center">
                                <span class="material-icons-outlined text-md">
                                    dashboard
                                </span>
                                <span class="flex-shrink w-2 hidden lg:block"></span>
                                <span class="hidden lg:block">
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <li class="hidden rounded-lg w-full py-2 sm:py-3">
                            <a href="#" class="lg:px-3 justify-center lg:justify-start flex items-center">
                                <span class="material-icons-outlined text-md">
                                    badge
                                </span>
                                <span class="flex-shrink w-2 hidden lg:block"></span>
                                <span class="hidden lg:block">
                                    Profile
                                </span>
                            </a>
                        </li>
                        <li class="rounded-lg w-full py-2 sm:py-3">
                            <a href="{{ route('order') }}"
                                class="lg:px-3 justify-center lg:justify-start flex items-center">
                                <span class="material-icons-outlined text-md">
                                    departure_board
                                </span>
                                <span class="flex-shrink w-2 hidden lg:block"></span>
                                <span class="hidden lg:block">
                                    Booking
                                </span>
                            </a>
                        </li>
                        <li class="rounded-lg w-full py-2 sm:py-3">
                            <a href="{{ route('client-orders') }}"
                                class="lg:px-3 justify-center lg:justify-start flex items-center">
                                <span class="material-icons-outlined text-md">
                                    timeline
                                </span>
                                <span class="flex-shrink w-2 hidden lg:block"></span>
                                <span class="hidden lg:block">
                                    Orders
                                </span>
                            </a>
                        </li>
                        <li class="hidden rounded-lg w-full py-2 sm:py-3">
                            <a href="#" class="lg:px-3 justify-center lg:justify-start flex items-center">
                                <span class="material-icons-outlined text-md">
                                    history
                                </span>
                                <span class="flex-shrink w-2 hidden lg:block"></span>
                                <span class="hidden lg:block">
                                    History
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-full absolute bottom-1 transform -translate-y-1/2 show-big">
                    <ul class="px-3">
                        <li class="rounded-lg w-full py-2 sm:py-3">
                            <a href="{{ route('logout') }}"
                                class="lg:px-3 justify-center lg:justify-start flex items-center"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="material-icons text-red-500 text-md transform rotate-90">
                                    logout
                                </span>
                                <span class="flex-shrink w-2 hidden lg:block"></span>
                                <span class="hidden lg:block">
                                    Logout
                                </span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-1/6"></div>
            <div class="w-5/6">
                <header class="bg-black text-sm w-full text-white">
                    <div class="w-full flex justify-end">
                        <div class="flex flex-row justify-self-end items-center">
                            <div class="flex flex-col items-end">
                                <span
                                    class="capitalize">{{ Auth::user()->firstname }}{{' '}}{{ Auth::user()->lastname }}</span>
                                <span>User</span>
                            </div>
                            <div class="mx-4">
                                <span class="material-icons text-yellow-500">
                                    manage_accounts
                                </span>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="mt-3 md:mt-5 py-5 mx-5">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- Toastr -->
    <script src="{{ $admin_source }}/plugins/toastr/js/toastr.min.js"></script>
    <script src="{{ $admin_source }}/plugins/toastr/js/toastr.init.js"></script>
    @yield('extraScripts')
    <script src="js/main.js"></script>
    <script>
    $('.menu-icon__cheeckbox').click(() => {
        $('.mobile-nav').toggleClass('hidden')
        $('.menu-icon__cheeckbox').toggleClass('checked')
    })
    </script>
    @yield('custom-script')
</body>

</html>