<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>PPS (Poin Pelanggaran Santri)</title>
<!-- Favicons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>favicon_io/favicon-16x16.png">
<meta name="description" content="Selamat datang di PPS (Poin Pelanggaran Santri) - Portal Pelanggaran Santri di Madrasah Tarbiyah Islamiyah (MTI) Canduang. Situs ini menyediakan informasi mengenai pelanggaran santri di sekolah kami, lengkap dengan sistem pencatatan poin dan aturan-aturan yang berlaku. Temukan catatan pelanggaran, kedisiplinan, dan langkah-langkah perbaikan yang diambil untuk menciptakan lingkungan belajar yang harmonis dan berdisiplin. Bersama-sama kita membentuk santri yang berkarakter dan bertanggung jawab. Mari kita ciptakan lingkungan belajar yang lebih baik untuk masa depan yang gemilang.">
<meta name="author" content="Abdul Yamin">
<meta name="keywords" content="PPS, Poin Pelanggaran Santri, Sistem Poin Pelanggaran, Madrasah Tarbiyah Islamiyah Canduang, Disiplin Santri, Catatan Pelanggaran, Sanksi Pelanggaran Santri, Perbaikan Perilaku Santri, Lingkungan Belajar Berkualitas, Pembentukan Karakter Santri.">
<link rel="canonical" href="<?=base_url()?>" />
<!-- OG  -->
<meta property="og:title" content="PPS (Poin Pelanggaran Santri)">
<meta property="og:description" content="Selamat datang di PPS (Poin Pelanggaran Santri) - Portal Pelanggaran Santri di Madrasah Tarbiyah Islamiyah (MTI) Canduang. Situs ini menyediakan informasi mengenai pelanggaran santri di sekolah kami, lengkap dengan sistem pencatatan poin dan aturan-aturan yang berlaku. Temukan catatan pelanggaran, kedisiplinan, dan langkah-langkah perbaikan yang diambil untuk menciptakan lingkungan belajar yang harmonis dan berdisiplin. Bersama-sama kita membentuk santri yang berkarakter dan bertanggung jawab. Mari kita ciptakan lingkungan belajar yang lebih baik untuk masa depan yang gemilang.">
<meta property="og:image" content="<?=base_url('public/')?>assets/images/logos/logo.png">
<meta property="og:url" content="<?=base_url()?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PPS (Poin Pelanggaran Santri)">
  <link rel="shortcut icon" type="image/png" href="<?=base_url('public/')?>assets/images/logos/icon.png" />
  <link rel="stylesheet" href="<?=base_url('public/')?>assets/css/styles.min.css" />
  <!-- <link rel="stylesheet" href="<?=base_url('public/')?>assets/libs/toast/css/Toast.min.css" /> -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/toastify-js/toastify.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/sweetalert2/sweetalert2.min.css">
        <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?=base_url('public/')?>assets/images/logos/brand.png" width="200" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form id="form-register" method="post">
                  <?=csrf_field()?>
                  <div class="mb-2">
                    <label for="full_name" class="form-label">Nama Lengkap & Gelar</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" placeholder="ex : Abdullah, S. Ag">
                  </div>
                  <div class="mb-2">
                    <label for="nuptk" class="form-label">NIP/NUPTK</label>
                    <input type="number" name="nuptk" class="form-control" id="nuptk" placeholder="ex : 212321001">
                  </div>

                    <div class="mb-2">
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="user_type" id="user_type_guru" value="guru">
                    <label class="form-check-label" for="user_type_guru">
                    Guru
                    </label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="user_type" id="user_type_walas" value="walas">
                    <label class="form-check-label" for="user_type_walas">
                    Walas
                    </label>
                    </div>
                    </div>
                  <div class="mb-2">
                    <label for="new_user_password" class="form-label">Password Baru</label>
                    <input type="password" name="new_password" class="form-control" id="new_user_password" placeholder="Masukkan Password Baru">
                  </div>

                  <div class="mb-2">
                    <label for="conf_user_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="conf_password" class="form-control" id="conf_user_password" placeholder="Masukkan Konfirmasi Password">
                  </div>

                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" name="is_confirm" type="checkbox" value="1" id="is_confirm">
                      <label class="form-check-label text-dark" for="is_confirm">
                        Saya Setuju untuk membuat akun baru
                      </label>
                    </div>
                  </div>

                  <button type="submit" id="btn-register" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="<?=base_url('auth')?>">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url('public/')?>assets/libs/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/toastify-js/toastify.js"></script>
  <!-- <script src="<?=base_url('public/')?>assets/libs/toast/js/Toast.min.js"></script> -->
  <script src="<?=base_url('public/')?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Register 
    $('#form-register').submit(function (e) { 
      e.preventDefault();
      $.ajax({
        type: "post",
        url: "<?=base_url('auth/check')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
if (response.error) {

  if (response.error.nuptk) {
    $('#nuptk').addClass('is-invalid');
        Toastify({
        text: response.error.nuptk      
        }).showToast();
  }

  if (response.error.full_name) {
    $('#full_name').addClass('is-invalid');
        Toastify({
        text: response.error.full_name
        }).showToast();
  }

  if (response.error.user_type) {
        Toastify({
        text: response.error.user_type
        }).showToast();
  }

  if (response.error.new_password) {
    $('#new_user_password').addClass('is-invalid');
        Toastify({
        text: response.error.new_password
        }).showToast();
  }

  if (response.error.conf_password) {
    $('#conf_user_password').addClass('is-invalid');
        Toastify({
        text: response.error.conf_password
        }).showToast();
  }

  if (response.error.is_confirm) {
        Toastify({
        text: response.error.is_confirm,
        style: {
        background: "linear-gradient(to right, #FF0000, #ffd966)",
        }
        }).showToast();
  }


}

if (response.status) {
Swal.fire(
      'Success!',
      response.msg,
      'success'
    ).then((result) => {

      window.location="<?=base_url('/')?>";
})

}
       
        }
      });

      
    });
  </script>
</body>

</html>