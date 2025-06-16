<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-normal">Detail Lulusan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
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
            <button type="button" data-bs-dismiss="modal" class="btn bg-gradient-secondary mx-2 my-0">Tutup</button>
        </div>
    </div>
</div>