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
    <x-navbars.sidebar activePage="laporan" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Laporan" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 w-25">
                            <div class="bg-gradient-info shadow-info border-radius-lg p-3">
                                <h6 class="text-white text-center mb-0">Laporan</h6>
                            </div>
                        </div>
                        <div class="card-body p-3 mt-3">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <a class="btn bg-gradient-success mb-0 mx-2" href="{{ route('laporan.exportLaporan') }}">
                                                <i class="material-icons text-sm">file_download</i> Unduh Laporan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="nav-wrapper position-relative py-3">
                                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#tracer-tab"
                                                role="tab" aria-selected="true">
                                                <i class="material-icons text-lg position-relative">email</i>
                                                <span class="ms-1">Rekap Hasil Tracer Study</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#survey-tab"
                                                role="tab" aria-selected="false">
                                                <i class="material-icons text-lg position-relative">email</i>
                                                <span class="ms-1">Rekap Hasil Survey Kepuasan</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#lulusan-tab"
                                                role="tab" aria-selected="true">
                                                <i class="material-icons text-lg position-relative">people</i>
                                                <span class="ms-1">Rekap Lulusan Belum Mengisi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#stakeholder-tab"
                                                role="tab" aria-selected="false">
                                                <i class="material-icons text-lg position-relative">people</i>
                                                <span class="ms-1">Rekap Stakeholder Belum Mengisi</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Tab Content -->
                                <div class="tab-content" id="myTabContent">
                                    <!-- tracer Tab -->
                                    <div class="tab-pane fade show active" id="tracer-tab" role="tabpanel">
                                        <div class="table-responsive pt-4">
                                            <table class="table table-bordered align-items-center mb-0 w-100" id="table-tracer">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Program Studi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">NIM</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No. Hp</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Lulus</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Pertama Bekerja</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Masa Tunggu (Bulan)</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Pertama Kerja Instansi Saat Ini</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jenis Instansi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Instansi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Skala Instansi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Lokasi Instansi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kategori Instansi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Profesi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Atasan</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jabatan Atasan</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email Atasan</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- survey Tab -->
                                    <div class="tab-pane fade" id="survey-tab" role="tabpanel">
                                        <div class="table-responsive pt-4">
                                            <table class="table table-bordered align-items-center mb-0 w-100" id="table-survey">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jabatan</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Alumni</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Program Studi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Lulus</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kerjasama Tim</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Keahlian dibidang TI</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kemampuan berbahasa asing</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kemampuan berkomunikasi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Pengembangan diri</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kepemimpinan</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Etos kerja</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kompetensi yang dibutuhkan tapi belum dapat terpenuhi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Saran untuk kurikulum program studi</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- lulusan belum mengisi Tab -->
                                    <div class="tab-pane fade show " id="lulusan-tab" role="tabpanel">
                                        <div class="table-responsive pt-4">
                                            <table class="table table-bordered align-items-center mb-0 w-100" id="table-lulusan">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Program Studi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">NIM</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No. Hp</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Lulus</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- stakeholder belum mengisi Tab -->
                                    <div class="tab-pane fade" id="stakeholder-tab" role="tabpanel">
                                        <div class="table-responsive pt-4">
                                            <table class="table table-bordered align-items-center mb-0 w-100" id="table-stakeholder">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jabatan</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Alumni</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Program Studi</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Lulus</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
    @push('js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#table-tracer').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('laporan.tracerStudy') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                        { data: 'nama_prodi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.nim', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.nama_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.no_hp_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.email_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.tanggal_lulus', className: 'text-center', orderable: true, searchable: true },
                        { data: 'tanggal_pertama_berkerja', className: 'text-center', orderable: true, searchable: false },
                        { data: 'masa_tunggu', className: 'text-center', orderable: true, searchable: false },
                        { data: 'tanggal_berkerja_instansi_sekarang', className: 'text-center', orderable: true, searchable: false },
                        { data: 'nama_jenis_instansi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nama_instansi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'skala_instansi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lokasi_instansi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nama_kategori', className: 'text-center', orderable: true, searchable: true },
                        { data: 'profesi.nama_profesi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nama_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'jabatan_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'email_atasan', className: 'text-center', orderable: true, searchable: true }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });
                $('#table-survey').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('laporan.surveyStakeholder') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                        { data: 'stakeholder.nama_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'stakeholder.jabatan_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'stakeholder.email_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nama_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nama_prodi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'tanggal_lulus', className: 'text-center', orderable: true, searchable: true },
                        { data: 'kerjasama_tim', className: 'text-center', orderable: true, searchable: false },
                        { data: 'keahlian_it', className: 'text-center', orderable: true, searchable: false },
                        { data: 'kemampuan_bahasa_asing', className: 'text-center', orderable: true, searchable: false },
                        { data: 'kemampuan_komunikasi', className: 'text-center', orderable: true, searchable: false },
                        { data: 'pengembangan_diri', className: 'text-center', orderable: true, searchable: false },
                        { data: 'kepemimpinan', className: 'text-center', orderable: true, searchable: false },
                        { data: 'etos_kerja', className: 'text-center', orderable: true, searchable: false },
                        { data: 'kompetensi_yang_belum_dipenuhi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'saran_kurikulum_prodi', className: 'text-center', orderable: true, searchable: true }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });
                $('#table-lulusan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('laporan.lulusanBelumMengisi') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                        { data: 'prodi.nama_prodi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nim', className: 'text-center', orderable: true, searchable: true },
                        { data: 'nama_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'no_hp_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'email_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'tanggal_lulus', className: 'text-center', orderable: true, searchable: true }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });
                $('#table-stakeholder').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('laporan.stakeholderBelumMengisi') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                        { data: 'nama_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'jabatan_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'email_atasan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.nama_lulusan', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.prodi.nama_prodi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'lulusan.tanggal_lulus', className: 'text-center', orderable: true, searchable: true }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });
            });
        </script>
    @endpush
</x-layout>