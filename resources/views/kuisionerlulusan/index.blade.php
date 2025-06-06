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
                        <div id="hasilPencarian"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>        
        $(document).ready(function() {
            $('#searchModal').modal('show');

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success && response.data) {
                            let html = '<table class="table table-bordered mb-0"><thead><tr><th>NIM</th><th>Nama</th><th>Pilih</th></tr></thead><tbody>';
                            response.data.forEach(function(item) {
                                html += `<tr>
                                            <td class="text-center">${item.nim}</td>
                                            <td class="text-center">${item.nama_lulusan}</td>
                                            <td class="text-center">
                                                <button class="btn btn-info pilih-lulusan mb-0 py-1 px-4" data-id="${item.id_lulusan}">Pilih</button>
                                            </td>
                                        </tr>`;
                            });
                            html += '</tbody></table>';
                            $('#hasilPencarian').html(html);

                            $('.pilih-lulusan').on('click', function() {
                                let id = $(this).data('id');
                                window.location.href = '/tracer-study/konfirmasi/' + id;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: response.message,
                                confirmButtonText: 'Tutup',
                                customClass: {
                                    confirmButton: 'bg-gradient-secondary'
                                }
                            });
                        }
                    }
                })
            })
        });
    </script>
@endpush