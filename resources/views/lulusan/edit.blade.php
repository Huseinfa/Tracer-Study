<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="lulusan"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Lulusan"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Edit Lulusan</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('lulusan.update', $lulusan->id_lulusan) }}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="id_program_studi" class="col-1 control-label col-form-label">ID Program Studi</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="id_program_studi" value="{{ $lulusan->id_program_studi }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-1 control-label col-form-label">NIM</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $lulusan->nim) }}" required>
                                        @error('nim')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_lulusan" class="col-1 control-label col-form-label">Nama Lulusan</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nama_lulusan" name="nama_lulusan" value="{{ old('nama_lulusan', $lulusan->nama_lulusan) }}" required>
                                        @error('nama_lulusan')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-1 control-label col-form-label">Email</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $lulusan->email) }}" required>
                                        @error('email')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nomor_hp" class="col-1 control-label col-form-label">Nomor HP</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $lulusan->nomor_hp) }}" required>
                                        @error('nomor_hp')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tahun_lulus" class="col-1 control-label col-form-label">Tahun Lulus</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $lulusan->tahun_lulus) }}" required>
                                        @error('tahun_lulus')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-1 control-label col-form-label"></label>
                                    <div class="col-11">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        <a class="btn btn-sm btn-default ml-1" href="{{ route('lulusan.index') }}">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</x-layout>