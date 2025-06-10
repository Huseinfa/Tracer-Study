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
    <x-navbars.sidebar activePage="lulusan" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Manajemen Lulusan" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 w-25">
                            <div class="bg-gradient-info shadow-info border-radius-lg p-3">
                                <h6 class="text-white text-center mb-0">Daftar Lulusan</h6>
                            </div>
                        </div>
                        <div class="card-body p-3 mt-3">
                            <div id="filter">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <div class="input-group input-group-outline" style="width: 300px">
                                                <label class="form-label">Filter</label>
                                                <select name="filter_prodi" class="form-control filter_prodi">
                                                    <option value="">- Semua -</option>
                                                    @foreach($prodi as $p)
                                                    <option value="{{ $p->id_program_studi }}">{{ $p->nama_prodi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <button onclick="modalAction('{{ route('lulusan.create') }}')" class="btn bg-gradient-dark mb-0">
                                                    <i class="material-icons text-sm">add</i> Tambah Lulusan
                                                </button>
                                                {{-- <a class="btn bg-gradient-dark mb-0" href="{{ route('lulusan.create') }}"></a> --}}
                                                {{-- <a class="btn bg-gradient-success mb-0 mx-2" href="{{ route('lulusan.export.form') }}">
                                                    <i class="material-icons text-sm">file_download</i> Export
                                                </a>
                                                <a class="btn bg-gradient-primary mb-0" href="{{ route('lulusan.import.form') }}">
                                                    <i class="material-icons text-sm">file_upload</i> Import
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table table-bordered align-items-center mb-0" id="table-lulusan">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">NIM</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Lulus</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Status</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
            var tableLulusan;
            $(document).ready(function() {
                tableLulusan = $('#table-lulusan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/lulusan/list') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        "data": function (d) {
                            d.filter_prodi = $('.filter_prodi').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', width: '5%', orderable: false, searchable: false},
                        { data: 'nim', className: 'text-center', width: '15%', orderable: true, searchable: true },
                        { data: 'nama_lulusan', className: 'text-center', width: '25%', orderable: true, searchable: true },
                        { data: 'tanggal_lulus', className: 'text-center', width: '15%', orderable: true, searchable: true },
                        { data: 'status', className: 'text-center', width: '20%', orderable: false, searchable: false },
                        { data: 'action', className: 'text-center p-0', width: '20%', orderable: false, searchable: false }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });

                // Filter Prodi
                $('.filter_prodi').change(function() {
                tableLulusan.draw();
                });
            });
        </script>
    @endpush
</x-layout>
