
<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>

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
    <h2><i class="ti ti-users text-white"></i></h2>
    </div>
    <div class="card-body p-3 text-center">
        <h3><strong><?=$jml_siswa_langgar?></strong></h3>
        <div>Jumlah Siswa Melanggar</div>
    </div>
    </div>

    <div class="text-center">
        <button class="btn btn-dark btn-sm"><i class="ti ti-printer"></i> Cetak</button>
    </div>
    </div>


<!-- Nav tabs -->
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-user-exclamation"></i> Pelanggaran</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="ti ti-users"></i> Siswa</button>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
<!-- Pencatatan Pelanggaran  -->
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
        <th>Jenis</th>
        <!-- <th class="text-center">Poin</th> -->
        <th>Status</th>
        <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        // var_dump($pelanggaran_kelas);
    //     echo "<pre>";
    //    print_r($pelanggaran_kelas);
    //     echo "<pre>";
      
        foreach ($pelanggaran_kelas as $d) {?>
        <tr>
        <td class="text-center"><?=$i++?>.</td>
        <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
        <td><?=$d['nm_guru']?></td>
        <td>
            <div><b><?=$d['nama_siswa']?></b></div>
            <a href="#" class="badge rounded-pill text-bg-primary" onclick="LihatDetailPelanggaran(<?=$d['siswa_kelas_id']?>)"><i class="ti ti-folders"></i> Riwayat Pelanggaran</a>
            <a href="#" class="badge rounded-pill text-bg-success" onclick="LihatInfo(<?=$d['id']?>)"><i class="ti ti-info-circle"></i> Info Detail</a>
        </td>
        <td><?=$d['jenis']?> (<?=$d['poin']?>)</td>
        <!-- <td class="text-center"></td> -->
        <td><?=$d['status_tindak_lanjut']?>
    
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

</div>
<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
<div class="mt-3">
    <b><i class="ti ti-list"></i> SISWA KELAS <?=$rombel->rombel?></b>
    </div>
<div class="table-responsive mt-4 mb-5">
<table class="table table-sm" style="font-size:12px">
    <thead>
        <tr>
            <th>No.</th>
            <th>NISN</th>
            <th>NAMA</th>
            <th>JK</th>
            <th>
                <i class="ti ti-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        if ($siswa) {
            // var_dump($siswa);
            foreach ($siswa as $s) {
                ?>
                <tr>
                    <td><?=$i++?>.</td>
                    <td><?=$s['nisn']?></td>
                    <td><?=$s['nama_siswa']?></td>
                    <td><?=$s['jk']?></td>
                    <td>
                        <a href="#" onclick="LihatDetailPelanggaran(<?=$s['id']?>)" class="btn btn-dark btn-sm"><i class="ti ti-search"></i> Lihat Pelanggaran </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td class='text-center text-bold text-danger' colspan='7'>Belum ada siswa pada rombel ini</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>


</div>
</div>


<div class="viewinfo"></div>
<script>
    function LihatInfo(id) {
        $.ajax({
            url: "<?=base_url('teacher/student/pelanggaran/info')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewinfo').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });   
    }
    function LihatDetailPelanggaran(id) {
        $.ajax({
            url: "<?=base_url('teacher/student/pelanggaran/detail')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewinfo').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });   
    }
</script> 
  
<?= $this->endSection() ?>