<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-10">
        <div class="alert alert-light p-0">
        <table class="table-sm w-100" style="text-transform: uppercase;font-size:12px">
            <tr class="shadow-sm">
            <td>Bidang Studi</td>
            <td>:</td>
            <td><?=$kelas->mapel?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Kelas</td>
            <td>:</td>
            <td><?=$kelas->level_kelas?> - <?=$kelas->rombel?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Guru Pengampu</td>
            <td>:</td>
            <td><?=$kelas->nm_guru?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Tahun Pelajaran / Semester</td>
            <td>:</td>
            <td><?=$kelas->nm_periode?> / <?=$kelas->semester?></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="col-lg-2">
        <!-- <a href="" class="btn btn-success"><i class="ti ti-printer"></i> Cetak Presensi</a> -->
        <table style="font-size:11px">
            <tr>
                <td>H </td>
                <td> = </td>
                <td> Hadir</td>
            </tr>
            <tr>
                <td>S </td>
                <td> = </td>
                <td> Sakit</td>
            </tr>
            <tr>
                <td>I </td>
                <td> = </td>
                <td> Izin</td>
            </tr>
            <tr>
                <td>T </td>
                <td> = </td>
                <td> Terlambat</td>
            </tr>
            <tr>
                <td>A </td>
                <td> = </td>
                <td> Absen</td>
            </tr>
            <tr>
                <td>C </td>
                <td> = </td>
                <td> Cabut</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <!-- tabs  -->
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link bg-light shadow-sm mr-3 active" id="tab-rekap" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="ti ti-checklist"></i> Rekap Kehadiran</button>
        <button class="nav-link bg-light shadow-sm" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="ti ti-file-analytics"></i> Daftar Kehadiran</button>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="tab-rekap" tabindex="0">
            <div id="table_rekap"></div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div id="table_daftar_hadir"></div>
        </div>
    <!-- tabs  -->

</div>
</div>
<script>
$(document).ready(function () {
    TableRekap(<?=$kelas_mengajar_id?>)
    TableDaftarHadir(<?=$kelas_mengajar_id?>)
});

function TableRekap(id) {
    $.ajax({
        url: "<?=base_url('teacher/presensi/rekap')?>",
        data: {kelas_mengajar_id:id},
        dataType: "json",
            beforeSend: function() {
            $('#table_rekap').html(`<div class="text-center mt-3"> <div class="spinner-border spinner-border-lg text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
            </div> </div>`);
            },
        success: function (response) {
            $('#table_rekap').html(response.rekap)
        }
    });
}
function TableDaftarHadir(id) {
    $.ajax({
        url: "<?=base_url('teacher/presensi/presensi')?>",
        data: {kelas_mengajar_id:id},
        dataType: "json",
        success: function (response) {
            $('#table_daftar_hadir').html(response.presensi)
        }
    });
}

$('#tab-rekap').click(function (e) { 
    e.preventDefault();
    TableRekap(<?=$kelas_mengajar_id?>)
    
});
</script>

<?= $this->endSection() ?>