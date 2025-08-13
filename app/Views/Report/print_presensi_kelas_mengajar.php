<!DOCTYPE html>
<html>
<head>
  <title>Rekap Daftar Hadir Siswa</title>
<style>
     @page {
      size: legal landscape;
    }
body {
font-family: Arial, sans-serif;
}

/* Menghilangkan border untuk header saat mencetak */
@media print {
.table table thead { display: table-header-group; }
}

.bold{
font-weight:bold;
}
.text-center {
text-align: center!important;
}
.bb{
    border-bottom:2px solid;
}
</style>
</head>
<body>

<table width="100%">
<tr>
<td class="text-center">
<img src="<?=base_url('favicon_io/mtic.webp')?>" alt="Logo" width="80">
<div> MTI CANDUANG</div>
</td>
<td>
<h1>DAFTAR HADIR SISWA</h1>
<b style="font-family:Bodoni MT Black;font-size:25px;font-weight: bold;clear: both;">PONDOK PESANTREN</b>
<br>
<span style="font-family:Book Antiqua;font-size:22px;">MADRASAH TARBIYAH ISLAMIYAH CANDUANG</span>
<br>
<p style="font-size:8px;line-height: 10px;padding:0px;margin:0px">
<em>Alamat : Jln. Syekh Sulaiman Arrasuli, Pakan Kamis, Lubuak Aua, Kenagarian Canduang Koto Laweh, Kecamatan Canduang, Kabupaten Agam, Sumatera Barat, 26192, <br>
Telp (0752) 28115, Fax. (0752) 426758, email: <a href="#">mticanduang@gmail.com</a> website : www.mticanduang.sch.id</em>
</p>
</td>
<td>
    <table width="100%" style="font-size:12px;border-collapse:collapse">
<!-- <div style="border:1px solid"> -->
    <tr class="bb">
    <td>Kelas</td>
    <td>:</td>
    <td><?=$kelas->rombel?></td>
    <td>Jurusan</td>
    <td>:</td>
    <td>-</td>
    </tr>
    <tr class="bb">
 
    <td>Tahun Pelajaran</td>
    <td>:</td>
    <td><?=$kelas->nm_periode?></td>
    <td>Semester</td>
    <td>:</td>
    <td><?=$kelas->semester?></td>
    </tr>

    <tr class="bb">
<td>Guru</td>
<td>:</td>
<td colspan="3"><?=$jadwal->nm_guru?></td>
</tr>
<tr class="bb">
<td>Bidang Studi</td>
<td>:</td>
<td colspan="3"><?=$jadwal->mapel?></td>
</tr>
<tr class="bb">
<td>Wali Kelas</td>
<td>:</td>
<td colspan="3"><?=$kelas->walas?></td>
</tr>

</table> 


</td>
<td>
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
</td>
</tr>

</table> 
<hr>
        <div class="table">
            <!-- Daftar Hadir  -->
            <?php
$jml = count($pertemuan);
// var_dump($jml);
?>

<table border="1" style="font-size:9px;width: 100%;border-collapse: collapse;">
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
<b>
<?=$p['pertemuan']?>
<div><small><?=date('d/m/Y', strtotime($p['tgl_pertemuan']))?></small></div>
</b>
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

</body>
<script>
    window.print()
</script>
</html>
