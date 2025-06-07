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
            <ul class="navbar-nav ms-md-auto pe-md-3 d-flex justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0 d-flex flex-row align-items-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Halo,
                        <h6 class="mb-0 mx-1">
                            @auth
                            {{ Auth::user()->nama_user }}
                            @endauth
                        </h6>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                                @csrf
                            </form>
                            <a href="javascript:;" class="dropdown-item border-radius-md" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <div class="d-flex py-1">
                                    <div class="me-3 my-auto">
                                        <i class="material-icons opacity-10 bi bi-power d-flex justify-content-center"></i>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">Sign Out</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
