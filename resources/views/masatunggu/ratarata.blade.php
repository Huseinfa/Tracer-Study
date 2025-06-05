<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="masa-tunggu" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Rata-rata Masa Tunggu" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4 overflow-hidden">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white mx-3 mb-0">Rata-rata Masa Tunggu</h6>
                                <div class="me-3">
                                    <span class="badge bg-light text-dark">
                                        <i class="material-icons align-middle me-1" style="font-size: 1rem;">schedule</i>
                                        Data dalam bulan
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <!-- Filter Form -->
                            <div class="p-3 bg-light mb-3 mx-3 rounded-3 filter-container">
                                <form method="GET" action="{{ route('masa-tunggu.rata-rata') }}" class="mb-0">
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
                                            <a href="{{ route('masa-tunggu.rata-rata') }}" class="btn btn-outline-secondary ms-2 btn-reset">
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
            <x-footers.auth />
        </div>
    </main>

    <!-- Consolidated styles -->
    <style>
        /* Card styling */
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
        
        .card-header {
            margin-top: -24px !important;
            overflow: visible;
        }
        
        .bg-gradient-primary {
            border-radius: 0.75rem !important;
            box-shadow: 0 4px 20px 0 #ffffff !important;
        }
        
        /* Filter container */
        .filter-container {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            background-color: #ffffff !important;
            color: #333;
            border-radius: 0.5rem;
            padding: 15px !important;
        }
        
        .filter-container:hover {
            border-left: 4px solid #e91e63;
        }
        
        /* Form elements */
        .input-group-outline select.form-control,
        #year.form-control {
            background-color: #ffffff !important;
            color: #333333 !important;
            border: 1px solid #dddddd !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .filter-container:hover #year.form-control {
            border: 1px solid #e91e63 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .filter-container .input-group-outline {
            margin-right: 15px !important;
        }
        
        /* Button animations */
        .btn-filter, .btn-reset {
            transition: all 0.3s ease;
        }
        
        .btn-filter:hover, .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 7px -1px rgba(0, 0, 0, 0.11), 0 2px 4px -1px rgba(0, 0, 0, 0.07);
        }
        
        .btn-filter {
            margin-left: 10px;
        }
        
        .btn-reset {
            margin-left: 10px;
        }
        
        /* Table styling */
        .data-table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .data-table thead th {
            background-color: #f3f3f3;
            color: #344767;
            font-weight: 700;
            border-top: 0;
            border-bottom: 1px solid #e3e3e3;
            padding: 12px 8px;
        }
        
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
        
        /* Badge styling */
        .badge {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</x-layout>