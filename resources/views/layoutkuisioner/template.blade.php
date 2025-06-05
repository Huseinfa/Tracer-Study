<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Tracer Study</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo.png">
        <!-- Fonts and icons -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
        <!-- jQuery -->
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask bg-gradient-info opacity-6"></span>
        </div>

        <section class="content">
            @yield('content')
        </section>
        
        @include('layoutkuisioner.footer')

        <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('assets') }}/js/core/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('js')
    </body>
</html>
