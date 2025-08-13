<div class="table-responsive">
<table class="table table-striped table-sm table-hover" id="tabel-user-guru">
    <thead>
        <tr>
            <th>No.</th>
            <th>NUPTK</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th> <i class="ti ti-settings"></i> </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($guru as $s):?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=$s['nuptk']?></td>
            <td>
                <b><?=$s['nm_guru']?></b>
            <div><small><?=$s['nm_sekolah']?></small></div>
        </td>
            <td><?=$s['jabatan']?></td>
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
                <button onclick="EditGuru(<?=$s['id']?>)" class="btn btn-dark btn-sm"><i class="ti ti-edit"></i></button>
                <button onclick="DeleteGuru(<?=$s['id']?>)" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<script>
$(document).ready(function () {
$('#tabel-user-guru').DataTable();
});
function EditGuru(id) {
    $.ajax({
    url: "<?=base_url('admin/users/guru/edit')?>",
    data: {id:id},
    dataType: "json",
    success: function (response) {
        $('.view-modal').html(response.view).show()
        $('#guru-modal').modal('show')
    }
});
  }

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
function DeleteGuru(guru_id) {
Swal.fire({
title: 'Are you sure?',
text: "Tindakah ini akan mengahpus data guru, termasuk riwayat aktifitas guru",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Ya, Hapus',
cancelButtonText: 'Batal'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
url: "<?=base_url('admin/users/guru/del')?>",
data: {id:guru_id},
type : 'post',
dataType: "json",
success: function (response) {
if (response.status==true) {

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