<div class="row">
    <?php
foreach ($jadwal as $k) {?>
<div class="col-lg-4">
<div class="card overflow-hidden rounded-3">
<div class="position-relative">
<a href="<?=base_url('teacher/jurnal/agenda/'.$k['id'])?>">
    <img src="<?=base_url('public')?>/assets/images/img_backtoschool.jpg" class="card-img-top rounded-0" alt="...">
</a>
<!-- <a class="d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
aria-expanded="false">
<img src="<?=base_url('public/')?>assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
</a>                  -->
</div>
<div class="card-body pt-3 p-4">
<h6 class="fw-semibold fs-4"><?=$k['mapel']?> </h6>
<div class="d-flex align-items-center justify-content-between">
    <h6 class="fw-semibold fs-4 mb-0">
        Kelas (<?=$k['rombel']?>)
    </h6>
    <span class="ms-2 fw-normal text-muted fs-3"><?=$k['waktu']?></span>
    <span class="ms-2 fw-normal text-muted fs-3"><?=$k['nm_periode']?> (<?=$k['semester']?>)</span>

</div>
<div class="float-lg-end">
    <button onclick="HapusJadwal(<?=$k['id']?>)" class="btn btn-dark btn-sm mt-3"><i class="ti ti-trash-x"></i></button>
    <button onclick="EditJadwal(<?=$k['id']?>)" class="btn btn-dark btn-sm mt-3"><i class="ti ti-edit"></i> Edit Jadwal</button>
</div>
</div>
</div>

</div>
<?php } ?>
</div>
<div class="modaleditjadwal"></div>
<script>
    //ubah jadwal 
    function EditJadwal(id) {
        $.ajax({
            url: "<?=base_url('teacher/jurnal/jadwal/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modaleditjadwal').html(response.form_kelas)
                $('#modal-kelas').modal('show')
            }
        });
        
    }
    function HapusJadwal(id) {
            Swal.fire({
            title: 'Are you sure?',
            text: "Tindakan ini akan menghapus semua data mengajar secara permanen termasuk data kehadiran siswa.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data Permanen!',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
            type: "post",
            url: "<?=base_url('teacher/jurnal/jadwal/delete')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
            if (response.status) {
            Swal.fire(
            'Deleted!',
            response.msg,
            'success'
            ).then((result) => {
            TableKelas()
            })
            }
            }
            });
            }
            })
    }
    
</script>

