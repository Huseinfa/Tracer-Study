<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ url('/lulusan/store-import') }}" method="post" id="formImport">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal">Import Data Lulusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div>
                    <label>Masukkan File (.xls,.xlsx,.csv) </label>
                    <input type="file" id="file" name="file" required>
                </div>
                <span id="error-file" class="error-text form-text text-danger"></span>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn bg-gradient-secondary mx-2 my-0">Batal</button>
                <button type="submit" class="btn bg-gradient-info mx-2 my-0">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formImport').on('submit', function(e) {
            e.preventDefault();
            
            $('.error-text').text('');
            
            $.ajax({
                url: '{{ url("/lulusan/store-import") }}',
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
                            tableLulusan.ajax.reload();
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