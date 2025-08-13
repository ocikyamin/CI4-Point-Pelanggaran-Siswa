<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<!-- Nav tabs -->
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-user-exclamation"></i> Rekam</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="ti ti-history"></i> Riwayat Pelanggaran</button>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
<!-- Pencatatan Pelanggaran  -->



<div class="alert bg-primary text-white shadow-sm py-1 mt-3">
<b><i class="ti ti-info-circle"></i> Info !</b>
Cari siswa untuk melakukan pencatatan pelanggaran
</div>
  
        
              <div class="row">
                <div class="col-lg-8">
                <form id="form-cari-siswa">
                <div class="input-group mb-1">
                <select class="form-select" name="filter" style="max-width:130px">
                <option value="nama">by Nama</option>
                <option value="nisn">by NISN</option>
                </select>
                <input type="text" name="key" class="form-control" id="siswa-search" placeholder="Cari Siswa (NISN, Nama, Kelas) ">
                <button type="submit" class="input-group-text" id="btn-cari"><i class="ti ti-search"></i></button>
                <div class="invalid-feedback key"></div>
                </div>
                </form>
                </div>
                <div class="col-lg-2">
                <select class="form-select mb-1" id="filter-kelas">
                  <option value="">Siswa Kelas</option>
                  <?php
                  foreach ($filter_rombel as $k) {
                  ?>
                  <option value="<?=$k['id']?>"><?=$k['rombel']?></option>

                  <?php
                  }

                  ?>

                  </select>

                </div>
                    <div class="col-lg-2 text-center">
                    <a class="btn btn-primary" href="#" onclick='location.reload(true); return false;'><i class="ti ti-refresh"></i> Refresh</a>
                  </div>
              </div>
              <!-- Pencatatan Pelanggaran  -->
              <div id="list_siswa"></div>


</div>
<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
  <div class="row mt-3">
    <div class="col-lg-2">
      <div class="form-group">
        <label for="date_start">Tanggal Mulai</label>
        <div>
          <input type="date" name="date_start" id="date_start" value="<?=date('Y-m-d')?>" class="form-control form-control-sm">
        </div>
      </div>
    </div>
    <div class="col-lg-3">


      <!-- <div class="form-group">
        <label for="date_end">Tanggal Mulai</label>
        <div>
          <input type="date" name="date_end" id="date_end" value="<?=date('Y-m-d')?>" class="form-control form-control-sm">
        </div>
      </div> -->

      <label for="date_end">Tanggal Mulai</label>
    <div class="input-group input-group-sm">
    <input type="date" name="date_end" id="date_end" value="<?=date('Y-m-d')?>" class="form-control form-control-sm">
    <button id="btn-tampilkan" class="input-group-text"><i class="ti ti-search"></i> Tampilkan</button>
    </div>
    </div>
  </div>
  <div id="section-riwayat-langgar" class="mt-3"></div>

</div>
</div>


          
  
   
      <div class="modalview"></div>

          <script>

            $(document).ready(function () {
              var Start = $('#date_start').val()
              var End = $('#date_end').val()
              RiwayatPelanggaran(Start,End)
            });

            $('#btn-tampilkan').click(function (e) { 
              e.preventDefault();
              var Start = $('#date_start').val()
              var End = $('#date_end').val()
              RiwayatPelanggaran(Start,End)
              
            });



            $('#form-cari-siswa').submit(function (e) { 
              e.preventDefault();
              $.ajax({
              type: "post",
              url: "<?=base_url('teacher/cari')?>",
              data: $(this).serialize(),
              dataType: "json",
              success: function (response) {
                if (response.status==false) {
                  if (response.key) {
                    $('#siswa-search').addClass('is-invalid');
                    $('.key').text(response.key);
                  }
                }
              if (response.view) {
                $('#siswa-search').removeClass('is-invalid');
                $('#siswa-search').addClass('is-valid');
              $('#list_siswa').html(response.view) 
              }
              }
              });

              
            });



            // $(document).ready(function () {
            //     $('#siswa-search').keyup(function (e) { 
            //     //    e.preventDefault();
            //        $('#key-area').html($(this).val())
            //     if ($(this).val()=="") {
            //         $('#list_siswa').html(` <div class="alert alert-warning">
            //     Daftar siswa yang anda cari akan tampil disini ...
            //   </div>`) 
            //     }else{
            //         $.ajax({
            //             type: "post",
            //             url: "<?=base_url('teacher/cari')?>",
            //             data: {key: $(this).val()},
            //             dataType: "json",
            //             success: function (response) {
            //                 if (response.view) {
            //                     $('#list_siswa').html(response.view) 
            //                 }
            //             }
            //         });
            //     }
            //     });
            // });
     


    // function settingKelas(guruid) {
    //     $.ajax({
    //         url: "<?=base_url('teacher/setting/kelas')?>",
    //         data: {guruid:guruid},
    //         dataType: "json",
    //         success: function (response) {
    //             $('.modalview').html(response.view);
    //             $('#modal-setting-kelas').modal('show');
    //         }
    //     });

    //   }


 $('#filter-kelas').change(function (e) { 
  e.preventDefault();
  $.ajax({
      type: "post",
      url: "<?=base_url('teacher/cari/rombel')?>",
      data: {rombel: $(this).val()},
      dataType: "json",
      success: function (response) {
      if (response.view) {
      $('#list_siswa').html(response.view) 
      }
      }
      });
  
 });


 // daftar pelanggaran

 function RiwayatPelanggaran(start,end) {
  $.ajax({
    type: "post",
    url: "<?=base_url('teacher/langgar/riwayat')?>",
    data: {
      start : start,
      end : end,
    },
    dataType: "json",
    success: function (response) {
      $('#section-riwayat-langgar').html(response.riwayat)
    }
  });
  
 }
 
</script>
<?= $this->endSection() ?>