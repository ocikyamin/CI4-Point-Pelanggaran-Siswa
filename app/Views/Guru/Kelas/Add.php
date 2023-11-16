<!-- Modal -->
<div class="modal fade" id="modal-kelas"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header shadow-sm">
        <h1 class="modal-title fs-5">Buat Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-kelas">
        <?=csrf_field()?>
        <input type="hidden" name="guru_id" value="<?=TeacherLogin()->id?>">
        
      <div class="modal-body">
      <div class="form-floating mb-3">
            <select class="form-select" name="semester_id" id="semester_id" required aria-label="Floating label select example">
            <option value="" selected> Pilih Semester</option>
            <?php
            foreach ($semester as $d):?>
            <option value="<?=$d['id']?>"><?=$d['semester']?></option>
            <?php endforeach; ?>
            </select>
            <label for="semester_id">Semester</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select" name="mapel_id" id="mapel_id" required aria-label="Floating label select example">
            <option value="" selected> Pilih Mata Pelajaran</option>
            <?php
            foreach ($mapel as $d):?>
            <option value="<?=$d['id']?>"><?=$d['mapel']?></option>
            <?php endforeach; ?>
            </select>
            <label for="mapel_id">Mata Pelajaran</label>
            </div>

       

            <div class="form-floating mb-3">
          <select class="form-select" name="rombel_walas_id" id="rombel_walas_id" required>
                    <option value="">Pilih Kelas</option>
                    <?php
                    foreach ($level as $l):?>
                    <option value=""><?=strtoupper($l['level_kelas'])?></option>
                    <?php
                    if (!empty(RombelByLevel($l['id']))) {
                    foreach (RombelByLevel($l['id']) as $r) {
                    ?>
                    <option value="<?=$r['id']?>"><?=$r['rombel']?></option>
                    <?php
                    }
                    }
                    ?>
                    <?php endforeach ;?>
          </select>
          <label for="rombel_walas_id">Kelas</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="deskripsi" placeholder="Catatan Tambahan / deskripsi" id="deskripsi" style="height: 100px"></textarea>
            <label for="deskripsi">Catatan Tambahan / Keterangan</label>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Buat Kelas</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
 

  $('#form-kelas').submit(function (e) { 
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "<?=base_url('teacher/kelas/save')?>",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
       // If in-valid 
       if (response.error) {
          if (response.error.jenis_pelanggaran) {
            $('#jenis-pelanggaran').addClass('is-invalid');
            Toastify({
            text: response.error.jenis_pelanggaran      
            }).showToast();
          }

          if (response.error.pelanggaran_id) {
            $('#item-pelanggaran').addClass('is-invalid');
            Toastify({
            text: response.error.pelanggaran_id      
            }).showToast();
          }
          if (response.error.tgl_kejadian) {
            $('#tgl_kejadian').addClass('is-invalid');
            Toastify({
            text: response.error.tgl_kejadian      
            }).showToast();
          }

        }


        // Is Sukses 
        if (response.status) {
            Toastify({
                text: 'Data Kelas Berasil Ditambahkan',
                afterHidden: function () {
                }    
            }).showToast();
            $('#modal-kelas').modal('hide')
            TableKelas();
            
        }




        
      }
    });
  
    
  });
</script>