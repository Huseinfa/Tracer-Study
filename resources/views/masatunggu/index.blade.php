<x-layout bodyClass="g-sidenav-show bg-gray-200">
    @push('css')       
    @endpush
    <x-navbars.sidebar activePage="masa-tunggu" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Masa Tunggu" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-white border-radius-lg pt-4 pb-3">
                                <h6 class="text-primary mx-3 mb-0">Masa Tunggu Lulusan</h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <!-- Tabs Navigation -->
                            <ul class="nav nav-tabs" id="masaTungguTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="lulusan-tab" data-bs-toggle="tab" data-bs-target="#lulusan" 
                                        type="button" role="tab" aria-controls="lulusan" aria-selected="true">
                                        <i class="material-icons align-middle me-1">people</i> Data Lulusan
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ratarata-tab" data-bs-toggle="tab" data-bs-target="#ratarata" 
                                        type="button" role="tab" aria-controls="ratarata" aria-selected="false">
                                        <i class="material-icons align-middle me-1">assessment</i> Rata-rata Masa Tunggu
                                    </button>
                                </li>
                            </ul>
                            
                            <!-- Tabs Content -->
                            <div class="tab-content" id="masaTungguTabsContent">
                                <!-- Lulusan Tab -->
                                <div class="tab-pane fade show active" id="lulusan" role="tabpanel" aria-labelledby="lulusan-tab">
                                    <div class="card my-4 overflow-hidden">
                                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                            <div class="bg-white border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                                <h6 class="text-primary mx-3 mb-0">Lulusan dan Masa Tunggu</h6>
                                                <div class="me-3">
                                                    <span class="badge bg-primary text-white">
                                                        <i class="material-icons align-middle me-1" style="font-size: 1rem;">groups</i>
                                                        {{ $lulusan->total() }} Lulusan
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-0 pb-2">
                                            <!-- Search Form -->
                                            <div class="p-3 bg-light mb-3 mx-3 rounded-3 search-container">
                                                <form method="GET" action="{{ route('masa-tunggu') }}" class="mb-0">
                                                    <input type="hidden" name="tab" value="lulusan">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <div class="input-group input-group-dynamic flex-grow-1 me-2">
                                                            <span class="input-group-text"><i class="material-icons">search</i></span>
                                                            <input type="text" name="search" id="search" class="form-control" placeholder="Cari nama lulusan..." value="{{ request('search') }}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-search">
                                                            <i class="material-icons opacity-10">search</i> Cari
                                                        </button>
                                                        @if(request('search'))
                                                            <a href="{{ route('masa-tunggu', ['tab' => 'lulusan']) }}" class="btn btn-outline-secondary ms-2 btn-reset">
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
                                
                                <!-- Rata-rata Tab -->
                                <div class="tab-pane fade" id="ratarata" role="tabpanel" aria-labelledby="ratarata-tab">
                                    <div class="card my-4 overflow-hidden">
                                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                            <div class="bg-white border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                                <h6 class="text-primary mx-3 mb-0">Rata-rata Masa Tunggu</h6>
                                                <div class="me-3">
                                                    <span class="badge bg-primary text-white">
                                                        <i class="material-icons align-middle me-1" style="font-size: 1rem;">schedule</i>
                                                        Data dalam bulan
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-0 pb-2">
                                            <!-- Filter Form -->
                                            <div class="p-3 bg-light mb-3 mx-3 rounded-3 filter-container">
                                                <form method="GET" action="{{ route('masa-tunggu') }}" class="mb-0">
                                                    <input type="hidden" name="tab" value="ratarata">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <div class="input-group input-group-outline mb-0 me-2" style="width: 200px;">
                                                            <select name="year" id="year" class="form-control">
                                                                <option value="">Semua Tahun</option>
                                                                @foreach($years as $year)
                                                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-filter">
                                                            <i class="material-icons opacity-10">filter_list</i> Filter
                                                        </button>
                                                        @if($selectedYear)
                                                            <a href="{{ route('masa-tunggu', ['tab' => 'ratarata']) }}" class="btn btn-outline-secondary ms-2 btn-reset">
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
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Tahun Lulus</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Jumlah Lulusan</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Jumlah Lulusan yang Terlacak</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Rata-rata Waktu Tunggu (Bulan)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($data as $row)
                                                        <tr class="data-row">
                                                            <td>
                                                                <div class="d-flex px-2 py-1 ps-2">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{ $row->tahun_lulus }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{ $row->jumlah_lulusan }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{ $row->jumlah_terlacak }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{ number_format($row->rata_rata_tunggu ?? 0, 2) }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center py-4">
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <i class="material-icons text-secondary mb-2" style="font-size: 3rem;">hourglass_empty</i>
                                                                    <p class="text-secondary">Belum ada data rata-rata masa tunggu yang tersedia.</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforelse
                                                        <tr class="table-summary">
                                                            <td>
                                                                <div class="d-flex px-2 py-1 ps-2">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm fw-bold">Jumlah</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm fw-bold">{{ $totals['jumlah_lulusan'] }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm fw-bold">{{ $totals['jumlah_terlacak'] }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm fw-bold">{{ number_format($totals['rata_rata_tunggu'] ?? 0, 2) }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        /* Nav tabs styling */
        .nav-tabs {
            border-bottom: 1px solid #e91e63;
            margin-bottom: 20px;
        }
        
        .nav-tabs .nav-link {
            color: #495057;
            border: none;
            border-bottom: 2px solid transparent;
            margin-right: 10px;
            font-weight: 500;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            color: #e91e63;
            border-color: transparent;
            background-color: rgba(233, 30, 99, 0.05);
        }
        
        .nav-tabs .nav-link.active {
            color: #e91e63;
            background-color: transparent;
            border-bottom: 2px solid #e91e63;
        }
        
        /* Card animations */
        .card {
            transition: all 0.3s ease;
            transform-origin: center;
            overflow: visible !important;
            border-radius: 0.75rem;
            margin-top: 24px !important;
        }
        
        /* .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 13px 27px -5px rgba(50, 50, 93, 0.25), 0 8px 16px -8px rgba(0, 0, 0, 0.3);
            z-index: 1;
        } */
        
        /* Card header styling */
        .card-header {
            margin-top: -24px !important;
            overflow: visible;
        }
        
        .border-radius-lg {
            border-radius: 0.75rem !important;
            box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.05) !important;
        }
        
        /* Search container */
        .search-container, .filter-container {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            background-color: #ffffff !important;
            color: #333;
            border-radius: 0.5rem;
        }
        
        .search-container:hover, .filter-container:hover {
            border-left: 4px solid #e91e63;
            background-color: #ffffff !important;
            color: #333 !important;
        }
        
        /* Form elements */
        .input-group-dynamic input.form-control,
        #search.form-control, 
        .input-group-outline select.form-control,
        #year.form-control {
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
        .search-container:hover #search.form-control,
        .filter-container:hover #year.form-control {
            border: 1px solid #e91e63 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .search-container:hover .input-group-text {
            border: 1px solid #e91e63 !important;
            border-right: none !important;
        }
        
        /* Input group spacing */
        .input-group-dynamic, .input-group-outline {
            margin-right: 15px !important;
        }
        
        /* Button spacing */
        .btn-search, .btn-filter {
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
        
        /* Table summary styling */
        .table-summary {
            background-color: #f8f8f8;
            font-weight: bold;
            animation: fadeIn 0.5s ease-out;
        }
        
        .table-summary td {
            background-color: #fce4ec !important;
            border-top: 2px solid #e91e63;
        }
        
        .table-summary h6.text-sm {
            color: #000000 !important;
            font-weight: 700;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>

    <!-- Tab switching script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the active tab from URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab') || 'lulusan';
            
            // Activate the correct tab
            const tabElement = document.getElementById(tab + '-tab');
            if (tabElement) {
                const tabTrigger = new bootstrap.Tab(tabElement);
                tabTrigger.show();
            }
        });
    </script>
</x-layout>