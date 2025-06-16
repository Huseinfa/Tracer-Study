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
    <x-navbars.sidebar activePage="profesi" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Manajemen Profesi" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 w-25">
                            <div class="bg-gradient-info shadow-info border-radius-lg p-3">
                                <h6 class="text-white text-center mb-0">Daftar Profesi</h6>
                            </div>
                        </div>
                        <div class="card-body p-3 mt-3">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <div id="filter">
                                            <div class="input-group input-group-outline" style="width: 300px">
                                                <label class="form-label">Filter</label>
                                                <select name="filter_kategori" class="form-control filter_kategori">
                                                    <option value="">- Semua -</option>
                                                    @foreach($kategori as $k)
                                                        <option value="{{ $k->id_kategori_profesi }}">{{ $k->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button onclick="modalAction('{{ url('/profesi/create') }}')" class="btn bg-gradient-dark mb-0">
                                                <i class="material-icons text-sm">add</i> Tambah Profesi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive py-3">
                                    <table class="table table-bordered align-items-center mb-0 w-100" id="table-profesi">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Kategori Profesi</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Profesi</th>
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
            </div>
            <x-footers.auth />
        </div>
    </main>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"></div>
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
            function modalAction(url = '') {
                $('#myModal').load(url, function() {
                    $('#myModal').modal('show');
                });
            }
        </script>
        <script>
            var tableProfesi;
            $(document).ready(function() {
                tableProfesi = $('#table-profesi').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/profesi/list') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: function(d) {
                            d.filter_kategori = $('.filter_kategori').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', width: '5%', orderable: false, searchable: false },
                        { data: 'kategori', className: 'text-center', orderable: false, searchable: true },
                        { data: 'nama_profesi', className: 'text-center', orderable: true, searchable: true },
                        { data: 'action', className: 'text-center p-0', orderable: false, searchable: false }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left"></i>',
                            next: '<i class="bi bi-chevron-right"></i>'
                        }
                    }
                });

                // Filter Kategori
                $('.filter_kategori').change(function() {
                    tableProfesi.draw();
                });
            });
        </script>
    @endpush
</x-layout>
