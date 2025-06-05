@props(['titlePage'])

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" 
                       class="nav-link text-body px-3 py-2 sign-out-btn"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .sign-out-btn {
        background: linear-gradient(195deg, #42424a 0%, #191919 100%);
        color: #fff !important;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .sign-out-btn i, 
    .sign-out-btn span {
        color: #fff;
    }
    
    .sign-out-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        background: linear-gradient(195deg, #666666 0%, #333333 100%);
    }
</style>