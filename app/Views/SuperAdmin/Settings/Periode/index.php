
<div class="alert mb-3 py-2 shadow">
 
<button onclick="AddPeriode()" class="btn btn-dark btn-sm mr-5"><i class="ti ti-plus"></i> New</button> <b><i class="ti ti-settings"></i></b> Pengaturan Periode / Tahun Pelajaran

</div>
<div class="table-responsive">
<table class="table table-sm">
<thead>
<tr>
<th class="text-center"><i class="ti ti-settings"></i></th>
<th>PERIODE / TA</th>
<th>STATUS</th>
</tr>
</thead>
<tbody>
    <?php
foreach ($periode as $p) {?>
<tr>
    <td class="text-center">
    <a href="#" onclick="EditPeriode(<?=$p['id']?>)" class="text-primary"><i class="ti ti-edit"></i></a>
    <a href="#" onclick="DeletePeriode(<?=$p['id']?>)" class="text-danger"><i class="ti ti-trash"></i></a>
    </td>
    <td><b><?=$p['nm_periode']?></b>
    <div>
        <?php
        // if ($p['status_periode']==1) {
        
        // }
        foreach ($semester as $s) {
            ?>
         <div class="form-check form-switch">
         <input class="form-check-input set-semester" data-idsem="<?=$s['id']?>" data-sttsem="<?=$s['status']?>" data-idperiode="<?=$p['id']?>" type="checkbox" role="switch" id="sttsem-<?=$s['id']?>" 
         
         <?php
         if ($s['periode_id']==$p['id'] && $s['status']==1) {
             echo 'checked';
         }
         ?>>
         <label class="form-check-label" for="sttsem-<?=$s['id']?>">
         <?=$s['semester']?></label>
         </div>
 
            <?php
         }
        ?>
    </div>
 </td>
    <td>
<div class="form-check form-switch">
<input class="form-check-input set-status" data-id="<?=$p['id']?>" data-status="<?=$p['status_periode']?>" type="checkbox" role="switch" id="status-<?=$p['id']?>" <?=$p['status_periode']==1 ? 'checked':null?>>
<label class="form-check-label" for="status-<?=$p['id']?>">
<?=$p['status_periode']==1 ? '<span class="badge rounded-pill text-bg-primary">Aktif</span>':'<span class="badge rounded-pill text-bg-danger">Tidak Aktif</span>'?>
</label>
</div>
        
    </td>
<td>

</td>
</tr>
<?php } ?>

</tbody>
</table>
</div>
<div id="viewmodal-periode"></div>
<script>

// status semeseter 
$('.set-semester').click(function (e) { 
    e.preventDefault();
    var semester_id = $(this).data('idsem');
    var status = $(this).data('sttsem');
    var periode_id = $(this).data('idperiode');

    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/periode/setsem')?>",
        data: {
            id:semester_id,
            status:status,
            periode_id:periode_id,
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            // if (response.status==false) {
            //     alert(response.msg)
            // }
            if (response.status==true) {
                Toastify({
                text: 'Status Diperbarui',
                className: "success",
                }).showToast();
                LoadPeriode()
            }
        }
    });

    
});

// update status 

$('.set-status').click(function (e) { 
    e.preventDefault();

    var id = $(this).data('id');
    var status = $(this).data('status');
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/periode/set')?>",
        data: {
            id:id,
            status:status
        },
        dataType: "json",
        success: function (response) {
            if (response.status==false) {
                alert(response.msg)
            }
            if (response.status==true) {
                Toastify({
                text: response.msg,
                className: "success",
                }).showToast();
                LoadPeriode()
            }
        }
    });
    
});

    function AddPeriode() {
        $.ajax({
            url: "<?=base_url('admin/setting/periode/add')?>",
            data: 'data',
            dataType: "json",
            success: function (response) {
                $('#viewmodal-periode').html(response.view).show()
                $('#modal-periode').modal('show')
            }
        });
        
    }
    function EditPeriode(id) {
        $.ajax({
            url: "<?=base_url('admin/setting/periode/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('#viewmodal-periode').html(response.view).show()
                $('#modal-periode').modal('show')
            }
        });
        
    }
    
    // HAPUS
    function DeletePeriode(id) {
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/setting/periode/del')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                if (response.status==true) {
                    LoadPeriode()
                
            }
            }
        });
        
    }
    
    
</script>