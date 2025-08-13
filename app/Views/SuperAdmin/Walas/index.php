<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item active text-info font-medium" aria-current="page">
Walas
</li>
</ol>
</nav>

    <div class="row">
    <div class="col-lg-6">
    <div class="input-group input-group-sm mb-3">

    <span class="input-group-text" id="basic-addon1"><i class="ti ti-filter"></i></span>
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
    <select name="periode" class="form-select" id="periode">
    <option value="">Tahun Pelajaran</option>
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
    <button type="button" class="btn btn-dark" id="btn-cari"><i class="ti ti-search"></i> Tampilkan</button>
    </div>
    </div>


</div>

<div class="row" id="view-walas"></div>

<script>
    $(document).ready(function () {
        $('#btn-cari').click(function (e) { 
        var Sekolah = $('#sekolah').val();
        var Periode = $('#periode').val();
        e.preventDefault();
        // alert('okk')
        if (Sekolah =="" || Periode=="") {
            Toastify({
            text: "Sekolah / Periode Belum Dipilih",
            className: "warning"
            }).showToast();
        }else{
            WalasPeriode(Periode,Sekolah) 
        }
    });
    });
    // $('#cari-walas').submit(function (e) { 
    //     e.preventDefault();

    //     $.ajax({
    //         type: "post",
    //         url: "<?=base_url('admin/walas/periode')?>",
    //         data: $(this).serialize(),
    //         dataType: "json",
    //         success: function (response) {
    //             $('#view-walas').html(response.walas)
    //         }
    //     });
    // });

    // $('#periode').change(function (e) { 
    //     var Sekolah = $('#sekolah').val();
    //     e.preventDefault();
    //     // alert('okk')
    //     if ($(this).val() !="" && Sekolah!="") {
    //         WalasPeriode($(this).val(),Sekolah) 
    //     }else{
    //         alert('pilih sekolah / periode')
    //     }
    // });

    function WalasPeriode(id,sekolah) {
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/walas/periode')?>",
            data: {
                periode : id,
                sekolah : sekolah,
            },
            dataType: "json",
            success: function (response) {
                $('#view-walas').html(response.walas)
            }
        });
      }
</script>
<?= $this->endSection() ?>