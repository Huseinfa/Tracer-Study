@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Kuisioner Tracer Study</h4>
        </div>
        <div class="card-body p-3">
            @if (session('status'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ Session::get('status') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            @if (Session::has('demo'))
                <div class="row">
                    <div class="alert alert-danger alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ Session::get('demo') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <form method='POST' action='{{ route('user-profile') }}'>
                @csrf
                <div class="row">
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div class="row py-2">
                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="px-6 py-3 col-md-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control">
                                    @error('nim')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                                            
                            <div class="px-6 py-3 col-md-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama_lulusan" class="form-control">
                                    @error('nama_lulusan')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="px-6 py-3 col-md-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Program Studi</label>
                                    <input type="text" name="program_studi" class="form-control">
                                    @error('program_studi')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                                            
                            <div class="px-6 py-3 col-md-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Tanggal Lulus</label>
                                    <input type="date" name="tanggal_lulus" class="form-control" value="{{ now()->format('Y-m-d') }}">
                                    @error('tanggal_lulus')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="px-6 py-3 col-md-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                                            
                            <div class="px-6 py-3 col-md-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Nomor Hp</label>
                                    <input type="tel" name="nomor_hp" class="form-control">
                                    @error('nomor_hp')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection