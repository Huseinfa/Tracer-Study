<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ url('/admin/' . $admin->id_user . '/destroy') }}" method="post" id="formHapus">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal">Hapus Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-warning" role="alert">
                    <h5><i class="bi bi-exclamation-triangle"></i><strong> Perhatian!</strong></h5>
                    Apakah Anda yakin ingin menghapus data admin ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-items-center mb-0">
                        <tbody>
                            <tr>
                                <th>Username</th>
                                <td>{{ $admin->username }}</td>
                            </tr>
                            <tr>
                                <th>Nama Admin</th>
                                <td>{{ $admin->nama_user }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn bg-gradient-secondary mx-2 my-0">Batal</button>
                <button type="submit" class="btn bg-gradient-info mx-2 my-0">Hapus</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formHapus').on('submit', function(e) {
            e.preventDefault();
            
            $('.error-text').text('');
            
            $.ajax({
                url: '{{ url('/admin/' . $admin->id_user . '/destroy') }}',
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
                            tableUser.ajax.reload();
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