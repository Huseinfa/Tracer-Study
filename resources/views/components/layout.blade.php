<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
@props(['bodyClass'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Tracer Study Admin
    </title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700|Poppins:600,800" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-size: 14px;
            margin: 0;
        }
        .bg-gradient-blue {
            background: linear-gradient(to right, #0A1A2F,#1A3A6A, #2A5A9A) !important;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        .navbar {
            width: calc(100% - 92px);
            height: 66px;
            background: #1a3a6a;
            position: absolute;
            top: 33px;
            left: 46px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .navbar-title {
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 32px;
            margin: 0;
        }
        .glass-card {
            width: 478px;
            height: 320px;
            background: rgba(217, 217, 217, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
        }
        .form-control {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 16px;
            padding: 5px;
        }
        .form-control:focus {
            outline: none;
            border-bottom-color: #fff;
        }
        .form-control::placeholder {
            color: #fff;
            opacity: 1;
        }
        .btn-login {
            width: 295px;
            height: 40px;
            background: linear-gradient(to bottom, #0a1a2f, #29548e);
            border: none;
            border-radius: 35px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 20px;
        }
        .btn-login:hover {
            background: linear-gradient(to bottom, #0a1a2f, #1a3a6a);
        }
        .text-white {
            color: #ffffff !important;
            font-family: 'Poppins', sans-serif;
        }
        h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 32px;
        }
        .inputerror {
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="{{ $bodyClass ?? '' }}">

    <nav class="navbar">
        <h3 class="navbar-title">Tracer Study Admin Log in</h3>
    </nav>
    {{ $slot }}

    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
    @stack('js')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard -->
    <script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
</body>
</html>