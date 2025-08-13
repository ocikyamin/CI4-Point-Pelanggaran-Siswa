<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-6">
    <div class="input-group input-group-sm mb-3">
  <!-- <span class="input-group-text" id="basic-addon1">@</span> -->
  <button onclick="BuatJadwal()" class="input-group-text"><i class="ti ti-plus"></i> Buat</button>
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
  <select class="form-select" name="semester" id="semester">
    <option value="">Semester</option>
    <?php
    if (ListOfSemester()) {
    foreach (ListOfSemester() as $p) {
    ?>
    <option value="<?=$p['id']?>"><?=$p['semester']?> <?=$p['status']==1 ?'(Aktif)':null ?></option>
    <?php
    }
    }
    ?>
    </select>
</div>
    </div>
</div>

<!-- <div class="card shadow-sm">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">History Mencatat Pelanggaran</h5>
</div>
</div> -->
<div id="list-kelas"></div>
<div class="viewmodal"></div>
<script>
    $(document).ready(function () {
        TableKelas()
    });
    function TableKelas() {
        $.ajax({
            url: "<?=base_url('teacher/jurnal/jadwal/list')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#list-kelas').html(response.table_kelas)
            }
        });
    }
    function BuatJadwal(){
        var Periode = $('#periode').val()
        var Semester = $('#semester').val()
        if (Periode=="" || Semester=="") {
            Toastify({
            text: "Anda Belum memilih Periode / Semester",
            className: "info",
            style: {
            background: "red",
            }
            }).showToast();
        }else{
            $.ajax({
            url: "<?=base_url('teacher/jurnal/jadwal/add')?>",
            data: {
                periode_id:Periode,
                semester_id:Semester,
            },
            dataType: "json",
            success: function (response) {
                $('.viewmodal').html(response.form_kelas)
                $('#modal-kelas').modal('show')
            }
        });
        }

        
    }
</script>
<?= $this->endSection() ?>