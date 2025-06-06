@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Tracer Study</h4>
        </div>
        <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ url('tracer-study/verifikasi/' . $lulusan->id_lulusan) }}" method="post" id="otpForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="searchModalLabel">Verifikasi Partisipan</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Masukkan Kode OTP</label>
                                <input type="text" name="otp" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn m-0 p-2" id="kirimUlangOTP">Kirim Ulang Kode OTP?</button>
                            <button type="submit" class="btn bg-gradient-info m-0">Cek Kode OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>        
        $(document).ready(function() {
            $('#otpModal').modal('show');

            $('#otpForm').on('submit', function(e) {
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

            $('#kirimUlangOTP').on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ url('tracer-study/kode-OTP-baru/' . $lulusan->id_lulusan) }}',
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
                            });
                        }
                    }
                })
            })

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'bg-gradient-secondary'
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'bg-gradient-secondary'
                    }
                });
            @endif
        });
    </script>
@endpush