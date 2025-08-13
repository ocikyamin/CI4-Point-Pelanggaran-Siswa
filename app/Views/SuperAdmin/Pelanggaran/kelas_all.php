<div class="mt-3">
        <b><i class="ti ti-list"></i> SISWA YANG MELAKUKAN PELANGGARAN</b>
    </div>

<?php
if (empty($pelanggaran_kelas)) {
  ?>
  <div class="alert alert-warning text-center mt-3">
    Tidak ada pelanggaran untuk kelas ini
  </div>
  <?php
}else{
    ?>
<div class="row">
    <div class="col-lg-12">
    <div class="table-responsive mt-4 mb-5">
    <table class="table table-sm" style="font-size:12px">
        <thead>
        <tr>
        <th class="text-center">No.</th>
        <th>Tgl. Kejadian</th>
        <th>Petugas</th>
        <th>Siswa</th>
        <th class="text-center">Poin</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        
        $i=1;
      
        foreach ($pelanggaran_kelas as $d) {?>
        <tr>
        <td class="text-center"><?=$i++?>.</td>
        <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
        <td><?=$d['nm_guru']?></td>
        <td><a href="#" onclick="LihatInfo(<?=$d['id']?>)"><b><?=$d['nama_siswa']?></b></a></td>
        <td class="text-center"><?=$d['poin']?></td>
        <td><?=$d['jenis']?></td>
        <td><?=$d['status_tindak_lanjut']?>
        <?php
        // if ($d['teruskan_ke'] !=NULL) {
           
        //     echo Penerusan($d['teruskan_ke'])->jabatan;
        // }
        ?>
      
    
    </td>
        <td>
        <?php
        if ($d['keterangan'] !=NULL) {
        ?>
        <li><?=$d['keterangan']?></li>
        <?php
        }

        ?>
        <?php
        if ($d['keterangan_final'] !=NULL) {
        ?>
        <li><?=$d['keterangan_final']?></li>
        <?php
        }
        ?>
        </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
        </div>
    </div>
</div>

    <?php
}
?>
<div class="viewinfofromkelassiswa"></div>
<script>
    function LihatInfo(id) {
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/info')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewinfofromkelassiswa').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });
        
    }
</script>