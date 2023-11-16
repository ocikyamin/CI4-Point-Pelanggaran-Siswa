<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<div class="card p-0">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">History Mencatat Pelanggaran</h5>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
<table class="table table-striped table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tgl</th>
            <th><i class="ti ti-user"></i> Siswa</th>
            <th>Pelanggaran</th>
            <th>Poin</th>
            <th class="text-center"><i class="ti ti-settings"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($history as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
            <td><?=$d['nama_siswa']?></td>
            <td><?=$d['nama_pelanggaran']?></td>
            <td><?=$d['poin']?></td>
            <td class="text-center">
                <button onclick="EditPelanggaran(<?=$d['id']?>)" class="btn btn-success btn-sm"><i class="ti ti-pencil"></i> Ubah</button>
                <button onclick="HapusPelanggaran(<?=$d['id']?>)" class="btn btn-danger btn-sm">Batal</button>
            </td>
        </tr>
        <?php } ?>

    </tbody>
</table>
</div>
            </div>
        </div>
    </div>
</div>
<div class="modalview"></div>
<script>
    function HapusPelanggaran(id) {
            Swal.fire({
            title: 'Are you sure?',
            text: "Tindakan ini akan menghapus data pelanggaran secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?=base_url('teacher/history/delete')?>",
                    data: {id:id},
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            location.reload();
                        }
                    }
                });
            }
            })
    }

    // EditPelanggaran 

    function EditPelanggaran(id) {
        $.ajax({
            type: "post",
            url: "<?=base_url('teacher/student/form-edit-pelanggaran')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.view)
                $('#modal-edit-pelanggaran').modal('show')
            }
           });
    }
</script>



<?= $this->endSection() ?>