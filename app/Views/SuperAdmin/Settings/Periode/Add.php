<div class="modal fade" id="modal-periode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-settings"></i> Tambah Periode / TP</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="form-periode">
    <?=csrf_field();?>

<div class="modal-body">

<div class="form-floating mb-2">
  <input type="text" name="nm_periode" class="form-control" id="periode" placeholder="Tahun Pelajaran">
  <label for="periode">Tahun Pelajaran</label>
  <div class="invalid-feedback periode"></div>
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
    $('#form-periode').submit(function (e) { 
        e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/periode/store')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            if (response.status==false) {
                if (response.nm_periode) {
                    $('#periode').addClass('is-invalid')
                    $('.periode').text(response.nm_periode)
                }
            
            }
            if (response.status==true) {
                $('#modal-periode').modal('hide')
                LoadPeriode()
                
            }
        }
    });
    });
</script>