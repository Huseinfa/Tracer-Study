<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ url('/lulusan/' . $lulusan->id_lulusan . '/destroy') }}" method="post" id="formDelete">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal">Hapus Data Lulusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-warning" role="alert">
                    <h5><i class="bi bi-exclamation-triangle"></i><strong> Perhatian!</strong></h5>
                    Apakah Anda yakin ingin menghapus data lulusan ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered align-items-center mb-0">
                        <tbody>
                            <tr>
                                <th>Program Studi</th>
                                <td>{{ $lulusan->prodi->nama_prodi }}</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>{{ $lulusan->nim }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $lulusan->nama_lulusan }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $lulusan->email_lulusan }}</td>
                            </tr>
                            <tr>
                                <th>No. Hp</th>
                                <td>{{ $lulusan->no_hp_lulusan }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lulus</th>
                                <td>{{ $lulusan->tanggal_lulus }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn bg-gradient-secondary mx-2 my-0">Batal</button>
                <button type="submit" class="btn bg-gradient-info mx-2 my-0">Hapus</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formDelete').on('submit', function(e) {
            e.preventDefault();
            
            $('.error-text').text('');
            
            $.ajax({
                url: '{{ url('/lulusan/' . $lulusan->id_lulusan . '/destroy') }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true).text('Memproses...');
                },
                success: function(response) {                    
                    if(response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then(() => {
                            tableLulusan.ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: response.message
                        });
                    }
                },
                complete: function() {
                    $('button[type="submit"]').prop('disabled', false).text('Simpan');
                }
            });
        });
    });
</script>