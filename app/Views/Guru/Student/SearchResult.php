
<?php
if (empty($result)) {
   echo "<div class='alert bg-danger text-white text-center py-1'><b><i class='ti ti-info-circle text-white mr-3'></i> Oppss ! </b> Data siswa Tidak ditemukan.</div>";
}else{
    ?>
    <div class="table-responsive mt-5">           
<table id="tabel-siswa" class="table table-sm table-striped table-bordered table-hover mt-3">
    <thead>
    <tr>
        <th>No.</th>
        <th>NISN</th>
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
    <tr onclick="TambahPelanggaran(<?=$s['siswa_rombel_id']?>)" style="cursor:pointer">
    <td><?=$i++?>.</td>
        <td><?=$s['nisn']?></td>
        <td><?=$s['nama_siswa']?></td>
        <td><?=$s['rombel']?></td>
        <td><?=$s['nm_guru']?></td>
        <td class="text-center">
            <button class="btn btn-dark btn-sm"><i class="ti ti-brand-telegram"></i> Entry Pelanggaran</button>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>

    <?php } ?>
    <div class="modalview"></div>

    <script>
        $(document).ready(function () {
            $('#tabel-siswa').DataTable();
        });
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



