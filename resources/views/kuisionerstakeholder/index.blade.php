@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Survey Kepuasan Pengguna Lulusan</h4>
        </div>
        <div class="card-body p-3">
            <form method='POST' action='{{ url('/survey-kepuasan/simpan/' . $stakeholder->id_stakeholder) }}' id="surveyForm">
                @csrf

                {{-- biodata atasan --}}
                
                <div class="row p-3">
                    <h6>Data Diri Anda</h6>
                    <div class="row py-3">
                        <div class="col-12 col-md-6 px-4 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Nama</label>
                                <input type="text" name="nama_atasan" class="form-control" value="{{ $stakeholder->nama_atasan }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 px-4 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan_atasan" class="form-control" value="{{ $stakeholder->jabatan_atasan }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- biodata lulusan --}}

                <div class="row p-3">
                    <h6>Data Diri Lulusan</h6>
                    <div class="row py-3">
                        <div class="col-12 col-md-4 px-4 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Nama</label>
                                <input type="text" name="nama_lulusan" class="form-control" value="{{ $stakeholder->lulusan->nama_lulusan }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 px-4 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Program Studi</label>
                                <input type="text" name="id_program_studi" class="form-control" value="{{ $stakeholder->lulusan->prodi->nama_prodi }}" readonly>
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-4 px-4 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Tanggal Lulus</label>
                                <input type="date" name="tanggal_lulus" class="form-control" value="{{ $stakeholder->lulusan->tanggal_lulus }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- survey kepuasan --}}

                <div class="row p-3">
                    <h6>Survey Kepuasan</h6>
                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Kerjasama Tim</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kerjasama_tim" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kerjasama_tim" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kerjasama_tim" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kerjasama_tim" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kerjasama_tim" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Keahlian di bidang TI</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="keahlian_it" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="keahlian_it" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="keahlian_it" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="keahlian_it" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="keahlian_it" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Kemampuan berbahasa asing</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_bahasa_asing" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_bahasa_asing" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_bahasa_asing" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_bahasa_asing" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_bahasa_asing" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Kemampuan berkomunikasi</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_komunikasi" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_komunikasi" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_komunikasi" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_komunikasi" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kemampuan_komunikasi" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Pengembangan diri</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengembangan_diri" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengembangan_diri" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengembangan_diri" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengembangan_diri" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengembangan_diri" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Kepemimpinan</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kepemimpinan" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kepemimpinan" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kepemimpinan" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kepemimpinan" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kepemimpinan" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-4 py-3">
                        <div class="col">
                            <label>Etos Kerja</label>
                            <div class="row px-3">
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="etos_kerja" value="1">
                                        <label class="custom-control-label">Sangat Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="etos_kerja" value="2">
                                        <label class="custom-control-label">Kurang</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="etos_kerja" value="3">
                                        <label class="custom-control-label">Cukup</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="etos_kerja" value="4">
                                        <label class="custom-control-label">Baik</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto me-auto px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="etos_kerja" value="5">
                                        <label class="custom-control-label">Sangat Baik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="row py-3">
                        <div class="col-12">
                            <div class="input-group input-group-static">
                                <label>Kompetensi yang dibutuhkan tapi belum dapat dipenuhi</label>
                                <textarea class="form-control" name="kompetensi_yang_belum_dipenuhi" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3">
                        <div class="col-12">
                            <div class="input-group input-group-static">
                                <label>Saran untuk kurikulum program studi</label>
                                <textarea class="form-control" name="saran_kurikulum_prodi" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-cols-sm-6 d-flex justify-content-center p-3">
                    <button type="submit" class="btn bg-gradient-info shadow mb-0">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#surveyForm').on('submit', function(e) {
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
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    }
                }
            })
        });
    </script>
@endpush