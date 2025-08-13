<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<?php

?>
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
<div class="col-lg-12">
<div class="card shadow-sm">
    <div class="card-header p-2 bg-success text-white">
        <b><i class="ti ti-filter"></i>Filter Pelanggaran</b>
    </div>
    <!-- <div class="card-header bg-success text-white p-1">
<h2 class="mb-0"><i class="ti ti-filter"></i>Filter Pelanggaran</h2>
</div> -->
    <div class="card-body"> 

    
<form id="filter-kelas">
<div class="row">
          

    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select class="form-select" name="sekolah" id="sekolah">
    <option value="">Sekolah / Madrasah</option>
    <?php
    if (ListOfSekolah()) {
    foreach (ListOfSekolah() as $p) {
    ?>
    <option value="<?=$p['id']?>"><?=$p['nm_sekolah']?></option>
    <?php
    }
    }
    ?>
    </select>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-calendar"></i></span>
    <select class="form-select" name="periode" id="periode">
    <option value="">Periode / TP</option>
    <?php
    if (ListOfPeriode()) {
    foreach (ListOfPeriode() as $p) {
    ?>
    <option value="<?=$p['id']?>"><?=$p['nm_periode']?> <?=$p['status_periode']==1 ?'(Aktif)':null ?></option>
    <?php
    }
    }
    ?>
    </select>
    </div>
    </div>


    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select name="rombel" id="rombel" class="form-control form-control-sm">
            <option value="">Kelas / Rombel</option>
            </select>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select name="semester" id="semester" class="form-control form-control-sm">
            <option value="">Semester</option>
            <?php
            foreach (ListOfSemester() as $p):?>
            <option value="<?=$p['id']?>"><?=$p['semester']?> <?=$p['status']==1 ? '(Aktif)':null ?></option>
            <?php endforeach; ?>
            </select>
            <button class="btn btn-dark" id="btn-tampilkan"><i class="ti ti-search"></i> Tampilkan</button>
    </div>
    </div>

</div>
</form>
    </div>
</div>
</div>


    

</div> <!-- row-->

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><h5>Pelanggaran</h5></button>
        </li>
        <!-- <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Jenis Pelanggaran</button>
        </li> -->
   
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <!-- <p class="mt-3">
                Riwayat Pelanggaran
            </p> -->
            <div id="result_table"></div>
        </div>

        <!-- <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="alert bg-primary text-white mt-3 py-2">
            <b><i class="ti ti-settings"></i></b> Jenis Pelanggaran
            </div>
            <div id="section-master-pelanggaran"></div>

        </div> -->
     
        </div>
    </div>
</div>


<!-- <div class="row">
<div class="col-lg-12">
<div id="result_table"></div>
</div>
</div> -->
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


      // kelas by sekolah & periode
      $('#periode').change(function (e) { 
        e.preventDefault();
        $.ajax({
            url: "<?=base_url('master/kelas-rombel-periode')?>",
            data: {
                sekolah_id : $('#sekolah').val(),
                periode_id : $(this).val()
            },
            dataType: "json",
            success: function (response) {
                $('#rombel').html('<option value="">Kelas / Rombel</option>' + response.kelas_rombel)
            }
        });
        
      });

      $('#filter-kelas').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/kelas')?>",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend : function () {
            $('#btn-tampilkan').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status">Loading...</span>`)
            $('#btn-tampilkan').prop('disabled', true)
            },
            complete : function () { 
                $('#btn-tampilkan').html(`<i class="ti ti-search"></i> Tampilkan`)
                $('#btn-tampilkan').prop('disabled', false)
             },
            success: function (response) {
            $('#result_table').html(response.pelanggaran_by_rombel)
            }
        });
        
      });



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

<script>
    function MasterPelanggaran() {
        $.ajax({
            type: "POST",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function (response) {
                $('#section-master-pelanggaran').html(response.view)
            }
        });
        
    }
</script>

<?= $this->endSection() ?>