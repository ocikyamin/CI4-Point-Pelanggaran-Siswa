<div class="modal fade" id="modal-sekolah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-settings"></i> Tambah Sekolah</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="form-sekolah">
    <?=csrf_field();?>

<div class="modal-body">

<div class="form-floating mb-2">
  <input type="text" name="nm_sekolah" class="form-control" id="sekolah" placeholder="Tahun Pelajaran">
  <label for="sekolah">Nama Sekolah / Madrasah</label>
  <div class="invalid-feedback sekolah"></div>
</div>
<div class="form-floating mb-2">
  <input type="text" name="kepsek" class="form-control" id="kepsek" placeholder="Tahun Pelajaran">
  <label for="kepsek">Nama Kepala Sekolah / Madrasah</label>
  <div class="invalid-feedback kepsek"></div>
</div>

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
    $('#form-sekolah').submit(function (e) { 
        e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/sekolah/store')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            if (response.status==false) {
                if (response.nm_sekolah) {
                    $('#sekolah').addClass('is-invalid')
                    $('.sekolah').text(response.nm_sekolah)
                }
                if (response.kepsek) {
                    $('#kepsek').addClass('is-invalid')
                    $('.kepsek').text(response.kepsek)
                }
            
            }
            if (response.status==true) {
                $('#modal-sekolah').modal('hide')
                LoadSekolah()
                
            }
        }
    });
    });
</script>