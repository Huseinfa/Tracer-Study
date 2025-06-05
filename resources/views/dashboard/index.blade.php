<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <!-- Add card animations -->
            <style>
                .card {
                    transition: all 0.3s ease;
                    transform-origin: center;
                }
                
                .card:hover {
                    transform: translateY(-7px) scale(1.01);
                    box-shadow: 0 13px 27px -5px rgba(50, 50, 93, 0.25), 0 8px 16px -8px rgba(0, 0, 0, 0.3);
                    z-index: 1;
                }
                
                .chart-container {
                    transition: all 0.3s ease;
                }
                
                .card:hover .chart-container {
                    transform: scale(1.02);
                }
                
                .card-header .icon {
                    transition: all 0.4s ease;
                }
                
                .card:hover .card-header .icon {
                    transform: scale(1.1) rotate(5deg);
                }
            </style>
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <!-- Card 1: Filled Out Questionnaire -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">assignment_turned_in</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Sudah Mengisi</p>
                                <h4 class="mb-0">{{ $lulusanFilled }} Lulusan</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{ $lulusanFilledPercentage }}% </span>dari total lulusan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 2: Not Filled Out Questionnaire -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">assignment_late</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Belum Mengisi</p>
                                <h4 class="mb-0">{{ $lulusanNotFilled }} Lulusan</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">{{ 100 - $lulusanFilledPercentage }}% </span>dari total lulusan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 3: Average Waiting Time -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">schedule</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Rata-rata Masa Tunggu</p>
                                <h4 class="mb-0">{{ $averageWaitingTime }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">Total {{ $averageDays }} hari setelah kelulusan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 4: Most Common Profession -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">work</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Profesi Terpopuler</p>
                                <h4 class="mb-0">{{ $mostCommonProfesi->profesi ?? 'Belum ada data' }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            @if($mostCommonProfesi)
                                <p class="mb-0">{{ $mostCommonProfesi->count }} lulusan ({{ round(($mostCommonProfesi->count / $total) * 100, 1) }}%)</p>
                            @else
                                <p class="mb-0">Belum ada data profesi</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Existing Charts -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Grafik Sebaran Profesi Lulusan (10 profesi dengan persentase tertinggi)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if($total > 0)
                                <div class="chart-container" style="position: relative; height:60vh; width:90%; margin: auto;">
                                    <canvas id="profesiChart"></canvas>
                                </div>
                            @else
                                <div class="text-center p-5">
                                    <p>Belum ada data profesi lulusan yang tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Grafik Sebaran Jenis Instansi</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if($totalInstansi > 0)
                                <div class="chart-container" style="position: relative; height:60vh; width:90%; margin: auto;">
                                    <canvas id="instansiChart"></canvas>
                                </div>
                            @else
                                <div class="text-center p-5">
                                    <p>Belum ada data jenis instansi yang tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Rest of the content (Stakeholder Evaluation Charts) -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Grafik Penilaian Kompetensi Lulusan oleh Stakeholder</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row">
                                @foreach($evaluationData as $field => $data)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">{{ $data['title'] }}</h6>
                                            </div>
                                            <div class="card-body">
                                                @if($data['total'] > 0)
                                                    <div class="chart-container" style="position: relative; height:30vh; margin: auto;">
                                                        <canvas id="{{ $field }}Chart"></canvas>
                                                    </div>
                                                @else
                                                    <div class="text-center p-3">
                                                        <p>Belum ada data penilaian {{ $data['title'] }} yang tersedia.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    
    <!-- Keep all your existing JavaScript -->
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    
    @if($total > 0)
    <script>
        // Setup the profesi pie chart
        var ctx = document.getElementById('profesiChart').getContext('2d');
        var profesiChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    data: {!! json_encode($percentages) !!},
                    backgroundColor: [
                        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', 
                        '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const meta = chart.getDatasetMeta(0);
                                        const style = meta.controller.getStyle(i);
                                        return {
                                            text: label + ': ' + data.datasets[0].data[i] + '%',
                                            fillStyle: style.backgroundColor,
                                            strokeStyle: style.borderColor,
                                            lineWidth: style.borderWidth,
                                            hidden: isNaN(data.datasets[0].data[i]) || meta.data[i].hidden,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
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
                    data: {!! json_encode($instansiPercentages) !!},
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#8CC152', '#5D9CEC', '#EC87C0', '#AC92EC'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const meta = chart.getDatasetMeta(0);
                                        const style = meta.controller.getStyle(i);
                                        return {
                                            text: label + ': ' + data.datasets[0].data[i] + '%',
                                            fillStyle: style.backgroundColor,
                                            strokeStyle: style.borderColor,
                                            lineWidth: style.borderWidth,
                                            hidden: isNaN(data.datasets[0].data[i]) || meta.data[i].hidden,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
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
            var {{ $field }}Chart = new Chart(ctx{{ $field }}, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($evaluationLabels) !!},
                    datasets: [{
                        data: {!! json_encode($data['percentages']) !!},
                        backgroundColor: evaluationColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map(function(label, i) {
                                            const meta = chart.getDatasetMeta(0);
                                            const style = meta.controller.getStyle(i);
                                            const value = data.datasets[0].data[i];
                                            // Only show labels for non-zero values
                                            if (value <= 0) return null;
                                            return {
                                                text: label + ': ' + value + '%',
                                                fillStyle: style.backgroundColor,
                                                strokeStyle: style.borderColor,
                                                lineWidth: style.borderWidth,
                                                hidden: isNaN(value) || meta.data[i].hidden,
                                                index: i
                                            };
                                        }).filter(item => item !== null);
                                    }
                                    return [];
                                }
                            }
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
    @endpush
</x-layout>