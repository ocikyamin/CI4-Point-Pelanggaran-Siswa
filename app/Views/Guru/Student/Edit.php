<!-- Modal -->
<div class="modal fade" id="modal-edit-siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-edit"></i> Edit Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-edit-siswa" method="post">
        <?=csrf_field()?>
        <input type="hidden" name="siswa_id" value="<?=$siswa['id']?>">
        <input type="hidden" name="rombel_id" value="<?=$rombel_id?>">
        
      <div class="modal-body">

          <div class="form-group mb-2">
             <label for="nisn">NISN / No.BP<span class="taxt-danger">*</span></label>
            <input type="text" class="form-control" name="nisn" id="nisn" value="<?=$siswa['nisn']?>" placeholder="Nomor Induk Siswa Nasional">
            <input type="hidden" name="old_nisn" value="<?=$siswa['nisn']?>">
          </div>

          <div class="form-group mb-2">
            <label for="nama_siswa">Nama Lengkap Siswa <span class="taxt-danger">*</span></label>
            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" value="<?=$siswa['nama_siswa']?>" placeholder="Nama Lengkap Siswa">
          </div>
            <div class="mb-2">
            <p> Jenis Kelamin </p>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jk" id="jk_l" value="L" <?=$siswa['jk']== 'L' ? 'checked':null?>>
            <label class="form-check-label" for="jk_l">
            Laki-laki
            </label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jk" id="jk_p" value="P" <?=$siswa['jk']== 'P' ? 'checked':null?>>
            <label class="form-check-label" for="jk_p">
            Perempuan
            </label>
            </div>
            </div>
          <div class="form-group mb-2">
            <label for="nama_ortu">Nama Orang Tua <span class="taxt-danger">*</span></label>
            <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" value="<?=$siswa['nama_ortu']?>" placeholder="mis : Nama Ayah">
          </div>
          <div class="form-group mb-2">
            <label for="hp_ortu">HP/WhatsApp Ortu <span class="taxt-danger">*</span></label>
            <input type="number" class="form-control" name="hp_ortu" id="hp_ortu" value="<?=$siswa['hp_ortu']?>" placeholder="Kontak Orang Tua">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="btn-edit-siswa">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>

// Simpan Pengaturan 
$('#form-edit-siswa').submit(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: "<?=base_url('teacher/student/update')?>",
    data: $(this).serialize(),
    dataType: "json",
        beforeSend: function () {
        $('#btn-edit-siswa').html('Loading...');
        },
        complete: function() {
        $('#btn-edit-siswa').prop('disabled', false);
        $('#btn-edit-siswa').html(`Simpan Perubahan`);
        },
    success: function (response) {
        // If in-valid 
        if (response.error) {
          if (response.error.nisn) {
            $('#nisn').addClass('is-invalid');
            Toastify({
            text: response.error.nisn      
            }).showToast();
          }

          if (response.error.nama_siswa) {
            $('#nama_siswa').addClass('is-invalid');
            Toastify({
            text: response.error.nama_siswa      
            }).showToast();
          }

          if (response.error.jk) {
            $('.form-check-input').addClass('is-invalid');
            Toastify({
            text: response.error.jk      
            }).showToast();
          }
          
         }

         if (response.sukses) {
            $('#modal-edit-siswa').modal('hide')
            Toastify({
            text: response.msg      
            }).showToast();
            table_siswa_rombel(<?=$rombel_id?>);
        }
    
        }

       
  });

  
});

</script>