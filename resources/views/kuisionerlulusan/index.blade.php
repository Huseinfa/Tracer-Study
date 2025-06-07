@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2 h-100">
            <h4>Tracer Study</h4>
        </div>
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ url('tracer-study/cari') }}" method="post" id="searchForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="searchModalLabel">Cari Data Anda</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Masukkan NIM atau Nama</label>
                                <input type="text" name="teks" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-info m-0">Cari</button>
                        </div>
                    </form>
                    <div class="modal-body p-2">
                        <h6>Hasil Pencarian:</h6>
                        <table id="tabelLulusan" class="table table-bordered mb-0 w-100">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchModal').modal('show');

            var table = $('#tabelLulusan').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                ajax: {
                    url: "{{ url('tracer-study/cari') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        d.teks = $('input[name="teks"]').val();
                    }
                },
                columns: [
                    { data: 'nim', name: 'nim', className: 'text-center' },
                    { data: 'nama_lulusan', name: 'nama_lulusan', className: 'text-center' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' }
                ]
            });

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            // Delegasi event untuk tombol pilih
            $('#tabelLulusan').on('click', '.pilih-lulusan', function() {
                let id = $(this).data('id');
                window.location.href = '/tracer-study/konfirmasi/' + id;
            });
        });
    </script>
@endpush