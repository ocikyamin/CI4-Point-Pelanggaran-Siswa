<div class="table-responsive">
<table class="table table-striped table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>NUPTK</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Status</th>
            <th> <i class="ti ti-settings"></i> </th>
            <th> <i class="ti ti-settings"></i> </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($guru as $s):?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=$s['nuptk']?></td>
            <td><?=$s['nm_guru']?></td>
            <td><?=$s['type']?></td>
            <td>
                <?=$s['is_active']==1 ? "<span class='badge bg-success'>Aktif</span>":"<span class='badge bg-warning'>Tidak Aktif</span>"?>
            </td>
            <td>
            <div class="form-check form-switch">
            <input class="form-check-input set_status" type="checkbox" value="<?=$s['id']?>" role="switch" id="status-<?=$s['id']?>"  <?=$s['is_active']==1 ? "checked":null ?>>
            <label class="form-check-label" for="status-<?=$s['id']?>"></label>
            </div>
            </td>
            <td>
                <button onclick="ResetPassword(<?=$s['id']?>)" class="btn btn-light btn-sm"><i class="ti ti-key"></i> Reset Password</button>
                <a href="" class="btn btn-dark btn-sm"><i class="ti ti-edit"></i></a>
                <a href="" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<script>
    $('.set_status').click(function (e) { 
        e.preventDefault();
        // alert($(this).val())
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/users/guru/status')?>",
            data: {id : $(this).val()},
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    Toastify({
                    text: response.pesan      
                    }).showToast();
                    GuruList()   
                }
                
            }
        });
        
    });
    function ResetPassword(guru_id) {
        Swal.fire({
  title: 'Are you sure?',
  text: "Tindakah ini akan mereset Password",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Reset Password',
  cancelButtonText: 'Batal'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
          url: "<?=base_url('admin/users/guru/reset')?>",
          data: {id:guru_id},
          type : 'post',
          dataType: "json",
          success: function (response) {
            if (response.sukses) {
              
              Swal.fire(
              'Sukses',
              response.pesan,
              'success'
              ).then((result) => {
              GuruList()
              })
            }
            // 

          }
        });

  }
})
    }
</script>