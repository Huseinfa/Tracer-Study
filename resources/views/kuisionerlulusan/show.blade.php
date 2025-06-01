@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Kuisioner Tracer Study</h4>
        </div>
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ url('tracer-study/terkonfirmasi/' . $lulusan->id_lulusan) }}" method="post" id="searchForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="searchModalLabel">Konfirmasi Data Anda</h5>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td>{{ $lulusan->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $lulusan->nama_lulusan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td>{{ $lulusan->prodi->nama_prodi}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $lulusan->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lulus</th>
                                            <td>{{ $lulusan->tahun_lulus }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('tracer-study/') }}" class="btn bg-gradient-secondary">Bukan data saya</a>
                            <button type="submit" class="btn bg-gradient-info">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>        
        $(document).ready(function() {
            $('#konfirmasiModal').modal('show');
        });
    </script>
@endpush