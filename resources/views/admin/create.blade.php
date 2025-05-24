<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="admin"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add Admin"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Add New admin</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.store') }}" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="username" class="col-1 control-label col-form-label">Username</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_user" class="col-1 control-label col-form-label">Nama User</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ old('nama_user') }}" required>
                                        @error('nama_user')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-1 control-label col-form-label">Password</label>
                                    <div class="col-11">
                                        <input type="text" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                                        @error('password')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-1 control-label col-form-label"></label>
                                    <div class="col-11">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        <a class="btn btn-sm btn-default ml-1" href="{{ route('admin.index') }}">Kembali</a>
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