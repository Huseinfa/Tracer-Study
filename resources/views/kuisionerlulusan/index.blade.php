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
                            <button type="submit" class="btn bg-gradient-info">Cari</button>
                        </div>
                    </form>
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