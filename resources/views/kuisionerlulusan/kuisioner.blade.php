@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Tracer Study</h4>
        </div>
        <div class="card-body p-3">
            <form method='POST' action='{{ url('/tracer-study/simpan/' . $lulusan->id_lulusan) }}' id="kuisionerForm">
                @csrf
                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>NIM</label>
                                <input type="text" name="nim" class="form-control" value="{{ $lulusan->nim }}" readonly>
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Nama</label>
                                <input type="text" name="nama_lulusan" class="form-control" value="{{ $lulusan->nama_lulusan }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Program Studi</label>
                                <input type="text" name="id_program_studi" class="form-control" value="{{ $lulusan->prodi->nama_prodi }}" readonly>
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Tanggal Lulus</label>
                                <input type="date" name="tanggal_lulus" class="form-control" value="{{ $lulusan->tanggal_lulus }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Email</label>
                                <input type="email" name="email_lulusan" class="form-control" value="{{ $lulusan->email_lulusan }}" readonly>
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>No Hp</label>
                                <input type="tel" name="no_hp_lulusan" class="form-control" value="{{ $lulusan->no_hp_lulusan }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Tanggal Pertama Kerja</label>
                                <input type="date" name="tanggal_pertama_berkerja" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Tanggal Mulai Kerja pada Instansi Saat Ini</label>
                                <input type="date" name="tanggal_berkerja_instansi_sekarang" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Jenis Instansi</label>
                                <input type="text" name="jenis_instansi" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Nama Instansi</label>
                                <input type="text" name="nama_instansi" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Skala Instansi</label>
                                <select name="skala_instansi" id="skala_instansi" class="form-control" required>
                                    <option value="">--- Pilih Skala Instansi ---</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Multinasional/Internasional">Multinasional / Internasional</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Lokasi Instansi</label>
                                <input type="text" name="lokasi_instansi" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Kategori Profesi</label>
                                <select name="id_kategori_profesi" id="id_kategori_profesi" class="form-control" required>
                                    <option value="">--- Pilih Kategori ---</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori_profesi }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Profesi</label>
                                <select name="id_profesi" id="id_profesi" class="form-control" required disabled>
                                    <option value="">--- Pilih Profesi ---</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Nama Atasan Langsung</label>
                                <input type="text" name="nama_atasan" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Jabatan Atasan Langsung</label>
                                <input type="text" name="jabatan_atasan" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Email Atasan Langsung</label>
                                <input type="email" name="email_atasan" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 px-6">
                            <label>Apakah atasan anda bersedia mengisi survey kepuasan?</label>
                            <div class="row">
                                <div class="col-6 col-md-6 px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bersedia_mengisi" id="Radio1" value="1">
                                        <label class="custom-control-label" for="Radio1">Ya</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bersedia_mengisi" id="Radio2" value="0">
                                        <label class="custom-control-label" for="Radio2">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-cols-sm-6 d-flex justify-content-center">
                    <button type="submit" class="btn bg-gradient-info mb-0">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Ketika kategori profesi berubah
        $('#id_kategori_profesi').on('change', function() {
            var id_kategori = $(this).val();
            var pilihProfesi = $('#id_profesi');

            // Kosongkan dropdown profesi dan nonaktifkan
            pilihProfesi.empty().append('<option value="">--- Pilih Profesi ---</option>').prop('disabled', true);

            if (id_kategori) {
                // Kirim permintaan AJAX untuk mendapatkan profesi
                $.ajax({
                    url: '{{ route("tracer-study.getProfesi", ":id") }}'.replace(':id', id_kategori),
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Aktifkan dropdown profesi
                        pilihProfesi.prop('disabled', false);

                        // Tambahkan opsi profesi dari respons
                        $.each(data, function(index, profesi) {
                            pilihProfesi.append('<option value="' + profesi.id_profesi + '">' + profesi.nama_profesi + '</option>');
                        });
                    }
                });
            }
        });

        $('#kuisionerForm').on('submit', function(e) {
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
        });
    </script>
@endpush