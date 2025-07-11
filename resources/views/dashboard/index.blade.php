<x-layout bodyClass="g-sidenav-show bg-gray-200">
    @push('css')
        <style>
            /* Search box */
            .dataTables_wrapper .dataTables_filter input {
                border-radius: 8px;
                border: 2px solid #e0e0e0;
                padding: 6px 12px;
                color: #344767;
                background: #f8fafc;
                transition: border 0.2s;
                outline: none;
            }
            .dataTables_wrapper .dataTables_filter input:focus {
                border: 2px solid #17c1e8;
                background: #fff;
            }
        </style>
    @endpush
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <div class="container-fluid py-4">            
            <div class="row">
                <div class="col-md-12">
                    <div class="card px-0">
                        <div class="card-body p-0">
                            <form action="{{ url('dashboard') }}" method="GET" class="d-flex flex-row justify-content-end">
                                <div class="input-group input-group-outline m-2" style="width: 150px;">
                                    <label for="prodi" class="form-label">Program Studi</label>
                                    <select name="prodi" id="prodi" class="form-control p-0">
                                        <option value="1" {{ request('prodi', '1') == '1' ? 'selected' : '' }}>D4 TI</option>
                                        <option value="2" {{ request('prodi') == '2' ? 'selected' : '' }}>D4 SIB</option>
                                        <option value="3" {{ request('prodi') == '3' ? 'selected' : '' }}>D2 PPLS</option>
                                        <option value="4" {{ request('prodi') == '4' ? 'selected' : '' }}>S2 MRTI</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-outline m-2" style="width: 150px">
                                    <label for="start_year" class="form-label">Tahun Awal</label>
                                    <input type="number" name="start_year" id="start_year" class="form-control p-0" value="{{ request('start_year', now()->year - 3) }}">
                                </div>
                                <div class="input-group input-group-outline m-2" style="width: 150px">
                                    <label for="end_year" class="form-label">Tahun Akhir</label>
                                    <input type="number" name="end_year" id="end_year" class="form-control p-0" value="{{ request('end_year', now()->year ) }}">
                                </div>
                                <button type="submit" class="btn btn-info m-2" style="width: 100px">Filter</button>
                                <a href="{{ url('dashboard') }}" class="btn btn-secondary m-2" style="width: 100px">Reset</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Statistics Cards Start --}}
            <div class="row mt-4">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="container-fluid text-center">
                                    <div class="row justify-content-between px-2">
                                        <p class="text-sm mb-1 text-capitalize font-weight-bold text-start">Jumlah Lulusan</p>
                                    </div>
                                    <div class="row text-end">
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $lulusanCount }}
                                            <span class="font-weight-normal text-secondary"> lulusan</span>
                                        </h5>
                                    </div>
                                    <div class="row">
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="container text-center">
                                    <div class="row justify-content-between px-2">
                                        <p class="text-sm mb-1 text-capitalize font-weight-bold text-start">Sudah Mengisi</p>
                                    </div>
                                    <div class="row text-end">
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $lulusanFilled }}
                                            <span class="font-weight-normal text-secondary"> lulusan</span>
                                        </h5>
                                    </div>
                                    <div class="row text-start">
                                        <div class="col text-start">
                                            <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">
                                                {{ $lulusanFilledPercentage }}%
                                                <span class="font-weight-normal text-secondary">dari total lulusan</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="container text-center">
                                    <div class="row justify-content-between px-2">
                                        <p class="text-sm mb-1 text-capitalize font-weight-bold text-start">Belum Mengisi</p>
                                    </div>
                                    <div class="row text-end">
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $lulusanNotFilled }}
                                            <span class="font-weight-normal text-secondary"> lulusan</span>
                                        </h5>
                                    </div>
                                    <div class="row text-start">
                                        <div class="col text-start">
                                            <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">
                                                {{ 100 - $lulusanFilledPercentage }}%
                                                <span class="font-weight-normal text-secondary">dari total lulusan</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="container text-center">
                                    <div class="row justify-content-between px-2">
                                        <p class="text-sm mb-1 text-capitalize font-weight-bold text-start">Rata-rata Masa Tunggu</p>
                                    </div>
                                    <div class="row text-end">
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $averageWaitingTime }}
                                        </h5>
                                    </div>
                                    <div class="row text-start">
                                        <div class="col text-start">
                                            <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">
                                                <span class="font-weight-normal text-secondary">dari </span>
                                                {{ $lulusanFilled }}
                                                <span class="font-weight-normal text-secondary"> lulusan</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Statistics Cards End --}}
                
            {{-- Pie Charts Start --}}

            {{-- pie chart sebaran profesi --}}
            <div class="row mt-4">
                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="mb-0">Sebaran Profesi Lulusan</h6>
                                </div>
                                <div class="col-md-4">
                                    <span>(10 teratas)</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <div class="row">
                                @if($total > 0)
                                    <div class="chart">
                                        <canvas id="profesiChart" class="chart-canvas" style="height: 250px;"></canvas>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <p class="text-secondary">Tidak ada data profesi yang tersedia.</p>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-3 justify-content-center">
                                @foreach($profesilabels as $i => $label)
                                    <div class="col-auto">
                                        <span class="badge badge-md badge-dot d-block text-start">
                                            <i class="bi bi-circle-fill" style="color: {{ ['#3498DB', '#2ECC71', '#F1C40F', '#E67E22', '#E74C3C', '#9B59B6', '#1ABC9C', '#34495E', '#F39C12', '#7F8C8D', '#BDC3C7'][$i] }};"></i>
                                            <span class="text-dark text-xs">{{ $label }}</span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- pie chart jenis instansi --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Sebaran Jenis Instansi</h6>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <div class="row">
                                @if($totalInstansi > 0)
                                    <div class="chart">
                                        <canvas id="instansiChart" class="chart-canvas" style="height: 250px;"></canvas>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <p class="text-secondary">Tidak ada data jenis instansi yang tersedia.</p>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-3 justify-content-center">
                                @foreach($instansiLabels as $i => $label)
                                    <div class="col-auto">
                                        <span class="badge badge-md badge-dot d-block text-start">
                                            <i class="bi bi-circle-fill" style="color: {{ ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'][$i] ?? '#BDC3C7' }};"></i>
                                            <span class="text-dark text-xs">{{ $label }}</span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- pie chart penilaian kepuasan --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row pb-2">
                                <h6 class="mb-0">Penilaian Kepuasan Pengguna Lulusan</h6>
                            </div>
                            <div class="row mx-auto w-75">
                                <select class="btn btn-outline-info my-2 text-center" id="chartSelector" aria-label="Pilih chart">
                                    @foreach ($evaluationData as $field => $data)
                                        <option value="{{ $field }}">{{ $data['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body p-3 pt-1 pb-0">
                            @if(count($evaluationData) > 0 && collect($evaluationData)->sum('total') > 0)
                                <div class="row">
                                    @foreach ($evaluationData as $field => $data)
                                        <div class="chart d-none" id="{{ $field }}-container" style="height: 200px;">
                                            <canvas id="{{ $field }}Chart" class="chart-canvas" height="200"></canvas>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mt-3 justify-content-center">
                                    @foreach($evaluationLabels as $i => $label)
                                        <div class="col-auto">
                                            <span class="badge badge-md badge-dot d-block text-start">
                                                <i class="bi bi-circle-fill" style="color: {{ ['#E74C3C', '#F39C12', '#F1C40F', '#2ECC71', '#3498DB'][$i] ?? '#BDC3C7' }};"></i>
                                                <span class="text-dark text-xs">{{ $label }}</span>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <p class="text-secondary">Tidak ada data penilaian kepuasan yang tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Pie Charts End --}}

            {{-- Tabel Kepuasan Start --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Tabel Penilaian Kepuasan Pengguna Lulusan</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder" rowspan="2" style="width: 40px;">No</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder" rowspan="2">Jenis Kemampuan</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder" colspan="5">Tingkat Kepuasan Pengguna (%)</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Sangat Baik</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Baik</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Cukup</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kurang</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Sangat Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($kepuasanTableData) && count($kepuasanTableData['data']) > 0)
                                            @foreach($kepuasanTableData['data'] as $index => $item)
                                            <tr>
                                                <td>
                                                    <p class="text-sm text-center font-weight-normal text-secondary mb-0">{{ $index + 1 }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-start font-weight-normal text-secondary mb-0">{{ $item['label'] }}</p>
                                                </td>
                                                <!-- Sangat Baik (5) -->
                                                <td>
                                                    <p class="text-sm text-center font-weight-normal text-secondary mb-0">
                                                        {{ $item['percentages'][4] }}%
                                                    </p>
                                                </td>
                                                <!-- Baik (4) -->
                                                <td>
                                                    <p class="text-sm text-center font-weight-normal text-secondary mb-0">
                                                        {{ $item['percentages'][3] }}%
                                                    </p>
                                                </td>
                                                <!-- Cukup (3) -->
                                                <td>
                                                    <p class="text-sm text-center font-weight-normal text-secondary mb-0">
                                                        {{ $item['percentages'][2] }}%
                                                    </p>
                                                </td>
                                                <!-- Kurang (2) -->
                                                <td>
                                                    <p class="text-sm text-center font-weight-normal text-secondary mb-0">
                                                        {{ $item['percentages'][1] }}%
                                                    </p>
                                                </td>
                                                <!-- Sangat Kurang (1) -->
                                                <td>
                                                    <p class="text-sm text-center font-weight-normal text-secondary mb-0">
                                                        {{ $item['percentages'][0] }}%
                                                    </p>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- Row Total/Jumlah -->
                                            <tr style="background-color: #e9ecef; font-weight: bold;">
                                                <td colspan="2" class="text-center">
                                                    <p class="text-sm font-weight-bolder text-dark mb-0">Jumlah</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-center font-weight-bolder text-dark mb-0">
                                                        {{ $kepuasanTableData['totals']['percentages'][4] }}%
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-center font-weight-bolder text-dark mb-0">
                                                        {{ $kepuasanTableData['totals']['percentages'][3] }}%
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-center font-weight-bolder text-dark mb-0">
                                                        {{ $kepuasanTableData['totals']['percentages'][2] }}%
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-center font-weight-bolder text-dark mb-0">
                                                        {{ $kepuasanTableData['totals']['percentages'][1] }}%
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-center font-weight-bolder text-dark mb-0">
                                                        {{ $kepuasanTableData['totals']['percentages'][0] }}%
                                                    </p>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <p class="text-secondary">Tidak ada data penilaian kepuasan yang tersedia.</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tabel kepuasan End --}}

            {{-- Tabel Lingkup Tempat Kerja Start --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Tabel Sebaran Lingkup Tempat Kerja</h6>
                        </div>
                        <div class="card-body p-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table table-bordered align-items-center mb-0" id="lingkup-tempat-kerja-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2" rowspan="2">Tahun Lulus</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2" rowspan="2">Jumlah Lulusan</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2" rowspan="2">Lulusan terlacak</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2" rowspan="2">Bidang Infokom</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2" rowspan="2">Bidang Non Infokom</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2" colspan="3">Lingkup Tempat Kerja</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2">Internasional</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2">Nasional</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2">Wirausaha</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2">Jumlah</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder p-2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tabel Lingkup Tempat Kerja End --}}
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    
    @push('js')
        <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
        <script>
            $(function() {
                var text_val = $(".input-group input").val();
                if (text_val === "") {
                    $(".input-group").removeClass('is-filled');
                } else {
                    $(".input-group").addClass('is-filled');
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                @if (session('validation_errors'))
                    var errors = @json(session('validation_errors'));
                    var errorMessage = '';
                    
                    if (errors.length === 1) {
                        errorMessage = errors[0];
                    } else {
                        errorMessage = '<ul style="text-align: left; margin: 0; padding-left: 20px;">';
                        errors.forEach(function(error) {
                            errorMessage += '<li>' + error + '</li>';
                        });
                        errorMessage += '</ul>';
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal!',
                        html: errorMessage,
                        confirmButtonText: 'Tutup',
                        customClass: {
                            confirmButton: 'btn btn-secondary'
                        },
                        buttonsStyling: false
                    });
                @endif
            });
        </script>

        {{-- pie chart start --}}
        <script>
            document.getElementById('chartSelector').addEventListener('change', function() {
                const selected = this.value;
                @foreach($evaluationData as $field => $data)
                    document.getElementById('{{ $field }}-container').classList.toggle('d-none', '{{ $field }}' !== selected);
                @endforeach
            });
        </script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const containers = document.querySelectorAll('[id$="-container"]'); // ambil semua container chart
                if (containers.length > 0) containers[0].classList.remove('d-none'); // menghapus kelas d-none dari container pertama

                const selector = document.getElementById('chartSelector'); // Set select ke chart pertama
                if (selector && selector.options.length > 0) {
                    selector.value = selector.options[0].value;
                }
            });
        </script>

        @if($total > 0)
            <script>
                // Setup the profesi pie chart
                var ctx = document.getElementById('profesiChart').getContext('2d');
                new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: {!! json_encode($profesilabels) !!},
                        datasets: [{
                            label: "Projects",
                            weight: 9,
                            cutout: 0,
                            tension: 0.9,
                            pointRadius: 2,
                            borderWidth: 1,
                            backgroundColor: ['#3498DB', '#2ECC71', '#F1C40F', '#E67E22', '#E74C3C', '#9B59B6', '#1ABC9C', '#34495E', '#F39C12', '#7F8C8D', '#BDC3C7'],
                            data: {!! json_encode($profesipercentages) !!},
                            fill: false
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                display: false,
                                position: 'bottom',
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.chart.data.labels[context.dataIndex] || '';
                                        let value = context.formattedValue || '0';
                                        return label + ': ' + value + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        @endif
        
        @if($totalInstansi > 0)
            <script>
                // Setup the instansi pie chart
                var ctxInstansi = document.getElementById('instansiChart').getContext('2d');
                var instansiChart = new Chart(ctxInstansi, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($instansiLabels) !!},
                        datasets: [{
                            label: "Projects",
                            weight: 9,
                            cutout: 0,
                            tension: 0.9,
                            pointRadius: 2,
                            borderWidth: 1,
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                            data: {!! json_encode($instansiPercentages) !!},
                            fill: false
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                display: false,
                                position: 'bottom',
                            },
                            title: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ' + context.formattedValue + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        @endif
        
        <!-- Stakeholder Evaluation Charts -->
        <script>
            // Color arrays for the evaluation charts
            const evaluationColors = ['#E74C3C', '#F39C12', '#F1C40F', '#2ECC71', '#3498DB'];
            
            // Setup the evaluation pie charts
            @foreach($evaluationData as $field => $data)
                @if($data['total'] > 0)
                var ctx{{ $field }} = document.getElementById('{{ $field }}Chart').getContext('2d');
                new Chart(ctx{{ $field }}, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($evaluationLabels) !!},
                        datasets: [{
                            label: "Projects",
                            weight: 9,
                            cutout: 0,
                            tension: 0.9,
                            pointRadius: 2,
                            borderWidth: 1,
                            backgroundColor: evaluationColors,
                            data: {!! json_encode($data['percentages']) !!},
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                display: false,
                                position: 'bottom',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ' + context.formattedValue + '%';
                                    }
                                }
                            }
                        }
                    }
                });
                @endif
            @endforeach
        </script>
        {{-- pie chart end --}}

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                var currentProdi = "{{ request('prodi', '1') }}";
                var currentStartYear = "{{ request('start_year', now()->year - 4) }}";
                var currentEndYear = "{{ request('end_year', now()->year - 1) }}";
                
                var tableSkala = $('#lingkup-tempat-kerja-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/dashboard/skala-instansi') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: function(d) {
                            d.prodi = currentProdi;
                            d.start_year = currentStartYear;
                            d.end_year = currentEndYear;
                        },
                    },
                    columns: [
                        { data: 'tahun_lulus', name: 'tahun_lulus', className: 'text-center' },
                        { data: 'jumlah_lulusan', name: 'jumlah_lulusan', className: 'text-center' },
                        { data: 'lulusan_terlacak', name: 'lulusan_terlacak', className: 'text-center' },
                        { data: 'bidang_infokom', name: 'bidang_infokom', className: 'text-center' },
                        { data: 'bidang_non_infokom', name: 'bidang_non_infokom', className: 'text-center' },
                        { data: 'internasional', name: 'internasional', className: 'text-center' },
                        { data: 'nasional', name: 'nasional', className: 'text-center' },
                        { data: 'wirausaha', name: 'wirausaha', className: 'text-center' }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        },
                    },
                    footerCallback: function (row, data, start, end, display) {
                        var api = this.api();
                        
                        var intVal = function (i) {
                            return typeof i === 'string' ?
                                parseInt(i.replace(/[\$,]/g, '')) || 0 :
                                typeof i === 'number' ? i : 0;
                        };
                        
                        var jumlahLulusan = api.column(1).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        var jumlahTerlacak = api.column(2).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        var infokom = api.column(3).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        var nonInfokom = api.column(4).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        var internasional = api.column(5).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        var nasional = api.column(6).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        var wirausaha = api.column(7).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                        
                        // Update footer
                        $(api.column(0).footer()).html('<strong>Jumlah</strong>');
                        $(api.column(1).footer()).html('<strong>' + jumlahLulusan + '</strong>');
                        $(api.column(2).footer()).html('<strong>' + jumlahTerlacak + '</strong>');
                        $(api.column(3).footer()).html('<strong>' + infokom + '</strong>');
                        $(api.column(4).footer()).html('<strong>' + nonInfokom + '</strong>');
                        $(api.column(5).footer()).html('<strong>' + internasional + '</strong>');
                        $(api.column(6).footer()).html('<strong>' + nasional + '</strong>');
                        $(api.column(7).footer()).html('<strong>' + wirausaha + '</strong>');
                    }
                });
            });
        </script>
    @endpush
</x-layout>