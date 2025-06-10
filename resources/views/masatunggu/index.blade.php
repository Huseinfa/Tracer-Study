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
    <x-navbars.sidebar activePage="masa-tunggu" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Masa Tunggu" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card px-0">
                        <div class="card-body p-0">
                            <form action="{{ url('masa-tunggu') }}" method="GET" class="d-flex flex-row justify-content-end">
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
                                    <input type="number" name="start_year" id="start_year" class="form-control p-0" value="{{ request('start_year', now()->year - 4) }}">
                                </div>
                                <div class="input-group input-group-outline m-2" style="width: 150px">
                                    <label for="end_year" class="form-label">Tahun Akhir</label>
                                    <input type="number" name="end_year" id="end_year" class="form-control p-0" value="{{ request('end_year', now()->year - 1) }}">
                                </div>
                                <button type="submit" class="btn btn-info m-2" style="width: 100px">Filter</button>
                                @if(request('prodi') || request('start_year') || request('end_year'))
                                    <a href="{{ url('masa-tunggu') }}" class="btn btn-outline-secondary m-2" style="width: 100px">Reset</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 w-25">
                            <div class="bg-gradient-info shadow-info border-radius-lg p-3">
                                <h6 class="text-white text-center mb-0">Masa Tunggu Lulusan</h6>
                            </div>
                        </div>
                        <div class="card-body p-3 mt-3">
                            <div class="my-sm-auto mt-3">
                                <div class="nav-wrapper position-relative end-0">
                                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#perlulusan-tab"
                                                role="tab" aria-selected="true">
                                                <i class="material-icons text-lg position-relative">people</i>
                                                <span class="ms-1">Masa Tunggu per Lulusan</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pertahun-tab"
                                                role="tab" aria-selected="false">
                                                <i class="material-icons text-lg position-relative">email</i>
                                                <span class="ms-1">Rata-Rata Masa Tunggu</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Tab Content -->
                            <div class="tab-content" id="myTabContent">
                                <!-- Per Lulusan Tab -->
                                <div class="tab-pane fade show active" id="perlulusan-tab" role="tabpanel">
                                    <div class="table-responsive p-3 pt-4">
                                        <table class="table table-bordered align-items-center mb-0 w-100" id="table-perLulusan">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">NIM</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Lulus</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Pertama Bekerja</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Masa Tunggu (Bulan)</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Per Tahun Tab -->
                                <div class="tab-pane fade" id="pertahun-tab" role="tabpanel">
                                    <div class="table-responsive p-3 pt-4">
                                        <table class="table table-bordered align-items-center mb-0 w-100" id="table-perTahun">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tahun Lulus</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jumlah Lulusan</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jumlah Lulusan yang Terlacak</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Rata-rata Waktu Tunggu (Bulan)</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jumlah</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder"></th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder"></th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
    @push('js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
            var tabelPerLulusan;
            $(document).ready(function() {
                tabelPerLulusan = $('#table-perLulusan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('masa-tunggu.list-perLulusan') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: function(d) {
                            d.prodi = $('#prodi').val();
                            d.start_year = $('#start_year').val();
                            d.end_year = $('#end_year').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', width: '5%', orderable: false, searchable: false },
                        { data: 'lulusan.nim', className: 'text-center', width: '20%', orderable: true, searchable: true },
                        { data: 'lulusan.nama_lulusan', className: 'text-center', width: '20%', orderable: false, searchable: true },
                        { data: 'lulusan.tanggal_lulus', className: 'text-center', width: '20%', orderable: true, searchable: true },
                        { data: 'tanggal_pertama_berkerja', className: 'text-center', width: '20%', orderable: true, searchable: false },
                        { data: 'rataRata', className: 'text-center', width: '15%', orderable: true, searchable: false }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });
                $('form[action="{{ url('masa-tunggu') }}"]').on('submit', function(e) {
                    tabelPerLulusan.ajax.reload();
                    tablePerTahun.ajax.reload();
                });
            });
        </script>
        <script>
            var tablePerTahun;
            $(document).ready(function() {
                tablePerTahun = $('#table-perTahun').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('masa-tunggu.list-perTahun') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: function(d) {
                            d.prodi = $('#prodi').val();
                            d.start_year = $('#start_year').val();
                            d.end_year = $('#end_year').val();
                        }
                    },
                    columns: [
                        { data: 'tahun_lulus', name: 'tahun_lulus', className: 'text-center', width: '25%', orderable: true, searchable: true },
                        { data: 'jumlah_lulusan', name: 'jumlah_lulusan', className: 'text-center', width: '25%', orderable: false, searchable: false },
                        { data: 'jumlah_terlacak', name: 'jumlah_terlacak', className: 'text-center', width: '25%', orderable: false, searchable: false },
                        { data: 'rataRata', name: 'rataRata', className: 'text-center', width: '25%', orderable: false, searchable: false }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    },
                    footerCallback: function (row, data, start, end, display) {
                        var api = this.api();
                        var jumlahLulusan = api.column(1).data().reduce((a, b) => a + parseInt(b || 0), 0);
                        var jumlahTerlacak = api.column(2).data().reduce((a, b) => a + parseInt(b || 0), 0);
                        var rataRata = api.column(3).data().reduce((a, b) => {
                            var match = (b || '').match(/([\d.]+) bulan/);
                            return a + (match ? parseFloat(match[1]) : 0);
                        }, 0);
                        var rataRataAvg = data.length > 0 ? (rataRata / data.length).toFixed(1) : '0.0';

                        $(api.column(0).footer()).html('<strong>Jumlah</strong>');
                        $(api.column(1).footer()).html('<strong>' + jumlahLulusan + '</strong>');
                        $(api.column(2).footer()).html('<strong>' + jumlahTerlacak + '</strong>');
                        $(api.column(3).footer()).html('<strong>' + rataRataAvg + ' bulan</strong>');
                    }
                });
            });
        </script>
    @endpush
</x-layout>