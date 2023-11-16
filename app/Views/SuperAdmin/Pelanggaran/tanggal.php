<?php
if (empty($pelanggaran_tanggal)) {
  ?>
  <div class="alert alert-warning text-center">
    Tidak ada pelanggaran pada tanggal ini
  </div>
  <?php
}else{
    ?>
    <div class="table-responsive">
    <table class="table table-sm" style="font-size:12px">
        <thead>
<tr>
    <th class="text-center">No.</th>
    <th>Tgl. Kejadian</th>
    <th>Petugas</th>
    <th>Siswa</th>
    <th>Pelanggaran</th>
    <th class="text-center">Poin</th>
<th>Jenis</th>
<th>Keterangan</th>
<th>Tindak Lanjut</th>
</tr>
</thead>
<tbody>
    <?php
$i=1;
$total_poin =0;
foreach ($pelanggaran_tanggal as $d) {?>
<tr>
    <td class="text-center"><?=$i++?>.</td>
<td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
<td><?=$d['nm_guru']?></td>
<td><?=$d['nama_siswa']?></td>
<td>
    <?php
    $pelanggaran = $d['nama_pelanggaran'];
    echo substr($pelanggaran, 0, 10);
    ?></td>
<td class="text-center"><?=$d['poin']?></td>
<td><?=$d['jenis']?></td>
<td><?=$d['keterangan']?></td>
<td><?=$d['status_tindak_lanjut']?></td>
</tr>
<?php
$total_poin += $d['poin'];
} ?>

</tbody>
</table>
</div>

    <?php
}
?>
