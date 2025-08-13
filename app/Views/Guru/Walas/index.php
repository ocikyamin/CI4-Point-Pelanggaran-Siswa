<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>

<h5 class="card-title fw-semibold mb-4">Riwayat Wali Kelas</h5>
<!-- <p class="mb-0">This is a sample page </p> -->
<div class="row">
<?php
// var_dump($walas);
if ($walas) {
    foreach ($walas as $d) {
        ?>
        <div class="col-lg-3">
        <div class="card mb-2">
            <div class="card-body p-3">
      <h5 class="card-title text-primary"><i class="ti ti-school"></i> Kelas <?=$d['rombel']?></h5>
      <i class="ti ti-calendar"></i> <?=$d['nm_periode']?>
  <div class="d-grid gap-2">
  <a href="<?=base_url('teacher/walas/kelas/'.$d['id'])?>" class="btn btn-primary btn-sm mt-2"><i class="ti ti-send"></i> Lihat Kelas</a>
  </div>
    <!-- <div class="d-grid gap-2"></div> -->
    


  </div>
</div>
        </div>
        <?php
    }
}else{
    ?>
<div class="col-lg-12">
<div class="alert bg-danger text-white shadow-sm py-1 mt-3">
<b><i class="ti ti-info-circle"></i> Info !</b>
Tidak ada riwayat menjadi wali kelas
</div>
</div>
    <?php
 
}
?>
</div>

<?= $this->endSection() ?>