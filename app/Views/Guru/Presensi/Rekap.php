<style>
    .text-bold{
        font-weight:bold;
    }

</style>

<div class="row mt-2">
<div class="col-lg-10">
<div class="alert alert-info d-flex align-items-center alert-dismissible fade show" role="alert">
<i class="ti ti-info-circle me-3"></i>
  <div>
  <strong>Info!</strong> Klik Tanggal Pertemuan untuk mengubah Kehadiran siswa
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div class="col-lg-2">
    <div class="d-grid">
    <a href="<?=base_url('report/presensi/kelas/'.$kelas_mengajar_id)?>" target="_blank" class="btn btn-dark shadow"><i class="ti ti-printer"></i> Cetak Daftar Hadir</a>
    </div>
</div>
</div>
<!-- Daftar Hadir  -->
<div class="table-responsive">
<table class="table-sm w-100 table-bordered mb-3" style="font-size:11px">
<thead>
<tr>
<th rowspan="2" width="1" class="text-center">NO</th>
<th rowspan="2">NAMA LENGKAP SISWA</th>
<th colspan="<?=$jml?>" class="text-center">Pertemuan Ke- dan Tanggal Pertemuan</th>
<th rowspan="1" colspan="6" class="text-center">JUMLAH</th>
</tr>
<tr>
<?php
foreach ($tanggal_pertemuan as $t) {?>
<td class="text-center bg-light">
<a href="#" onclick="UpdatePresensi(<?=$kelas_mengajar_id?>,<?=$t['pertemuan_ke']?>)"><?=$t['pertemuan_ke']?>
<div><small><?=date('d/m/y', strtotime($t['tanggal']))?></small></div>
</a>
</td>
<?php } ?>
<td class="text-center">H</td>
<td class="text-center">S</td>
<td class="text-center">I</td>
<td class="text-center">T</td>
<td class="text-center">A</td>
<td class="text-center">C</td>
</tr>

</thead>
<tbody>
<?php
$no = 1;
foreach ($siswa as $d) {
    $hadir = hitungKehadiran($kelas->id, $d['id'], "H");
    $sakit = hitungKehadiran($kelas->id, $d['id'], "S");
    $izin = hitungKehadiran($kelas->id, $d['id'], "I");
    $telat = hitungKehadiran($kelas->id, $d['id'], "T");
    $absen = hitungKehadiran($kelas->id, $d['id'], "A");
    $cabut = hitungKehadiran($kelas->id, $d['id'], "C");
?>
<input type="hidden" name="siswa[]" value="<?=$d['id']?>">
<tr>
<td class="text-center"><?=$no++?></td>
<td><?=$d['nama_siswa']?></td>
<?php
foreach ($tanggal_pertemuan as $t) {
$kehadiran = Kehadiran($t['tanggal'],$kelas->id,$d['id'],$t['pertemuan_ke'])==NULL ? NULL : Kehadiran($t['tanggal'],$kelas->id,$d['id'],$t['pertemuan_ke']);

?>
<td class="text-center"><b>
    <?php
    if ($kehadiran==NULL) {
       echo "0";
    }else{
        echo $kehadiran->kehadiran;
    }

// var_dump($kehadiran);
?></b></td>
<?php } ?>
<td class="text-center"><?=$hadir?></td>
<td class="text-center"><?=$sakit?></td>
<td class="text-center"><?=$izin?></td>
<td class="text-center"><?=$telat?></td>
<td class="text-center"><?=$absen?></td>
<td class="text-center"><?=$cabut?></td>

</tr>
<?php } ?>
</tbody>
</table>
</div>
<!-- end daftar hadir  -->
<script>
    function UpdatePresensi(kelas_mengajar_id,pertemuan_ke) {
       $.ajax({
        url: "<?=base_url('teacher/presensi/edit')?>",
        data: {
            kelas_mengajar_id:kelas_mengajar_id,
            pertemuan_ke:pertemuan_ke

        },
        dataType: "json",
        beforeSend: function() {
            $('#table_rekap').html(`<div class="text-center mt-3"> <div class="spinner-border spinner-border-lg text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
            </div> </div>`);
            },
        success: function (response) {
            $('#table_rekap').html(response.edit)
        }
       });
    }
</script>