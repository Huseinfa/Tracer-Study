<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ url('/admin/' . $admin->id_user) }}" method="post" id="formUbah">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal">Edit Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group input-group-static input-group-md">
                    <label>Masukkan Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ $admin->username }}" required>
                </div>
                <span id="error-username" class="error-text form-text text-danger mt-0"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Masukkan Nama</label>
                    <input type="text" id="nama_user" name="nama_user" class="form-control" value="{{ $admin->nama_user }}" required>
                </div>
                <span id="error-nama_user" class="error-text form-text text-danger"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="form-text text-muted">* Abaikan jika tidak ingin mengubah password</small>
                </div>
                <span id="error-password" class="error-text form-text text-danger"></span>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn bg-gradient-secondary mx-2 my-0">Batal</button>
                <button type="submit" class="btn bg-gradient-info mx-2 my-0">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formUbah').on('submit', function(e) {
            e.preventDefault();
            
            $('.error-text').text('');
            
            $.ajax({
                url: '{{ url('/admin/' . $admin->id_user) }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true).text('Menyimpan...');
                },
                success: function(response) {                    
                    if(response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000
                        }).then(() => {
                            tableUser.ajax.reload();
                        });
                    } else {
                        if(response.msgField) {
                            $.each(response.msgField, function(field, messages) {
                                $('#error-' + field).text(messages[0]);
                            });
                        }
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