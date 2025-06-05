<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="masa-tunggu" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Lulusan" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4 overflow-hidden">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white mx-3 mb-0">Lulusan dan Masa Tunggu</h6>
                                <div class="me-3">
                                    <span class="badge bg-light text-dark">
                                        <i class="material-icons align-middle me-1" style="font-size: 1rem;">groups</i>
                                        {{ $lulusan->total() }} Lulusan
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <!-- Search Form -->
                            <div class="p-3 bg-light mb-3 mx-3 rounded-3 search-container">
                                <form method="GET" action="{{ route('masa-tunggu.lulusan') }}" class="mb-0">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="input-group input-group-dynamic flex-grow-1 me-2">
                                            <span class="input-group-text"><i class="material-icons">search</i></span>
                                            <input type="text" name="search" id="search" class="form-control" placeholder="Cari nama lulusan..." value="{{ request('search') }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-search">
                                            <i class="material-icons opacity-10">search</i> Cari
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('masa-tunggu.lulusan') }}" class="btn btn-outline-secondary ms-2 btn-reset">
                                                <i class="material-icons opacity-10">clear</i> Reset
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Data Table -->
                            <div class="table-responsive p-0 mx-3">
                                <table class="table align-items-center mb-0 data-table">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">NIM</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Nama</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Program Studi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Tanggal Lulus</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Tanggal Pertama Bekerja</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Masa Tunggu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lulusan->items() as $lulus)
                                            <tr class="data-row">
                                                <td>
                                                    <div class="d-flex px-2 py-1 ps-2">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $lulus->nim }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $lulus->nama_lulusan }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $lulus->prodi->nama_prodi ?? '-' }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $lulus->tanggal_lulus }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $lulus->kuisionerlulusan->tanggal_pertama_berkerja ?? '-' }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        @if($lulus->kuisionerlulusan && $lulus->kuisionerlulusan->tanggal_pertama_berkerja)
                                                            @php
                                                                $months = \Carbon\Carbon::parse($lulus->tanggal_lulus)->diffInMonths($lulus->kuisionerlulusan->tanggal_pertama_berkerja);
                                                            @endphp
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    <span class="badge bg-{{ $months <= 3 ? 'success' : ($months <= 6 ? 'info' : ($months <= 12 ? 'warning' : 'danger')) }} text-white">
                                                                        {{ $months }} bulan
                                                                    </span>
                                                                </h6>
                                                            </div>
                                                        @else
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">-</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i class="material-icons text-secondary mb-2" style="font-size: 3rem;">people_alt</i>
                                                        <p class="text-secondary">Belum ada data lulusan yang tersedia.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="pagination-container p-3 mx-3">
                                {{ $lulusan->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth />
        </div>
    </main>

    <!-- Consolidated styles -->
    <style>
        /* Card animations */
        .card {
            transition: all 0.3s ease;
            transform-origin: center;
            overflow: visible !important;
            border-radius: 0.75rem;
            margin-top: 24px !important;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 13px 27px -5px rgba(50, 50, 93, 0.25), 0 8px 16px -8px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
        
        /* Card header styling */
        .card-header {
            margin-top: -24px !important;
            overflow: visible;
        }
        
        .bg-gradient-primary {
            border-radius: 0.75rem !important;
            box-shadow: 0 4px 20px 0 #ffffff !important;
        }
        
        /* Search container */
        .search-container {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            background-color: #ffffff !important;
            color: #333;
            border-radius: 0.5rem;
        }
        
        .search-container:hover {
            border-left: 4px solid #e91e63;
            background-color: #ffffff !important;
            color: #333 !important;
        }
        
        /* Form elements */
        .input-group-dynamic input.form-control,
        #search.form-control {
            background-color: #ffffff !important;
            color: #333333 !important;
            border: 1px solid #dddddd !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .input-group-dynamic .input-group-text {
            background-color: #ffffff !important;
            color: #333333 !important;
            border: 1px solid #dddddd !important;
            border-right: none !important;
        }
        
        .search-container:hover input.form-control,
        .search-container:hover #search.form-control {
            border: 1px solid #e91e63 !important;
            border-left: none !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .search-container:hover .input-group-text {
            border: 1px solid #e91e63 !important;
            border-right: none !important;
        }
        
        /* Input group spacing */
        .input-group-dynamic {
            margin-right: 15px !important;
        }
        
        /* Button spacing */
        .btn-search {
            margin-left: 15px;
        }
        
        .btn-reset {
            margin-left: 10px;
        }
        
        /* Table styling */
        .data-table tbody td {
            background-color: #ffffff !important;
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .data-table tbody h6.text-sm {
            color: #000000 !important;
            font-weight: 600;
        }
        
        .data-table tbody tr:nth-child(even) td {
            background-color: #fafafa !important;
        }
        
        /* Row hover effects */
        .data-row {
            position: relative;
            transition: all 0.2s ease;
        }
        
        .data-row:hover {
            transform: translateX(3px);
        }
        
        .data-row:hover td {
            background-color: #fce4ec !important;
        }
        
        .data-row::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background: #e91e63;
            transition: width 0.4s ease;
        }
        
        .data-row:hover::after {
            width: 100%;
        }
        
        /* Badge styling */
        .badge {
            font-weight: 600 !important;
        }
        
        .badge.bg-success, .badge.bg-info, .badge.bg-warning, .badge.bg-danger {
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        
        /* Remove search icon */
        .search-container .input-group-append {
            display: none;
        }
    </style>
</x-layout>