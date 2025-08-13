
<!-- Modal -->

<div class="modal fade" id="modal-agenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Agenda Pertemuan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-agenda">
        <?=csrf_field();?>
        <input type="hidden" name="id" value="<?=$jadwal['id']?>">
        <input type="hidden" name="jadwal_id" value="<?=$jadwal['kelas_mengajar_id']?>">
      <div class="modal-body bg-light">
        <div class="form-group row mb-2">
            <label for="pertemuan" class="col-lg-3">Pertemuan Ke-</label>
            <div class="col-lg-4">
                <input type="number" name="pertemuan" id="pertemuan" value="<?=$jadwal['pertemuan']?>" class="form-control form-control-sm">
            </div>
            <label for="tgl_pertemuan" class="col-lg-1">Tanggal</label>
            <div class="col-lg-4">
                <input type="date" name="tgl_pertemuan" id="tgl_pertemuan" value="<?=$jadwal['tgl_pertemuan']?>" class="form-control form-control-sm">
            </div>
        </div>
       
        <div class="form-group row mb-2">
            <label for="jam_ke" class="col-lg-3">Jam Ke-</label>
            <div class="col-lg-4">
                <input type="text" name="jam_ke" id="jam_ke" class="form-control form-control-sm" value="<?=$jadwal['jam_ke']?>">
            </div>
            <label for="waktu" class="col-lg-1">Waktu</label>
            <div class="col-lg-4">
                <input type="text" name="waktu" id="waktu" class="form-control form-control-sm" value="<?=$jadwal['waktu']?>">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="materi" class="col-lg-3">Materi Pelajaran</label>
            <div class="col-lg-9">
                <textarea id="materi" name="materi" class="form-control" rows="6"><?=$jadwal['materi']?></textarea>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="keterangan" class="col-lg-3">Keterangan</label>
            <div class="col-lg-9">
            <textarea name="keterangan" id="keterangan" class="form-control"><?=$jadwal['keterangan']?></textarea>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ti ti-square-x"></i> Batal</button>
        <button type="submit" id="btn-tambahkan" class="btn btn-success"><i class="ti ti-checkbox"></i> Simpan Perubahan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    $('#form-agenda').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?=base_url('teacher/jurnal/agenda/save')?>",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend : function () { 
                $('#btn-tambahkan').prop('disabled', true)
                $('#btn-tambahkan').html(`  <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
  <span class="visually-hidden" role="status">Loading...</span>`)
            },
            complete : function () {  

                $('#btn-tambahkan').prop('disabled', false)
                $('#btn-tambahkan').html(`<i class="ti ti-checkbox"></i> Tambahkan`)
            },
            success: function (response) {
                  // Is Sukses 
                if (response.status=true) {
                Toastify({
                text: 'Agenda Pertemuan Diperbarui',
                afterHidden: function () {
                }    
                }).showToast();
                $('#modal-agenda').modal('hide')
                DaftarAgenda()
                RekapPresensi()

                }
            }
        });
        
    });
</script>


