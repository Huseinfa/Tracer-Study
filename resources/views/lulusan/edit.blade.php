<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ url('/lulusan/' . $lulusan->id_lulusan) }}" method="post" id="formUbah">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal">Edit Data Lulusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group input-group-static input-group-md">
                    <label>Program Studi</label>
                    <select name="id_program_studi" id="id_program_studi" class="form-control" required>
                        <option value="{{ $lulusan->prodi->id_program_studi }}">{{ $lulusan->prodi->nama_prodi }}</option>
                        @foreach($prodi as $p)
                            <option value="{{ $p->id_program_studi }}">{{ $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <span id="error-id_program_studi" class="error-text form-text text-danger mt-0"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>NIM</label>
                    <input type="text" id="nim" name="nim" class="form-control" value="{{ $lulusan->nim }}" required>
                </div>
                <span id="error-nim" class="error-text form-text text-danger"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Nama</label>
                    <input type="text" id="nama_lulusan" name="nama_lulusan" class="form-control" value="{{ $lulusan->nama_lulusan }}" required>
                </div>
                <span id="error-nama_lulusan" class="error-text form-text text-danger"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Email</label>
                    <input type="email" id="email_lulusan" name="email_lulusan" class="form-control" value="{{ $lulusan->email_lulusan }}" required>
                </div>
                <span id="error-email_lulusan" class="error-text form-text text-danger mt-0"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Nomor Hp</label>
                    <input type="tel" id="no_hp_lulusan" name="no_hp_lulusan" class="form-control" value="{{ $lulusan->no_hp_lulusan }}" required>
                </div>
                <span id="error-no_hp_lulusan" class="error-text form-text text-danger"></span>
                <div class="input-group input-group-static input-group-md pt-3">
                    <label>Tanggal Lulus</label>
                    <input type="date" id="tanggal_lulus" name="tanggal_lulus" class="form-control" value="{{ $lulusan->tanggal_lulus }}" required>
                </div>
                <span id="error-tanggal_lulus" class="error-text form-text text-danger"></span>
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
        $('#formUbah').on('submit', function(e) {
            e.preventDefault();
            
            $('.error-text').text('');
            
            $.ajax({
                url: '{{ url('/lulusan/' . $lulusan->id_lulusan) }}',
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