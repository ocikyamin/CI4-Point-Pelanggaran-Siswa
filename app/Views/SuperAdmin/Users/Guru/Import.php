<div class="modal fade" id="guru-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-settings"></i> Import Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-guru-upload" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="sekolah" class="form-label">Sekolah / Madrasah</label>
                            <select class="form-select" name="sekolah_id" id="sekolah">
                                <option value="">Sekolah / Madrasah</option>
                                <?php if (ListOfSekolah()): ?>
                                    <?php foreach (ListOfSekolah() as $p): ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['nm_sekolah'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="file" class="form-label">File (.xls, .xlsx) <a href="<?= base_url('public/template/template_gtk.xls') ?>" target="_blank">Template.xls</a></label>
                            <input type="file" name="files" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#form-guru-upload').on('submit', function (e) {
                e.preventDefault();

                var sekolah = $('#sekolah').val();
                var fileInput = $('#file')[0];
                var file = fileInput.files[0];
                var fileType = file ? file.name.split('.').pop().toLowerCase() : '';

                if (!sekolah) {
                    alert('Harap pilih sekolah/madrasah.');
                    return;
                }

                if (!file) {
                    alert('Harap unggah file.');
                    return;
                }

                if (fileType !== 'xls' && fileType !== 'xlsx') {
                    alert('Tipe file tidak valid. Hanya file .xls dan .xlsx yang diizinkan.');
                    return;
                }

                var formData = new FormData(this);

                $.ajax({
                    url: '<?= base_url("admin/users/guru/store-import") ?>',
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        alert('Data berhasil diimpor');
                        $('#guru-modal').modal('hide')
                        GuruList()
                    },
                    error: function (error) {
                        alert('Terjadi kesalahan saat mengimpor data');
                    }
                });
            });
        });
    </script>