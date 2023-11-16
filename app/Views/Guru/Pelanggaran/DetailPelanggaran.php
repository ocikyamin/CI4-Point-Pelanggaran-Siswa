<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<div class="card p-0 shadow-sm">
<div class="card-body">
<h5 class="card-title fw-semibold mb-4"><i class="ti ti-user"></i> Informasi Siswa</h5>
<div class="row">
    <div class="col-lg-6">
    <table class="table table-hover table-sm" style="text-transform: uppercase;font-size:12px">
        <tr>
        <td>TP</td>
        <td>:</td>
        <td><?=$kelas->nm_periode?></td>
        </tr>
       
        <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?=$kelas->level_kelas?> (<?=$kelas->rombel?>)</td>
        </tr>
        <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td><?=$kelas->nm_sekolah?> (<?=$kelas->kepsek?>) </td>
        </tr>
        </table>
    </div>

    <div class="col-lg-6">
    <table class="table table-hover table-sm" style="text-transform: uppercase;font-size:12px">
        <tr>
        <td>NISN</td>
        <td>:</td>
        <td><?=$kelas->nisn?></td>
        </tr>
       
        <tr>
        <td>Nama Siswa</td>
        <td>:</td>
        <td><?=$kelas->nama_siswa?></td>
        </tr>
        <tr>
        <td>Wali Kelas</td>
        <td>:</td>
        <td><?=$kelas->nm_guru?></td>
        </tr>
        </table>
    </div>

</div>


</div>
</div>
<div class="row">
<div class="col-lg-12">
<h5 class="card-title fw-semibold mb-4 mt-3"><i class="ti ti-list-search"></i> Riwayat Pelanggaran</h5>
<div class="table-responsive">
<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Petugas</th>
            <th>Tgl. Kejadian</th>
            <th>Pelanggaran</th>
            <th>Poin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        $total_poin =0;
        foreach ($pelanggaran as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=$d['nm_guru']?></td>
            <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
            <td><?=$d['nama_pelanggaran']?></td>
            <td class="text-center"><?=$d['poin']?></td>
        </tr>
        <?php
         $total_poin += $d['poin'];
     } ?>
     <tr class="bg-dark text-white" style="font-weight:bold;">
        <td colspan="4" class="text-center">Total Poin Pelanggaran  </td>
        <td class="text-center"><?=$total_poin?></td>
     </tr>

    </tbody>
</table>
</div>

</div>
</div>
<?= $this->endSection() ?>