<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- CSS files -->

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/fa-all.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body,
        html {
            height: 100%;
        }

        .bg-image-body {
            background-image: url("assets/images/dark-blue-background-02.jpg");
            height: 100%;            
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    @vite('resources/js/app.js')
</head>

<body class="bg-image-body border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        @yield('content')
    </div>

    <!-- Vendors, App and Customs scripts-->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
</body>

</html>
