<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item">
<a href="#" class="text-info">Student</a>
</li>
</ol>
</nav>

<form id="filter-rombel">
<div class="row">
          

    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select class="form-select" id="sekolah">
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
    <select class="form-select" id="periode">
    <option value="">Periode / TP</option>
    <?php
    if (ListOfPeriode()) {
    foreach (ListOfPeriode() as $p) {
    ?>
    <option value="<?=$p['id']?>" <?=$p['status_periode']==1 ?'selected':null ?> ><?=$p['nm_periode']?> <?=$p['status_periode']==1 ?'(Aktif)':null ?></option>
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
    <select class="form-select" id="kelas" disabled><option value="">Tingkat Kelas</option></select>
    </div>
    </div>

    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select class="form-select" name="rombel" id="rombel" disabled>
    <option value="">Rombel</option>
    </select>
    <!-- <button type="submit" class="btn btn-info"><i class="ti ti-search"></i> Tampilakn</span> -->
    </div>
    </div>

</div>
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="viwmodalsiswa"></div>
    <div id="siswa-rombel"></div>
    </div>
</div>

<script>

    $('#periode').change(function (e) { 
        e.preventDefault();
        if ($(this).val()=="") {
            $('#kelas').prop('disabled', true) 
            $('#rombel').prop('disabled', true)
            $('#kelas').html('<option value="">Tingkat Kelas</option>')
            $('#rombel').html('<option value="">Rombel</option>')
        }else{
            $('#kelas').prop('disabled', false) 
            $('#rombel').prop('disabled', false)
        }

        
    });
    



        // GET KELAS LEVEL
$('#sekolah').change(function (e) { 
    e.preventDefault();
   $.ajax({
    url: "<?=base_url('master/kelas-level')?>",
    data: {sekolah_id: $(this).val()},
    dataType: "json",
    success: function (response) {
       $('#kelas').prop('disabled', false)
       $('#kelas').html('<option value="">Tingkat Kelas</option>'+response.kelas_level)
    }
   });
    
});

// GET ROMBEL
$('#kelas').change(function (e) { 

    e.preventDefault();
   $.ajax({
    url: "<?=base_url('master/kelas-rombel')?>",
    data: {
        periode_id: $('#periode').val(),
        level_id: $(this).val(),
    },
    dataType: "json",
    success: function (response) {
       $('#rombel').prop('disabled', false)
       $('#rombel').html('<option value="">Pilih Rombel</option>'+response.kelas_rombel)
    }
   });
    
});





// CARI ROMBEL

// $('#filter-rombel').submit(function (e) { 
//     e.preventDefault();
//     $.ajax({
//         type: "post",
//         url: "<?=base_url('admin/student/rombel')?>",
//         data: $(this).serialize(),
//         dataType: "json",
//         success: function (response) {
//            $('#siswa-rombel').html(response.table_rombel_siswa) 
//         }
//     });
    
// });

$('#rombel').change(function (e) { 
    e.preventDefault();
    if ($(this).val() !="") {
        
        LoadSiswaRombel($(this).val()) 
    }
    
});


function LoadSiswaRombel(id) {
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
<!-- <script src="<?=base_url('ajax/rombel.js')?>"></script> -->

<?= $this->endSection() ?>