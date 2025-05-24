<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('tracer-study/search') }}" method="post" id="searchForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="searchModalLabel">Cari Alumni</h5>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Cari berdasarkan Nama atau NIM</label>
                        <input type="text" class="form-control" id="search" name="search" required>
                        <div id="searchResults" class="mt-3">
                            <!-- Hasil pencarian akan muncul di sini -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-info">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#searchForm').validate({
            rules: {
                search: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                search: {
                    required: "Harap masukkan nama atau NIM",
                    minlength: "Minimal 3 karakter"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        let html = '';
                        if (response.length > 0) {
                            html += '<div class="list-group">';
                            response.forEach(function(alumni) {
                                // Format tanggal lulus jika perlu
                                const tanggalLulus = new Date(alumni.tanggal_lulus).toLocaleDateString('id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                                
                                html += `
                                    <a href="#" class="list-group-item list-group-item-action select-alumni" 
                                        data-id="${alumni.id}"
                                        data-nim="${alumni.nim}"
                                        data-nama="${alumni.nama_lulusan}"
                                        data-prodi="${alumni.id_program_studi}"
                                        data-tanggal-lulus="${alumni.tanggal_lulus}">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">${alumni.nama_lulusan}</h6>
                                            <small>${alumni.nim}</small>
                                        </div>
                                        <small class="text-muted">Lulus: ${tanggalLulus}</small>
                                    </a>
                                `;
                            });
                            html += '</div>';
                        } else {
                            html = '<div class="alert alert-warning">Data tidak ditemukan</div>';
                        }
                        $('#searchResults').html(html);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let html = '<div class="alert alert-danger">';
                        for (let field in errors) {
                            html += errors[field][0] + '<br>';
                        }
                        html += '</div>';
                        $('#searchResults').html(html);
                    }
                });
            }
        });

        // Handler untuk memilih alumni
        $(document).on('click', '.select-alumni', function(e) {
            e.preventDefault();
            
            // Isi form utama dengan data alumni yang dipilih
            $('input[name="nim"]').val($(this).data('nim'));
            $('input[name="nama_lulusan"]').val($(this).data('nama'));
            $('input[name="program_studi"]').val($(this).data('prodi'));
            $('input[name="tanggal_lulus"]').val($(this).data('tanggal-lulus'));
            
            // Tutup modal
            $('#searchModal').modal('hide');
        });
    });
</script>