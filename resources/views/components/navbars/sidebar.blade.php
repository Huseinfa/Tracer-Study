@props(['activePage'])

<style>
    /* Increase specificity by targeting the full selector */
    .sidenav.navbar.navbar-vertical.navbar-expand-xs#sidenav-main {
        border-bottom: 2px solid #ffffff33 !important; /* Light gray border with transparency */
        transition: border-bottom 0.3s ease !important;
    }

    #sidenav-collapse-main {
        flex: 1;
        overflow-y: auto;
    }

    /* Adjust breakpoint to match navbar-expand-xs (576px) */
    /* Hide border on larger screens where sidebar is expanded */
    @media (min-width: 576px) {
        .sidenav.navbar.navbar-vertical.navbar-expand-xs#sxidenav-main {
            border-bottom: none !important;
        }
    }

    /* Show border on smaller screens or when collapsed */
    @media (max-width: 575px) {
        .sidenav.navbar.navbar-vertical.navbar-expand-xs#sxidenav-main {
            border-bottom: 2px solid #ffffff33 !important;
        }
    }

    /* Debug: Add a temporary marker to confirm the style is applied */
    .sidenav.navbar.navbar-vertical.navbar-expand-xs#sxidenav-main::after {
        content: "Style Applied";
        position: absolute;
        bottom: 5px;
        left: 5px;
        color: #ffffff33;
        font-size: 10px;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center justify-content-start" href="{{ route('dashboard') }}">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <img src="{{ asset('assets') }}/img/logotracer-study.png" alt="main_logo" style="height: 90px; width: 70px; margin-right: 10px;">
    <span class="text-white" style="font-family: 'Quicksand', sans-serif; font-size: 1.4rem; font-weight: 600; letter-spacing: 0.5px; margin: 0;">
        Tracer Study
    </span>
</a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Data Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'admin' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('admin.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-file ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'lulusan' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('lulusan.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-file ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Lulusan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'stakeholder' ? ' active bg-gradient-primary' : '' }} "
                href="{{ route('stakeholder.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-file ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Stakeholder</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#masaTungguCollapse" aria-expanded="false">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-time-alarm text-dark"></i>
                    </div>
                    <span class="nav-link-text ms-1">Masa Tunggu</span>
                    <span class="nav-link-text ms-1">Kuisioner Stakeholder</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rtl' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('rtl') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'notifications' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('notifications') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Notifications</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profile' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('static-sign-in') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('static-sign-up') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
                <div class="collapse" id="masaTungguCollapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white {{ Route::currentRouteName() == 'masa-tunggu.lulusan' ? 'active' : '' }}" href="{{ route('masa-tunggu.lulusan') }}">
                                <span class="nav-link-text ms-1">Lulusan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ Route::currentRouteName() == 'masa-tunggu.rata-rata' ? 'active' : '' }}" href="{{ route('masa-tunggu.rata-rata') }}">
                                <span class="nav-link-text ms-1">Rata-rata Masa Tunggu</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>