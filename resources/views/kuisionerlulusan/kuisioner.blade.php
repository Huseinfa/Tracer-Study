@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Kuisioner Tracer Study</h4>
        </div>
        <div class="card-body p-3">
            <form method='POST' action='{{ url('/tracer-study/simpan') }}'>
                @csrf
                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>NIM</label>
                                <input type="text" name="nim" class="form-control" value="{{ $lulusan->nim }}">
                                @error('nim')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Nama</label>
                                <input type="text" name="nama_lulusan" class="form-control" value="{{ $lulusan->nama_lulusan }}">
                                @error('nama_lulusan')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Program Studi</label>
                                <input type="text" name="id_program_studi" class="form-control" value="{{ $lulusan->prodi->id_program_studi }}" placeholder="{{ $lulusan->prodi->nama_prodi }}">
                                @error('program_studi')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Tanggal Lulus</label>
                                <input type="date" name="tanggal_lulus" class="form-control" value="{{ $lulusan->tanggal_lulus }}">
                                @error('tanggal_lulus')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $lulusan->email }}">
                                @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-static input-group-sm">
                                <label>No Hp</label>
                                <input type="tel" name="nomor_hp" class="form-control" value="{{ $lulusan->nomor_hp }}">
                                @error('nomor_hp')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Tanggal Pertama Kerja</label>
                                <input type="date" name="tanggal_pertama_berkerja" class="form-control">
                                @error('tanggal_pertama_berkerja')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Tanggal Mulai Kerja pada Instansi Saat Ini</label>
                                <input type="date" name="tanggal_berkerja_instansi_sekarang" class="form-control">
                                @error('tanggal_berkerja_instansi_sekarang')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Jenis Instansi</label>
                                <input type="text" name="jenis_instansi" class="form-control">
                                @error('jenis_instansi')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Nama Instansi</label>
                                <input type="text" name="nama_instansi" class="form-control">
                                @error('nama_instansi')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Skala Instansi</label>
                                <select name="skala_instansi" id="skala_instansi" class="form-control" required>
                                    <option value="">--- Pilih Skala Instansi ---</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Multinasional/Internasional">Multinasional / Internasional</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                </select>
                                @error('tanggal_berkerja_instansi_sekarang')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Lokasi Instansi</label>
                                <input type="text" name="lokasi_instansi" class="form-control">
                                @error('lokasi_instansi')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Kategori Profesi</label>
                                <select name="id_kategori_profesi" id="id_kategori_profesi" class="form-control" required>
                                    <option value="">--- Pilih Kategori ---</option>
                                    @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori_profesi }}">{{ $p->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori_profesi')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Profesi</label>
                                <select name="id_profesi" id="id_profesi" class="form-control" required>
                                    <option value="">--- Pilih Kategori ---</option>
                                    @foreach ($profesi as $p)
                                    <option value="{{ $p->id_profesi }}">{{ $p->nama_profesi }}</option>
                                    @endforeach
                                </select>
                                @error('id_profesi')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Nama Atasan Langsung</label>
                                <input type="text" name="nama_atasan" class="form-control">
                                @error('nama_atasan')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Jabatan Atasan Langsung</label>
                                <input type="text" name="jabatan_atasan" class="form-control">
                                @error('jabatan_atasan')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4 px-6 py-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Email Atasan Langsung</label>
                                <input type="email" name="email_atasan" class="form-control">
                                @error('email_atasan')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection