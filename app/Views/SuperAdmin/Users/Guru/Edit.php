<div class="modal fade" id="guru-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-settings"></i> Edit Guru</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="form-guru">
    <?=csrf_field();?>
    <input type="hidden" name="id" value="<?=$d['id']?>">
    <input type="hidden" name="old_nuptk" value="<?=$d['nuptk']?>">

<div class="modal-body">
                  <div class="mb-2">
                            <label for="sekolah" class="form-label">Sekolah / Madrasah</label>
                            <select class="form-select" name="sekolah_id" id="sekolah">
                                <option value="">Sekolah / Madrasah</option>
                                <?php if (ListOfSekolah()): ?>
                                    <?php foreach (ListOfSekolah() as $p): ?>
                                        <option value="<?= $p['id'] ?>" <?=$d['sekolah_id']==$p['id'] ? 'selected':null ?>><?= $p['nm_sekolah'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                  <div class="mb-2">
                    <label for="full_name" class="form-label">Nama Lengkap & Gelar</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" value="<?=$d['nm_guru']?>" placeholder="ex : Abdullah, S. Ag">
                  </div>
                  <div class="mb-2">
                    <label for="nuptk" class="form-label">NIP/NUPTK</label>
                    <input type="number" name="nuptk" class="form-control" id="nuptk" value="<?=$d['nuptk']?>" placeholder="ex : 212321001">
                  </div>

                  <div class="mb-2">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select" name="jabatan_id" id="jabatan">
                                <option value="">Pilih Jabatan</option>
                                <?php if (ListOfJabatan()): ?>
                                    <?php foreach (ListOfJabatan() as $p): ?>
                                        <option value="<?= $p['id'] ?>" <?=$d['jabatan_id']==$p['id'] ? 'selected':null ?>><?= $p['jabatan'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                 
<!-- 
                  <div class="mb-2">
                    <label for="new_user_password" class="form-label">Password Baru</label>
                    <input type="password" name="new_password" class="form-control" id="new_user_password" placeholder="Masukkan Password Baru">
                  </div> -->

                  <!-- <div class="mb-2">
                    <label for="conf_user_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="conf_password" class="form-control" id="conf_user_password" placeholder="Masukkan Konfirmasi Password">
                  </div> -->

        
               

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
<button type="submit" class="btn btn-primary">Tambahkan</button>
</div>
</form>
</div>
</div>
</div>
<script>
    // Register 
    $('#form-guru').submit(function (e) { 
      e.preventDefault();
      $.ajax({
        type: "post",
        url: "<?=base_url('admin/users/guru/store')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
if (response.error) {

  if (response.error.nuptk) {
    $('#nuptk').addClass('is-invalid');
        Toastify({
        text: response.error.nuptk      
        }).showToast();
  }

  if (response.error.full_name) {
    $('#full_name').addClass('is-invalid');
        Toastify({
        text: response.error.full_name
        }).showToast();
  }

  if (response.error.jabatan_id) {
        Toastify({
        text: response.error.jabatan_id
        }).showToast();
  }

  if (response.error.new_password) {
    $('#new_user_password').addClass('is-invalid');
        Toastify({
        text: response.error.new_password
        }).showToast();
  }

  if (response.error.sekolah_id) {
    $('#conf_user_password').addClass('is-invalid');
        Toastify({
        text: response.error.sekolah_id
        }).showToast();
  }



}

if (response.status) {
Swal.fire(
      'Success!',
      response.msg,
      'success'
    ).then((result) => {
        $('#guru-modal').modal('hide')

        GuruList()
})

}
       
        }
      });

      
    });
  </script>