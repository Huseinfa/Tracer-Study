<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
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
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    
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
    @endpush
</x-layout>