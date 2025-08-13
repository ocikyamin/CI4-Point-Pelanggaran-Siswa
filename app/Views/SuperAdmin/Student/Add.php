<!-- Modal -->
<div class="modal fade" id="modal-siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-plus"></i> Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-siswa" method="post">
        <?=csrf_field()?>
        <input type="hidden" name="rombel_id" value="<?=$rombel_id?>">
        
      <div class="modal-body">

          <div class="form-group mb-2">
            <label for="nisn">NISN / No.BP<span class="taxt-danger">*</span></label>
            <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Nomor Induk Siswa Nasional">
          </div>

          <div class="form-group mb-2">
            <label for="nama_siswa">Nama Lengkap Siswa <span class="taxt-danger">*</span></label>
            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Lengkap Siswa">
          </div>
          <div class="mb-2">
            <p>
                Jenis Kelamin
            </p>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input jk" type="radio" name="jk" id="jk_l" value="L">
                    <label class="form-check-label" for="jk_l">
                    Laki-laki
                    </label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input jk" type="radio" name="jk" id="jk_p" value="P">
                    <label class="form-check-label" for="jk_p">
                    Perempuan
                    </label>
                    </div>
                    </div>
          <div class="form-group mb-2">
            <label for="nama_ortu">Nama Orang Tua <span class="taxt-danger">*</span></label>
            <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" placeholder="mis : Nama Ayah">
          </div>
          <div class="form-group mb-2">
            <label for="hp_ortu">HP/WhatsApp Ortu <span class="taxt-danger">*</span></label>
            <input type="number" class="form-control" name="hp_ortu" id="hp_ortu" placeholder="Kontak Orang Tua">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="btn-simpan-siswa">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>

// Simpan Pengaturan 
$('#form-siswa').submit(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: "<?=base_url('admin/student/save')?>",
    data: $(this).serialize(),
    dataType: "json",
        beforeSend: function () {
            $('#btn-simpan-siswa').prop('disabled', true);
        $('#btn-simpan-siswa').html('Loading...');
        },
        complete: function() {
        $('#btn-simpan-siswa').prop('disabled', false);
        $('#btn-simpan-siswa').html(`Tambahkan`);
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
            $('.jk').addClass('is-invalid');
            Toastify({
            text: response.error.jk      
            }).showToast();
          }

          if (response.error.rombel_id) {
            $('#nisn').addClass('is-invalid');
            Toastify({
            text: response.error.rombel_id      
            }).showToast();
          }
          
         }

         if (response.sukses) {
            $('#modal-siswa').modal('hide')
            Toastify({
            text: response.msg      
            }).showToast();
            LoadSiswaRombel(<?=$rombel_id?>) 
        }
    
        }

       
  });

  
});

</script>