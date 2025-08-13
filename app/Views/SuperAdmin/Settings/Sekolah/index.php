
<div class="alert mb-3 py-2 shadow">
 
    <button onclick="AddSekolah()" class="btn btn-dark btn-sm mr-5"><i class="ti ti-plus"></i> New</button>
<b><i class="ti ti-settings"></i></b> Pengaturan Sekolah / Madrasah
</div>
<div class="table-responsive">
<table class="table table-sm">
<thead>
<tr>
<th class="text-center"><i class="ti ti-settings"></i></th>
<th>NAMA SEKOLAH / MADRASAH</th>
<th>KEPALA</th>
</tr>
</thead>
<tbody>
    <?php
foreach ($sekolah as $p) {?>
<tr>
    <td class="text-center">
    <a href="#" onclick="EditSekolah(<?=$p['id']?>)" class="text-primary"><i class="ti ti-edit"></i></a>
    <a href="#" onclick="DeleteSekolah(<?=$p['id']?>)" class="text-danger"><i class="ti ti-trash"></i></a>
    </td>
    <td><?=$p['nm_sekolah']?></td>
    <td><?=$p['kepsek']?></td>
<td>

</td>
</tr>
<?php } ?>

</tbody>
</table>
</div>
<div id="viewmodal-sekolah"></div>
<script>


    function AddSekolah() {
        $.ajax({
            url: "<?=base_url('admin/setting/sekolah/add')?>",
            data: 'data',
            dataType: "json",
            success: function (response) {
                $('#viewmodal-sekolah').html(response.view).show()
                $('#modal-sekolah').modal('show')
            }
        });
        
    }
    function EditSekolah(id) {
        $.ajax({
            url: "<?=base_url('admin/setting/sekolah/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('#viewmodal-sekolah').html(response.view).show()
                $('#modal-sekolah').modal('show')
            }
        });
        
    }
    
    // HAPUS
    function DeleteSekolah(id) {
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/setting/sekolah/del')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                if (response.status==true) {
                    LoadSekolah()
                
            }
            }
        });
        
    }
    
    
</script>