@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
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
                            <div class="input-group input-group-static">
                                <label class="form-label">Masukkan NIM atau Nama</label>
                                <input type="text" name="teks" class="form-control" required>
                                @error('teks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger mt-3">
                                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                                    {{ session('error') }}
                                </div>
                            @endif
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
        });
    </script>
@endpush