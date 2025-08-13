
<!-- Modal -->
<div class="modal fade" id="modal-form-rombel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Rombel / Walas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-rombel-walas">
        <?=csrf_field();?>
        <input type="hidden" name="id" value="<?=$d['id']?>">
        <input type="hidden" name="sekolah_id" value="<?=$sekolah?>">
        <input type="hidden" name="periode_id" value="<?=$d['periode_id']?>">
        <input type="hidden" name="level_id" value="<?=$d['level_kelas_id']?>">
      <div class="modal-body">
        <div class="form-group mb-2">
            <label for="">Nama Rombel</label>
            <input type="text" name="rombel" id="rombel" value="<?=$d['rombel']?>" class="form-control">
            <div class="invalid-feedback rombel"></div>
        </div>  
        
        <div class="form-group">
            <select class="form-select" name="guru_id" id="guru_id">
                <option value="" selected>Pilih Wali Kelas</option>
                <?php
            foreach ($guru as $g) {
                ?>
            <option value="<?=$g['id']?>" <?=$g['id']==$d['guru_id'] ? 'selected':null ?> ><?=$g['nm_guru']?> (<?=$g['nuptk']?>)</option>
            <?php
            }
            ?>
            </select>
            <div class="invalid-feedback guru"></div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    $('#form-rombel-walas').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/walas/store')?>",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status==false) {
                    if (response.rombel) {
                        $('#rombel').addClass('is-invalid')
                        $('.rombel').text(response.rombel)
                        
                    }else if(response.guru_id) {
                        $('#guru_id').addClass('is-invalid')
                        $('.guru').text(response.guru_id)
                        
                    }
                    
                }


                if (response.status==true) {
                    $('#modal-form-rombel').modal('hide')
                    WalasPeriode(response.periode,response.sekolah)
                }
                
            }
        });
        
    });
</script>