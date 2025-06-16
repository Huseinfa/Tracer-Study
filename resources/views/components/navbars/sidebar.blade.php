@props(['activePage'])

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark shadow" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center justify-content-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo.png" class="navbar-brand-img h-100 px-1" alt="main_logo">
            <span class="text-white px-1" style="font-family: 'Quicksand', sans-serif; font-size: 1.3rem; font-weight: 600; letter-spacing: 0.5px;">
                Tracer Study
            </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-info' : '' }}" href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-house-door"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Kelola Data</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'admin' ? ' active bg-gradient-info' : '' }}" href="{{ route('admin.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-person"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'lulusan' ? ' active bg-gradient-info' : '' }}" href="{{ route('lulusan.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-mortarboard"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lulusan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'stakeholder' ? ' active bg-gradient-info' : '' }}" href="{{ route('stakeholder.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-buildings"></i>
                    </div>
                    <span class="nav-link-text ms-1">Stakeholder</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profesi' ? ' active bg-gradient-info' : '' }}" href="{{ route('profesi.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-person-vcard"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profesi</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Hasil Survey</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'masa-tunggu' ? ' active bg-gradient-info' : '' }}" href="{{ route('masa-tunggu.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-hourglass-split"></i>
                    </div>
                    <span class="nav-link-text ms-1">Masa Tunggu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'laporan' ? ' active bg-gradient-info' : '' }}" href="{{ route('laporan.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 bi bi-printer"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
