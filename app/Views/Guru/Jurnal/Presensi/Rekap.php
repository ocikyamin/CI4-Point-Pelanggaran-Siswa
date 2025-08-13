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
    <a href="<?=base_url('report/presensi/kelas/'.$jadwal_id)?>" target="_blank" class="btn btn-dark shadow"><i class="ti ti-printer"></i> Cetak Daftar Hadir</a>
    </div>
</div>
</div>
<!-- Daftar Hadir  -->
 <?php
$jml = count($pertemuan);
// var_dump($jml);
 ?>
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
foreach ($pertemuan as $p) {?>
<td class="text-center bg-light">
<a href="#" onclick="KehadiranSiswa(<?=$p['id']?>)">
<?=$p['pertemuan']?>
<div><small><?=date('d/m/y', strtotime($p['tgl_pertemuan']))?></small></div>
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
use App\Models\Jurnal\KehadiranModel;
$hadirM = New KehadiranModel();
$no = 1;
foreach ($siswa as $d) {
$hadir = hitungKehadiran($jadwal_id, $d['id'], "H");
$sakit = hitungKehadiran($jadwal_id, $d['id'], "S");
$izin = hitungKehadiran($jadwal_id, $d['id'], "I");
$telat = hitungKehadiran($jadwal_id, $d['id'], "T");
$absen = hitungKehadiran($jadwal_id, $d['id'], "A");
$cabut = hitungKehadiran($jadwal_id, $d['id'], "C");


?>
<input type="hidden" name="siswa[]" value="<?=$d['id']?>">
<tr>
<td class="text-center"><?=$no++?></td>
<td><?=$d['nama_siswa']?></td>
<?php
foreach ($pertemuan as $p) {
    if ($pertemuan) {
    $stt = $hadirM->select('kehadiran')
    ->where('kelas_jurnal_id', $p['id'])
    ->where('m_siswa_kelas_id', $d['id'])
    ->first();




    }else{
    $stt = null;
    }
    if ($stt) {
    $ket = $stt['kehadiran'];
    }else{
    $ket = null;
    }
    
    ?>
<td class="text-center"><b><?=$ket?></td>
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
