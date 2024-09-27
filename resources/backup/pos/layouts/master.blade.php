<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dreams Pos Admin Template</title>

    <link rel="shortcut icon" type="image/x-icon" href="https://dreamspos.dreamstechnologies.com/html/template/assets/img/favicon.png">

    <!-- Styles -->
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/css/animate.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/owlcarousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://dreamspos.dreamstechnologies.com/html/template/assets/css/style.css">

    <style>
        .bi-app:active {
            fill: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <header>
            @include('pos.layouts.partials.header') <!-- Include your header -->
        </header>

        @include('pos.layouts.partials.nav') <!-- Include your navigation -->

        <div class="content">
            @yield('content') <!-- Main content section -->
        </div>

        <footer>
            @include('pos.layouts.partials.footer') <!-- Include your footer -->
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/feather.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/jquery.slimscroll.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/jquery.dataTables.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/apexchart/chart-data.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/moment.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/select2/js/select2.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/theme-script.js"></script>
    <script src="https://dreamspos.dreamstechnologies.com/html/template/assets/js/script.js"></script>
</body>

</html>
