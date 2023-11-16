<!-- Modal -->
<div class="modal fade" id="modal-setting-kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-gear"></i> Pengaturan Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-setting-kelas" method="post">
        <?=csrf_field()?>
        <input type="hidden" name="guru_id" value="<?=$guru_id?>">
        <input type="hidden" name="periode_id" value="<?=PeriodeAktif()->id?>">
        
      <div class="modal-body">

          <div class="form-group mb-2">
          <select class="form-control" name="sekolah_id" id="pilih-satuan-sekolah">
          <option value="">Plih Tingkat Pendidikan</option>
          <?php
          foreach ($sekolah as $s):?>
          <option value="<?=$s['id']?>"><?=$s['nm_sekolah']?></option>
          <?php endforeach; ?>
          </select>
          </div>

          <div class="form-group mb-2">
          <select name="level_kelas_id" class="form-control" id="pilih-level-kelas">
          <option value="">Pilih Tingkat Kelas</option>
          </select>
          </div>

          <div class="form-group mb-2">
          <select name="kelas_rombel_id" class="form-control" id="pilih-rombel">
          <option value="">Pilih Rombel</option>
          </select>
          </div>
        <div class="alert alert-light">
        <p>
        Harap Klik Centang dibawah ini sebelum menyimpan Pengaturan
        </p> 
        <div class="form-check">
        <input class="form-check-input primary" name="is_confirm" type="checkbox" value="1" id="is_confirm">
        <label class="form-check-label text-dark" for="is_confirm">
        Benar,  saya adalah Guru Kelas dari pilihan di atas  untuk Tahun Pelajaran ( <strong><?=PeriodeAktif()->nm_periode?></strong> ) 
        </label>
        </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="btn-simpan-pengaturan">Simpan Pengaturan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
   $('#pilih-satuan-sekolah').change(function (e) { 
    e.preventDefault();
      if (!$(this).val()=="") {
        $.ajax({
        url: "<?=base_url('master/kelas-level')?>",
        data: {sekolah_id: $(this).val()},
        dataType: "json",
        success: function (response) {
          if (response.kelas_level) {
            $('#pilih-level-kelas').html('<option value="">Pilih Tingkat Kelas</option>'+response.kelas_level)
          }else{
            $('#pilih-level-kelas').html('<option value=""> Pilih Tingkat Kelas</option>')
          }
        }
        });
      }
   });

   $('#pilih-level-kelas').change(function (e) { 
    e.preventDefault();
      if (!$(this).val()=="") {
        $.ajax({
        url: "<?=base_url('master/kelas-rombel')?>",
        data: {level_id: $(this).val()},
        dataType: "json",
        success: function (response) {
          if (response.kelas_rombel) {
            $('#pilih-rombel').html('<option value="">Pilih Rombel</option>'+response.kelas_rombel)
          }else{
            $('#pilih-rombel').html('<option value=""> Pilih Rombel</option>')
          }
        }
        });
      }
   });
// Simpan Pengaturan 
$('#form-setting-kelas').submit(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: "<?=base_url('teacher/setting/simpan-pengaturan-kelas')?>",
    data: $(this).serialize(),
    dataType: "json",
        beforeSend: function () {
        $('#btn-simpan-pengaturan').html('Loading...');
        },
        complete: function() {
        $('#btn-simpan-pengaturan').prop('disabled', false);
        $('#btn-simpan-pengaturan').html(`Simpan Pengaturan`);
        },
    success: function (response) {
        // If in-valid 
        if (response.error) {
          if (response.error.sekolah_id) {
            $('#pilih-satuan-sekolah').addClass('is-invalid');
            Toastify({
            text: response.error.sekolah_id      
            }).showToast();
          }

          if (response.error.level_kelas_id) {
            $('#pilih-level-kelas').addClass('is-invalid');
            Toastify({
            text: response.error.level_kelas_id      
            }).showToast();
          }

          if (response.error.kelas_rombel_id) {
            $('#pilih-rombel').addClass('is-invalid');
            Toastify({
            text: response.error.kelas_rombel_id      
            }).showToast();
          }

          if (response.error.is_confirm) {
            $('#is_confirm').addClass('is-invalid');
            Toastify({
            text: response.error.is_confirm      
            }).showToast();
          }
          
         }

         if (response.sukses) {
          window.location= '<?=base_url('teacher')?>';
        }
    
        }

       
  });

  
});

</script>