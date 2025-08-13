<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item">
<a href="#" class="text-info">Settings</a>
</li>
</ol>
</nav>
<div class="card">
  <div class="card-header">
  <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><i class="ti ti-settings"></i> Periode</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><i class="ti ti-settings"></i> Sekolah / Madrasah</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><i class="ti ti-settings"></i> Jenis Pelanggaran</button>
  </li>

</ul>
  </div>
  <div class="card-body">
  <!-- kontent  -->

  <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
   
      <div id="section-periode"></div>
  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

      <div id="section-sekolah"></div>
  </div>
  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
   <!-- <div class="alert mb-3 shadow-sm">
    <b>Pengaturan Jenis / Item / Poin Pelanggaran</b>
   </div> -->
<div class="alert bg-primary text-white mb-3 py-2 shadow-sm">
<b><i class="ti ti-settings"></i></b> Pengaturan Jenis / Item / Poin Pelanggaran
</div>
    <div id="section-pelanggran"></div>
  </div>
 
</div>
  <!-- kontent  -->

  </div>
</div>



<script>
$(document).ready(function () {
  LoadPeriode()
  LoadSekolah()
  LoadJenisLanggar()
});

function LoadPeriode() {
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/periode/list')?>",
        data: 'data',
        dataType: "json",
        success: function (response) {
           $('#section-periode').html(response.view) 
        }
    });
    
}
function LoadSekolah() {
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/sekolah/list')?>",
        data: 'data',
        dataType: "json",
        success: function (response) {
           $('#section-sekolah').html(response.view) 
        }
    });
    
}
function LoadJenisLanggar() {
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/setting/langgar/list')?>",
        data: 'data',
        dataType: "json",
        success: function (response) {
           $('#section-pelanggran').html(response.view) 
        }
    });
    
}

</script>
<!-- <script src="<?=base_url('ajax/rombel.js')?>"></script> -->

<?= $this->endSection() ?>