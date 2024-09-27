<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Default Title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ProX | Responsive Bootstrap 4 Admin Dashboard Template
        </title>
        <!-- Main Backend CSS -->
        @include('pos.layouts.partials.css')

        <!-- Favicon -->
        <link rel="shortcut icon" href="https://templates.iqonic.design/prox/html/assets/images/favicon.ico" />

</head>
<body class="resto-bg collapse-menu  ">
    <!-- loader Start -->
    <div id="loading">
            <div id="loading-center">
            </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
    @include('pos.layouts.partials.header')

    <div class="main-content">
        @yield('content')
    </div>
    

    @include('pos.layouts.partials.footer')

    @include('pos.layouts.partials.js')

</body>
</html>
