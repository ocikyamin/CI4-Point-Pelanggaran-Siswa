<div class="modal fade" id="modal-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-settings"></i> Tambah Item Pelanggaran</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="form-item-langgar">
    <?=csrf_field();?>
    <input type="hidden" name="jenis" value="<?=$jenis->id?>">
<div class="modal-body">
    <p>
       Jenis / Kategori :  <b><?=$jenis->jenis?></b>
    </p>
<div class="form-floating mb-2">
  <input type="text" name="nama_pelanggaran" class="form-control" id="item-langgar" placeholder="name@example.com">
  <label for="item-langgar">Nama / Item Pelanggaran</label>
  <div class="invalid-feedback langgar"></div>
</div>
<div class="form-floating">
    <input type="number" name="poin" class="form-control" id="poin-langgar" placeholder="name@example.com">
    <label for="poin-langgar">Jumlah Poin</label>
    <div class="invalid-feedback poin"></div>
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
    $('#form-item-langgar').submit(function (e) { 
        e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/langgar/store')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            if (response.status==false) {
                if (response.nama_pelanggaran) {
                    
                    $('#item-langgar').addClass('is-invalid')
                    $('.langgar').text(response.nama_pelanggaran)
                }
                if (response.poin) {
                    $('#poin-langgar').addClass('is-invalid')
                    
                    $('.poin').text(response.poin)
                }
            }
            if (response.status==true) {
                $('#modal-item').modal('hide')
                LoadJenisLanggar()
                
            }
        }
    });
    });
</script>