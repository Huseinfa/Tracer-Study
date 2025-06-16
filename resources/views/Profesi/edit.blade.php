<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ url('/profesi/' . $profesi->id_profesi) }}" method="post" id="formUbah">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal">Edit Data Profesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group input-group-static input-group-md">
                    <label>Kategori Profesi</label>
                    <select name="id_kategori_profesi" id="id_kategori_profesi" class="form-control" required>
                        <option value="{{ $profesi->kategoriProfesi->id_kategori_profesi }}">{{ $profesi->kategoriProfesi->nama_kategori }}</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori_profesi }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <span id="error-id_kategori_profesi" class="error-text form-text text-danger mt-0"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Nama Profesi</label>
                    <input type="text" id="nama_profesi" name="nama_profesi" class="form-control" value="{{ $profesi->nama_profesi }}" required>
                </div>
                <span id="error-nama_profesi" class="error-text form-text text-danger"></span>
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
                url: '{{ url('/profesi/' . $profesi->id_profesi) }}',
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
                            tableProfesi.ajax.reload();
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