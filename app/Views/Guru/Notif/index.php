<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title fw-semibold m-0">Notifikasi</h5>
    </div>
<div class="card-body">

<table class="table-hover w-100">
    <thead>
        <tr>
            <th>No.</th>
            <th>Pelanggaran</th>
            <th>Siswa</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    <?php
// var_dump($list);
if ($list) {
  
  $no =1;
foreach ($list as $d) {
  ?>
<tr>
    <td><?=$no++?>.</td>
    <td>
        <b><?=$d['nama_pelanggaran']?></b>
        <div style="font-size:12px">
           Oleh : <?=$d['nm_guru']?> | <?=$d['jenis']?> | <?=$d['poin']?>
        </div>
    </td>
    <td><a href="#"><?=$d['nama_siswa']?></a></td>
    <td>
        <?=$d['keterangan']?>
          <div style="font-size:12px">
           Kejadian :  <?=date('d M Y',strtotime($d['tgl_kejadian']))?>
        </div>
       
        </td>
</tr>
  <?php
}

}else{echo "Tidak ada informasi.";}
?>
        
    </tbody>
</table>


</div>
</div>
<?= $this->endSection() ?>