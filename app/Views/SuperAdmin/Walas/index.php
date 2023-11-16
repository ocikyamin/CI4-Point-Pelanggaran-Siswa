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
    <!-- col-lg-3  -->
    <?php
    foreach ($level as $l):?>
    <div class="col-lg-3">
        <div class="card shadow-sm">
            <div class="card-header p-1 <?=$l['sekolah_id']==1 ? 'bg-info':'bg-success'?> text-white">
           <i class="ti ti-school text-white"></i> <?=strtoupper($l['level_kelas'])?>
            </div>
            <div class="card-body p-2">
            <?php
                if (empty(RombelByLevel($l['id']))) {
              ?>
              <div class="text-danger text-center">
                Belum ada Guru Kelas
              </div>
              <?php
                }else{
                    ?>
                    <?php
                    foreach (RombelByLevel($l['id']) as $r) {
                    ?>
                    <div class="d-grid text-left">
                    <a class="btn btn-light btn-sm mb-1" href="<?=base_url('admin/walas/detail/'.$r['id'])?>" style="text-align:left"> <?=$r['rombel']?> (<?=$r['nm_guru']?>) </a>
                    </div>
                    <?php
                    }

                    ?>

                    <?php
                    
                }

                ?>

          
            </div>
        </div>
    </div>
    <?php endforeach ;?>
    <!-- end col-lg-3  -->
</div>
<?= $this->endSection() ?>