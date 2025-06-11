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
    <x-navbars.sidebar activePage="stakeholder" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Manajemen Stakeholder" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 w-25">
                            <div class="bg-gradient-info shadow-info border-radius-lg p-3">
                                <h6 class="text-white text-center mb-0">Daftar Stakeholder</h6>
                            </div>
                        </div>
                        <div class="card-body p-3 mt-3">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-end">
                                    <a class="btn bg-gradient-success mb-0" href="{{ route('stakeholder.export') }}">
                                        <i class="material-icons text-sm">file_download</i> Export
                                    </a>
                                </div>
                                <div class="table-responsive py-3">
                                    <table class="table table-bordered align-items-center mb-0 w-100" id="table-stakeholder">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Stakeholder</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jabatan</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama Lulusan</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Status</th>
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
    @push('js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            var tableStakeholder;
            $(document).ready(function() {
                tableStakeholder = $('#table-stakeholder').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/stakeholder/list') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', width: '5%', orderable: false, searchable: false},
                        { data: 'nama_atasan', className: 'text-center', width: '20%', orderable: false, searchable: true },
                        { data: 'jabatan_atasan', className: 'text-center', width: '20%', orderable: false, searchable: false },
                        { data: 'lulusan.nama_lulusan', className: 'text-center', width: '20%', orderable: false, searchable: true },
                        { data: 'email_atasan', className: 'text-center', width: '20%', orderable: false, searchable: true },
                        { data: 'status', className: 'text-center', width: '15%', orderable: false, searchable: false },
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
