<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('client.layouts.partials.css')
</head>

<body class="dark-scheme">
    <div id="wrapper">
        <header class="header_center">
            @include('client.layouts.partials.header')
        </header>

        @yield('content')

        <footer>
            @include('client.layouts.partials.footer')
        </footer>

        <div id="preloader">
            <div class="preloader1"></div>
        </div>
    </div>
    @include('client.layouts.partials.js')
</body>

</html>
