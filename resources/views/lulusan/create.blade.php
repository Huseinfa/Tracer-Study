<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="lulusan"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add Lulusan"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Add New Lulusan</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('lulusan.store') }}" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="id_program_studi" class="col-1 control-label col-form-label">ID Program Studi</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="id_program_studi" name="id_program_studi" value="{{ old('id_program_studi') }}" required>
                                        @error('id_program_studi')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-1 control-label col-form-label">NIM</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}" required>
                                        @error('nim')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_lulusan" class="col-1 control-label col-form-label">Nama Lulusan</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nama_lulusan" name="nama_lulusan" value="{{ old('nama_lulusan') }}" required>
                                        @error('nama_lulusan')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_lulusan" class="col-1 control-label col-form-label">email_lulusan</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="email_lulusan" name="email_lulusan" value="{{ old('email_lulusan') }}" required>
                                        @error('email_lulusan')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_hp_lulusan" class="col-1 control-label col-form-label">Nomor HP</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nomor_hp_lulusan" name="nomor_hp_lulusan" value="{{ old('nomor_hp_lulusan') }}" required>
                                        @error('nomor_hp_lulusan')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lulus" class="col-1 control-label col-form-label">Tanggal Lulus</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="tanggal_lulus" name="tanggal_lulus" value="{{ old('tanggal_lulus') }}" required>
                                        @error('tanggal_lulus')
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