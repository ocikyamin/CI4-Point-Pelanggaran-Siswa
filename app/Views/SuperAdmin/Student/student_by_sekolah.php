<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item">
<a href="#" class="text-info">Student</a>
</li>
<li class="breadcrumb-item active text-info font-medium" aria-current="page">
Sekolah (<?=$sekolah['nm_sekolah']?>)
</li>
</ol>
</nav>

<div class="row">
    <!-- col-lg-3  -->
    <?php
    foreach ($level as $l):?>
    <div class="col-lg-3">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white text-center">
            <h1><i class="ti ti-school text-white"></i></h1> <?=strtoupper($l['level_kelas'])?>
            </div>
            <div class="card-body p-2">
            <?php
                if (empty(RombelByLevel($l['id']))) {
              ?>
              <div class="text-danger text-center mt-2 mb-2">
                Belum ada Rombel
              </div>
              <?php
                }else{
                    ?>
                          <select class="selectrombelid form-select m-0" aria-label="Default select example">
                <option value="" selected>Pilih Siswa Kelas</option>
                <?php
                foreach (RombelByLevel($l['id']) as $r) {
                ?>
                <option value="<?=$r['id']?>"><?=$r['rombel']?></option>
                <?php
                }
                
                ?>

                </select>
                    
                    <?php
                    
                }

                ?>

          
            </div>
        </div>
    </div>
    <?php endforeach ;?>
    <!-- end col-lg-3  -->
</div>

<div id="siswa-rombel"></div>



<script>
    $('.selectrombelid').change(function (e) { 
        e.preventDefault();
       if ($(this).val()=="") {
        $('#siswa-rombel').html('')
       }else{
        $.ajax({
            url: "<?=base_url('admin/student/rombel')?>",
            data: {rombelid:$(this).val()},
            dataType: "json",
                beforeSend: function() {
                $('#siswa-rombel').html(`<div class="text-center"> <div class="spinner-border spinner-border-lg text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
                </div> </div>`);
                },
            success: function (response) {
                $('#siswa-rombel').html(response.table_rombel_siswa)
                
            }
        });
       }

        
    });
</script>

<?= $this->endSection() ?>