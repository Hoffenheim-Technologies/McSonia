<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta-description')">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="images/favicon.webp" type="image/x-icon">
    @include('admin.includes.styles')
    <title>
        @yield('title')
    </title>
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header bg-orange">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="{{ $admin_source }}/images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="{{ $admin_source }}/images/logo.png" alt=""></span>
                    <span class="brand-title">
                        <img src="{{ $admin_source }}/images/logo-text-2.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        @include('admin.includes.header')
        @include('admin.includes.sidemenu')
        @yield('content')

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

</body>
@include('admin.includes.scripts')
@yield('custom-script')
</html>
