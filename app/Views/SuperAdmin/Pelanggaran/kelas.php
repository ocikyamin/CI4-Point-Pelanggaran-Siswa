<div class="row mt-3">
    <div class="col-lg-8">

    <div class="card shadow-sm mb-3">
    <div class="card-header bg-primary ">
    <h6 class="mb-0 text-white"> <b><i class="ti ti-school"></i> INFORMASI KELAS</b></h6>
    </div>
    <div class="card-body p-2">
    <table class="table-sm table-striped" style="text-transform: uppercase;font-size:12px">
        <tr>
        <td>TP</td>
        <td>:</td>
        <td><?=$rombel->nm_periode?></td>
        </tr>
        <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td><?=$rombel->nm_sekolah?> (<?=$rombel->kepsek?>) </td>
        </tr>
       
        <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?=$rombel->level_kelas?> (<?=$rombel->rombel?>)</td>
        </tr>
    
        <tr>
        <td>Walas</td>
        <td>:</td>
        <td><?=$rombel->walas?></td>
        </tr>
        </table>
    </div>
    </div>

     
    </div>
    <div class="col-lg-4">
    <div class="card shadow-sm mb-3">
    <div class="card-header bg-primary text-white text-center">
    <h2 class="mb-0"><i class="ti ti-users text-white"></i></h2>
    </div>
    <div class="card-body p-2 text-center">
   Jumlah Siswa Melanggar
    <div><strong><?=$jml_siswa_langgar?></strong> Siswa</div>

    </div>
    </div>

    <div class="text-center">
        <button class="btn btn-dark btn-sm"><i class="ti ti-printer"></i> Cetak</button>
        <button onclick="LihatDetailKelas(<?=$rombel->id?>)" class="btn btn-dark btn-sm"><i class="ti ti-search"></i> Detail Kelas</button>
    </div>
    </div>


    <div>
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
        if ($d['teruskan_ke'] !=NULL) {
            echo $d['teruskan_ke'];
        }
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

<div class="viewinfo"></div>
<script>
    function LihatInfo(id) {
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/info')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewinfo').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });
        
    }

    function LihatDetailKelas(id) {
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/student/rombel')?>",
        data: {rombel: id},
        dataType: "json",
        success: function (response) {
           $('#siswa-rombel').html(response.table_rombel_siswa) 
        }
    });
    
}
</script>
