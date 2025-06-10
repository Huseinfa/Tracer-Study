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
    <x-navbars.sidebar activePage="admin" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Daftar Admin" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 w-50">
                            <div class="bg-gradient-info shadow-info border-radius-lg p-3">
                                <h6 class="text-white mb-0">Daftar Admin</h6>
                            </div>
                        </div>
                        <div class="card-body p-3 mt-3">
                            <div id="filter">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                                                    <i class="material-icons text-sm">add</i> Add New Admin
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table table-bordered align-items-center mb-0" id="table-user">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Username</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Nama</th>
                                            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <!-- Modal Tambah Admin -->
                            <div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form id="formTambahAdmin">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Tambah Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama_user">Nama</label>
                                        <input type="text" name="nama_user" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
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
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
            <script>
            $(document).ready(function () {
                $('#formTambahAdmin').validate({
                    submitHandler: function (form) {
                        $.ajax({
                            url: "{{ route('admin.store') }}",
                            method: "POST",
                            data: $(form).serialize(),
                            success: function (res) {
                                $('#modalTambahAdmin').modal('hide');
                                $('#formTambahAdmin')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Admin berhasil ditambahkan',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                tableLulusan.ajax.reload(); // Reload datatable
                            },
                            error: function (xhr) {
                                let msg = 'Terjadi kesalahan. Periksa kembali input Anda.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    msg = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: msg
                                });
                            }
                        });
                    }
                });
            });
            </script>

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            var tableLulusan;
            $(document).ready(function() {
                tableLulusan = $('#table-user').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/admin/list') }}",
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', className: 'text-center', width: '5%', orderable: false, searchable: false },
                        { data: 'username', className: 'text-center', width: '30%', orderable: false, searchable: true },
                        { data: 'nama_user', className: 'text-center', width: '35%', orderable: true, searchable: true },
                        { data: 'action', className: 'text-center p-0', width: '30%', orderable: false, searchable: false }
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