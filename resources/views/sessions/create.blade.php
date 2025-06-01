<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tracer Study Admin</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700|Poppins:600,800" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-size: 14px;
            margin: 0;
            background-color: #1A2A44;
            font-family: 'Poppins', sans-serif;
        }
        .main-content {
            background: linear-gradient(135deg, #1A2A44, #2A4060);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 60px; /* Account for navbar height */
        }
        .navbar {
            width: 100%;
            height: 60px;
            background: #1A2A44;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .navbar-title {
            color: #fff;
            font-weight: 800;
            font-size: 24px;
            margin: 0;
        }
        
        .glass-card {
            width: 310px;
            height: 250px;
            background: rgba(217, 217, 217, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            padding: 20px;
            position: relative;
        }
        .logo-card {
            width: 335px;
            height: 280px;
            background: #1A2A44;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        .form-control {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 16px;
            padding: 5px;
            width: 100%;
            margin-bottom: 15px;
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
            width: 100%;
            height: 40px;
            background: linear-gradient(to bottom, #1A2A44, #2A4060);
            border: none;
            border-radius: 20px;
            color: #fff;
            font-weight: 800;
            font-size: 16px;
        }
        .btn-login:hover {
            background: linear-gradient(to bottom, #1A2A44, #1A3A6A);
        }
        .text-white {
            color: #ffffff !important;
        }
        .inputerror {
            font-size: 14px;
            margin-top: 5px;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px; /* Reduced spacing between logo and login card */
        }
        .col-md-6 {
            flex: 0 0 auto; /* Prevent stretching */
            max-width: 300px; /* Limit width to card sizes */
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 30px;
            }
            .col-md-6 {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h3 class="navbar-title">Tracer Study Admin Log in</h3>
    </nav>
    <main class="main-content">
        <div class="container">
            <div style="z-index: 1" class="col-md-6 d-flex justify-content-center">
                <div class="logo-card">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card">
                    <h4 class="text-white text-center mb-4">Login</h4>
                    <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
                        @csrf
                        @if (Session::has('status'))
                        <div class="alert alert-success alert-dismissible text-dark" role="alert">
                            <span class="text-sm">{{ Session::get('status') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif
                        <div class="mb-4">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" autocomplete="username" placeholder="Username">
                        </div>
                        @error('username')
                        <p class="text-danger inputerror text-center">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                        </div>
                        @error('password')
                        <p class="text-danger inputerror text-center">{{ $message }}</p>
                        @enderror
                        <div class="text-center mt-4">
                            <button type="submit" class="btn-login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Placeholder behavior
            $('input').each(function() {
                const $input = $(this);
                const placeholder = $input.attr('placeholder');
                if ($input.val() === '') {
                    $input.attr('placeholder', placeholder);
                }
                $input.on('focus', function() {
                    if ($input.val() === '') {
                        $input.attr('placeholder', '');
                    }
                });
                $input.on('blur', function() {
                    if ($input.val() === '') {
                        $input.attr('placeholder', placeholder);
                    }
                });
            });
        });
    </script>
</body>
</html>