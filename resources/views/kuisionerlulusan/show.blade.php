@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Tracer Study</h4>
        </div>
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ url('tracer-study/terkonfirmasi/' . $lulusan->id_lulusan) }}" method="post" id="konfirmasiForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="searchModalLabel">Konfirmasi Data Anda</h5>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td>{{ $lulusan->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $lulusan->nama_lulusan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td>{{ $lulusan->prodi->nama_prodi}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $lulusan->email_lulusan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lulus</th>
                                            <td>{{ $lulusan->tanggal_lulus }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="input-group input-group-outline">
                                <label class="form-label">Update Email</label>
                                <input type="text" name="email_lulusan" class="form-control">
                            </div>
                            <small>* abaikan jika anda tidak ingin merubah email</small>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('tracer-study/kembali/') }}" class="btn bg-gradient-secondary mb-0">Kembali</a>
                            <button type="submit" class="btn bg-gradient-info mb-0">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>        
        $(document).ready(function() {
            $('#konfirmasiModal').modal('show');

            $('#konfirmasiForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                confirmButtonText: 'Tutup',
                                customClass: {
                                    confirmButton: 'bg-gradient-secondary'
                                }
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location.href = response.redirect_url;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Perhatian!',
                                text: response.message,
                                confirmButtonText: 'Tutup',
                                customClass: {
                                    confirmButton: 'bg-gradient-secondary'
                                }
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location.href = response.redirect_url;
                                }
                            });
                        }
                    }
                })
            })
        });
    </script>
@endpush