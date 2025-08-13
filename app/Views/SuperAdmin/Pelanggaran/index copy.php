<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item active text-info font-medium" aria-current="page">
Pelanggaran
</li>
</ol>
</nav>

<div class="row">
<div class="col-lg-6">
<div class="card shadow-sm">
    <div class="card-header p-2 bg-primary text-white"><i class="ti ti-filter"></i>Filter Pelanggaran</div>
    <div class="card-body p-2">   
            <div class="row">
                <div class="col-lg-6">
                <label>Filter Tanggal</label>
                <div class="form-group">
                    <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-lg-6">
                <label>Filter Kelas</label>
                <select name="rombel_id" id="rombel_id" class="form-control form-control-sm">
                    <option value="">Pilih Kelas</option>
                    <?php
                    foreach ($level as $l):?>
                    <option value=""><?=strtoupper($l['level_kelas'])?></option>
                    <?php
                    if (!empty(RombelByLevel($l['id']))) {
                    foreach (RombelByLevel($l['id']) as $r) {
                    ?>
                    <option value="<?=$r['id']?>"><?=$r['rombel']?></option>
                    <?php
                    }
                    }
                    ?>
                    <?php endforeach ;?>
                    </select>
            </div>
            </div>
    </div>
</div>
</div>

<?php
foreach (ListOfSekolah() as $s):?>
<div class="col-lg-3">
<div class="card shadow-sm">
<div class="card-header bg-warning text-white p-1 text-center">
<h2 class="mb-0"><i class="ti ti-users text-white"></i></h2>
</div>
<div class="card-body p-2 text-center">
<?=$s['nm_sekolah']?>
<div><strong>10</strong> Siswa Melanggar</div>

</div>
</div>
</div>
    <?php endforeach; ?>
    
    

</div> <!-- row-->

<div class="row">
<div class="col-lg-12">
<div id="result_table"></div>
</div>
</div>
<script>
    $(document).ready(function () {
        LastOfPelanggaran();
    });
    function LastOfPelanggaran() {
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/news')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#result_table').html(response.new_pelanggaran)
            }
        });
      }

$('#rombel_id').change(function (e) { 
    e.preventDefault();
    if ($(this).val()=="") {
        LastOfPelanggaran();
    }else{
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/kelas')?>",
            data: {rombel_walas_id:$(this).val()},
            dataType: "json",
            success: function (response) {
                $('#result_table').html(response.new_pelanggaran)
            }
        });

    }
    
});
$('#tanggal').change(function (e) { 
    e.preventDefault();
    if ($(this).val()=="") {
        LastOfPelanggaran();
    }else{
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/tanggal')?>",
            data: {tanggal:$(this).val()},
            dataType: "json",
            success: function (response) {
                $('#result_table').html(response.pelanggaran_by_tanggal)
            }
        });

    }
    
});

</script>

<?= $this->endSection() ?>