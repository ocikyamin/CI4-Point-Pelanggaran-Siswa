<?php
use App\Models\PelanggaranItemModel;
$jenisM = New PelanggaranItemModel();
// var_dump($jenis);
if (!$jenis) {
    # code...
    echo "Belum Jenis Pelanggaran";
}
?>

<div class="table-responsive">
<table class="table table-sm">
<thead>
<tr>
<th class="text-center"><i class="ti ti-settings"></i></th>
<th>JENIS / ITEM PELANGGARAN</th>
<th>POIN</th>
</tr>
</thead>
<tbody>
    <?php
foreach ($jenis as $j) {

    $items = $jenisM->PelanggaranByJenis($j['id']);
    
    ?>
<tr class="bg-dark text-white">
    <td>
        <!-- <a href="" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
        <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button> -->
        
    </td>
    <td><b><?=$j['jenis']?></b> 
    <span>
    <a href="" class=""><i class="ti ti-edit"></i></a>
    <a class=""><i class="ti ti-trash"></i></a>

    </span>
</td>
    <td class="bg-white text-center">
        <button onclick="AddItem(<?=$j['id']?>)"  class="btn btn-primary btn-sm"><i class="ti ti-plus"></i></button>
    </td>
</tr>

<?php
if ($items) {
    $no =1;
    foreach ($items as $item) {
       ?>
       <tr>
        <td class="text-center"><?=$no++?>.</td>
        <td>
        <a href="#" onclick="EditItem(<?=$item['id']?>)" class="text-primary"><i class="ti ti-edit"></i></a>
        <a href="#" onclick="DeleteItem(<?=$item['id']?>)" class="text-danger"><i class="ti ti-trash"></i></a>
            <?=$item['nama_pelanggaran']?></td>
        <td class="text-center"><?=$item['poin']?></td>
       </tr>
       <?php
    }
}else{
    echo "<tr><td>Beulum ada item</td></tr>";
}
?>
<?php } ?>
</tbody>
</table>
</div>
<div id="viewmodal"></div>
<script>
    function AddItem(id) {
        $.ajax({
            url: "<?=base_url('admin/setting/langgar/add')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('#viewmodal').html(response.view).show()
                $('#modal-item').modal('show')
            }
        });
        
    }
    function EditItem(id) {
        $.ajax({
            url: "<?=base_url('admin/setting/langgar/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('#viewmodal').html(response.view).show()
                $('#modal-item').modal('show')
            }
        });
        
    }
    
    // HAPUS
    function DeleteItem(id) {
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/setting/langgar/del')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                if (response.status==true) {
                LoadJenisLanggar()
                
            }
            }
        });
        
    }
    
    
</script>