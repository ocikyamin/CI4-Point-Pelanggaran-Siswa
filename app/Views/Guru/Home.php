<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<!-- 
<div class="alert bg-primary text-white shadow-sm">
Sistem Pencatatan Pelanggaran Santri
</div> -->
    <?php
    if (TeacherLogin()->type=="walas") {
    // Cek Jika Walikelas belum memilih kelas
    if (empty($history_walas)) {
    ?>
    <div class="alert alert-light shadow-sm">
    Harap Konfirmasi, Apakah benar anda mendaftar sebagai Guru Kelas ?
   <div>
   <button onclick="settingKelas(<?=TeacherLogin()->id?>)" class="btn btn-primary btn-sm shadow-sm mt-3">Ya, Sesuaikan Kelas</button>
    <button onclick="RemoveType(<?=TeacherLogin()->id?>)" class="btn btn-danger btn-sm shadow-sm mt-3">Tidak, Saya Bukan Guru Kelas</button>
   </div>
    </div>
    <?php
    }
    }
    ?>
            <div class="card card-body shadow-sm mt-3">
              <div class="row">
                <div class="col-lg-10">
                  <div class="position-relative">
                    <input type="text" class="form-control product-search ps-5 mb-3" id="siswa-search" placeholder="Cari Siswa (NISN, Nama, Kelas) ">
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                  </div>
                </div>
                <div class="col-lg-2">

                <div class="dropdown">
                  <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-filter text-white me-1 fs-5"></i> Filter Kelas
                  </a>
                  <ul class="dropdown-menu">
                <li><a class="dropdown-item active" href="#" onclick='location.reload(true); return false;'>Reset Filter</a></li>
                <?php
                foreach ($filter_rombel as $d) {?>
                <li><a class="dropdown-item" href="#" onclick="SiswaByRombel(<?=$d['id']?>)">Kelas <?=$d['rombel']?></a></li>
                <?php } ?>
                </ul>
                </div>
              </div>
              </div>
              <h5><em><b class="mb-1 text-primary" id="key-area"></b></em> </h5>
              <div id="list_siswa">
              <div class="alert alert-warning">
                Daftar siswa yang anda cari akan tampil disini ...
              </div>
            </div>
          
            <!-- <div id="list_siswa">
              <div class="alert alert-warning">
                Daftar siswa yang anda cari akan tampil disini ...
              </div>
            </div> -->
          <!-- </div> -->
   
      <div class="modalview"></div>

          <script>
            $(document).ready(function () {
                $('#siswa-search').keyup(function (e) { 
                //    e.preventDefault();
                   $('#key-area').html($(this).val())
                if ($(this).val()=="") {
                    $('#list_siswa').html(` <div class="alert alert-warning">
                Daftar siswa yang anda cari akan tampil disini ...
              </div>`) 
                }else{
                    $.ajax({
                        type: "post",
                        url: "<?=base_url('teacher/cari')?>",
                        data: {key: $(this).val()},
                        dataType: "json",
                        success: function (response) {
                            if (response.view) {
                                $('#list_siswa').html(response.view) 
                            }
                        }
                    });
                }
                });
            });
     


    function settingKelas(guruid) {
        $.ajax({
            url: "<?=base_url('teacher/setting/kelas')?>",
            data: {guruid:guruid},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.view);
                $('#modal-setting-kelas').modal('show');
            }
        });

      }

    function RemoveType(guruid) {
      Swal.fire({
      title: 'Are you sure?',
      text: "Tindakan ini akan mengubah hak akses anda sebagai guru kelas menjadi guru mata pelajaran",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Ubah Hak Akses',
      cancelButtonText: 'Batal'
      }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            type : "post",
          url: "<?=base_url('teacher/setting/remove-type')?>",
          data: {guruid:guruid},
          dataType: "json",
          success: function (response) {
              Swal.fire(
              'Berhasil!',
              'Tipe akun telah di ubah..',
              'success'
              ).then((result) => {
                window.location=response.link
              })
          }
          });

      }
      })


      }

function SiswaByRombel(rombel) { 
      $.ajax({
      type: "post",
      url: "<?=base_url('teacher/cari/rombel')?>",
      data: {rombel: rombel},
      dataType: "json",
      success: function (response) {
      if (response.view) {
      $('#list_siswa').html(response.view) 
      }
      }
      });
 }
 
</script>
<?= $this->endSection() ?>