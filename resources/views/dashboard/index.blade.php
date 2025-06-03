<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Lulusan</p>
                                <h4 class="mb-0">{{ $lulusanCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">N/A</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">group</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Stakeholder</p>
                                <h4 class="mb-0">{{ $stakeholderCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">N/A</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">school</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Prodi</p>
                                <h4 class="mb-0">{{ $prodiCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">N/A</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">work</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Profesi</p>
                                <h4 class="mb-0">{{ $profesiCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">N/A</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Kuisioner Lulusan</h6>
                            <p class="text-sm ">Persentase Pengisian: {{ $lulusanFilledPercentage }}%</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">Updated today</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Kuisioner Stakeholder</h6>
                            <p class="text-sm ">Total Pengisian: {{ $stakeholderCount }}</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">Updated today</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Prodi Aktif</h6>
                            <p class="text-sm ">Total: {{ $prodiCount }}</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">Updated today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Lulusan Terkini</h6>
                                    <p class="text-sm mb-0">
                                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1">{{ $lulusanCount }} terdaftar</span> bulan ini
                                    </p>
                                </div>
                                <div class="col-lg-6 col-5 my-auto text-end">
                                    <div class="dropdown float-lg-end pe-4">
                                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-secondary"></i>
                                        </a>
                                        <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lulusan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Prodi</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lulus</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentLulusan as $lulusan)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $lulusan->nama_lulusan }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $lulusan->prodi->nama_prodi }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">{{ $lulusan->tanggal_lulus }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">{{ $lulusan->sudah_mengisi ? 'Selesai' : 'Belum' }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar {{ $lulusan->sudah_mengisi ? 'bg-gradient-success' : 'bg-gradient-warning' }} w-{{ $lulusan->sudah_mengisi ? 100 : 25 }}"
                                                            role="progressbar" aria-valuenow="{{ $lulusan->sudah_mengisi ? 100 : 25 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Update Terkini</h6>
                            <p class="text-sm">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">Aktivitas Terbaru</span>
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="material-icons text-success text-gradient">notifications</i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Lulusan Baru Ditambahkan</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ now()->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="material-icons text-info text-gradient">edit</i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Kuisioner Diperbarui</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ now()->subHours(2)->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step">
                                        <i class="material-icons text-primary text-gradient">person_add</i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Stakeholder Baru</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ now()->subDay()->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</x-layout>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun"],
            datasets: [{
                label: "Kuisioner Lulusan",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "rgba(255, 255, 255, .8)",
                data: [{{ $lulusanFilled }}, 0, 0],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            interaction: { intersect: false, mode: 'index' },
            scales: {
                y: { grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' }, ticks: { suggestedMin: 0, suggestedMax: {{ max($lulusanCount, 100) }}, beginAtZero: true, padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 }, color: "#fff" } },
                x: { grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' }, ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } } },
            },
        },
    });

    var ctx2 = document.getElementById("chart-line").getContext("2d");
    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun"],
            datasets: [{
                label: "Kuisioner Stakeholder",
                tension: 0,
                borderWidth: 0,
                pointRadius: 5,
                pointBackgroundColor: "rgba(255, 255, 255, .8)",
                pointBorderColor: "transparent",
                borderColor: "rgba(255, 255, 255, .8)",
                borderWidth: 4,
                backgroundColor: "transparent",
                fill: true,
                data: [{{ $stakeholderCount }}, 0, 0],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            interaction: { intersect: false, mode: 'index' },
            scales: {
                y: { grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' }, ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } } },
                x: { grid: { drawBorder: false, display: false, drawOnChartArea: false, drawTicks: false, borderDash: [5, 5] }, ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } } },
            },
        },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");
    new Chart(ctx3, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun"],
            datasets: [{
                label: "Prodi Aktif",
                tension: 0,
                borderWidth: 0,
                pointRadius: 5,
                pointBackgroundColor: "rgba(255, 255, 255, .8)",
                pointBorderColor: "transparent",
                borderColor: "rgba(255, 255, 255, .8)",
                borderWidth: 4,
                backgroundColor: "transparent",
                fill: true,
                data: [{{ $prodiCount }}, 0, 0],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            interaction: { intersect: false, mode: 'index' },
            scales: {
                y: { grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5], color: 'rgba(255, 255, 255, .2)' }, ticks: { display: true, padding: 10, color: '#f8f9fa', font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } } },
                x: { grid: { drawBorder: false, display: false, drawOnChartArea: false, drawTicks: false, borderDash: [5, 5] }, ticks: { display: true, color: '#f8f9fa', padding: 10, font: { size: 14, weight: 300, family: "Roboto", style: 'normal', lineHeight: 2 } } },
            },
        },
    });
</script>
@endpush