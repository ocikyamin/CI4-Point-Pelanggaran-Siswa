<?php
// echo "<pre>";
// print_r($result);
// echo "</pre>";


if (empty($result)) {
   echo "<div class='alert alert-danger'>Tidak ada Hasil Ditemukan....</div>";
}else{
    ?>
    <div class="table-responsive">           
<table class="table table-sm table-striped table-bordered table-hover mt-3">
    <thead>
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Walas</th>
        <th class="text-center"><i class="ti ti-settings"></i></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    foreach ($result as $s):?>
    <tr onclick="TambahPelanggaran(<?=$s['siswa_rombel_id']?>)">
    <td><?=$i++?>.</td>
        <td><?=$s['nama_siswa']?></td>
        <td><?=$s['rombel']?></td>
        <td><?=$s['nm_guru']?></td>
        <td class="text-center">
            <button class="btn btn-light btn-sm"><i class="ti ti-brand-telegram"></i> Entry Pelanggaran</button>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>

    <?php } ?>
    <div class="modalview"></div>

    <script>
        function TambahPelanggaran(siswa_kelas_id) {
           $.ajax({
            type: "post",
            url: "<?=base_url('teacher/student/form-pelanggaran')?>",
            data: {siswa_kelas_id:siswa_kelas_id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.view)
                $('#modal-entry-pelanggaran').modal('show')
            }
           });

        }
    </script>



