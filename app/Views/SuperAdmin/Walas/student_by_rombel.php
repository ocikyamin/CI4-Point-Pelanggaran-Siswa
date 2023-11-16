<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item active text-info font-medium" aria-current="page">
Walas : (<?=$kelas->rombel?>)
</li>
</ol>
</nav>

<div class="row">
    <div class="col-lg-9">
        <div class="alert alert-light">
        <table class="table table-hover table-sm" style="text-transform: uppercase;font-size:12px">
        <tr>
        <td>TP</td>
        <td>:</td>
        <td><?=$kelas->nm_periode?></td>
        </tr>
        <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td><?=$kelas->nm_sekolah?> (<?=$kelas->kepsek?>) </td>
        </tr>
       
        <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?=$kelas->level_kelas?> (<?=$kelas->rombel?>)</td>
        </tr>
    
        <tr>
        <td>Wali Kelas</td>
        <td>:</td>
        <td><?=$kelas->nm_guru?></td>
        </tr>
        </table>
        </div>
    </div>
    <div class="col-lg-3">
    <div class="card border border-danger text-center shadow-sm">
            <div class="card-header bg-danger text-white">
            <h1><i class="ti ti-users text-white"></i></h1>
            Jumlah siswa melanggar
            <div>
               
                <b><?php
                if (!empty($siswa_melanggar)) {
                    echo $siswa_melanggar;
                }else{
                    echo "Tidak ada siswa yg melanggar";
                }
                ?></b>
            </div>
            </div>
            <div class="card-body p-2">
                <div class="d-grid gap-2">
                <a class="btn btn-dark" href="<?=base_url('report/pelanggaran/kelas/'.$kelas->rombel_id.'')?>" target="_blank"> <i class="ti ti-printer"></i> Print </a>
                </div>         
            </div>
        </div>

    </div>
</div>

<div class="table-responsive">
<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>NISN</th>
            <th>NAMA</th>
            <th>JK</th>
            <th>Poin</th>
            <th>
                <i class="ti ti-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($siswa as $s):?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=$s['nisn']?></td>
            <td><?=$s['nama_siswa']?></td>
            <td><?=$s['jk']?></td>
            <th>10</th>
            <td>
                <a href="<?=base_url('report/pelanggaran/siswa/'.$s['siswa_rombel_id'].'')?>" target="_blank" class="btn btn-light btn-sm"><i class="ti ti-printer"></i> Print </a>
              
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>


<?= $this->endSection() ?>