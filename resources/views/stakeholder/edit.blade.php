<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="stakeholder"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Stakeholder"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Edit Stakeholder</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('stakeholder.update', $stakeholder->id_stakeholder) }}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="id_stakeholder" class="col-1 control-label col-form-label">ID Stakeholder</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="id_stakeholder" value="{{ $stakeholder->id_stakeholder }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_atasan" class="col-1 control-label col-form-label">Nama Atasan</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nama_atasan" name="nama_atasan" value="{{ old('nama_atasan', $stakeholder->nama_atasan) }}" required>
                                        @error('nama_atasan')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="instansi" class="col-1 control-label col-form-label">Instansi</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi', $stakeholder->instansi) }}" required>
                                        @error('instansi')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan" class="col-1 control-label col-form-label">Jabatan</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $stakeholder->jabatan) }}" required>
                                        @error('jabatan')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-1 control-label col-form-label">Email</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $stakeholder->email) }}" required>
                                        @error('email')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-1 control-label col-form-label"></label>
                                    <div class="col-11">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        <a class="btn btn-sm btn-default ml-1" href="{{ route('stakeholder.index') }}">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>