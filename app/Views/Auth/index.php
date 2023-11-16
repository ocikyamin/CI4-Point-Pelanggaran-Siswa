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
<meta name="theme-color" content="#5D87FF"/>
<!-- OG  -->
<meta property="og:title" content="PPS (Poin Pelanggaran Santri)">
<meta property="og:description" content="Selamat datang di PPS (Poin Pelanggaran Santri) - Portal Pelanggaran Santri di Madrasah Tarbiyah Islamiyah (MTI) Canduang. Situs ini menyediakan informasi mengenai pelanggaran santri di sekolah kami, lengkap dengan sistem pencatatan poin dan aturan-aturan yang berlaku. Temukan catatan pelanggaran, kedisiplinan, dan langkah-langkah perbaikan yang diambil untuk menciptakan lingkungan belajar yang harmonis dan berdisiplin. Bersama-sama kita membentuk santri yang berkarakter dan bertanggung jawab. Mari kita ciptakan lingkungan belajar yang lebih baik untuk masa depan yang gemilang.">
<meta property="og:image" content="<?=base_url('public/')?>assets/images/logos/logo.png">
<meta property="og:url" content="<?=base_url()?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PPS (Poin Pelanggaran Santri)">
<meta name="google-site-verification" content="p-6SNE1SWuzmTo-vekTO4uoQOiBkZptiMd6C1EgI1Iw" />
<!-- OG -->
<link rel="stylesheet" href="<?=base_url('public/')?>assets/css/styles.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/toastify-js/toastify.min.css">
<!-- PWA  -->
<link rel="manifest" href="<?=base_url('manifest.json')?>">
<script>
if ('serviceWorker' in navigator) {
navigator.serviceWorker.register('<?=base_url('service-worker.js')?>')
.then((registration) => {
// console.log('Service Worker berhasil terdaftar.');
})
.catch((error) => {
// console.log('Pendaftaran Service Worker gagal:', error);
});
}
</script>
<!-- PWA  -->
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
                <div class="text-center">
                <a href="<?=base_url()?>" class="logo-img">
                  <img src="<?=base_url('public/')?>assets/images/logos/logo.png" width="180" alt="Logo PPS">
                </a>
                </div>
                
                <p class="text-center">MADRASAH TARBIYAH ISLAMIYAH (MTI) CANDUANG</p>
                <form id="login-form" method="post">
                  <?=csrf_field()?>
                  <div class="mb-3">
                    <label for="user_code" class="form-label">NUPTK/NISN</label>
                    <input type="text" class="form-control" name="user_code" id="user_code" placeholder="212321001">
                  </div>
                  <div class="mb-4">
                    <label for="user_pass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="* * * * *">
                  </div>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum punya akun ?</p>
                    <a class="text-primary fw-bold ms-2" href="<?=base_url('auth/register')?>">Create an account</a>
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
  <script src="<?=base_url('public/')?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/toastify-js/toastify.js"></script>
  <script>
    $('#login-form').submit(function (e) { 
      e.preventDefault();
      $.ajax({
        type: "post",
        url: "<?=base_url('auth/login')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
          // If in-valid 
         if (response.error) {
          if (response.error.user_code) {
            $('#user_code').addClass('is-invalid');
            Toastify({
            text: response.error.user_code      
            }).showToast();
          }

          if (response.error.user_pass) {
            $('#user_pass').addClass('is-invalid');
            Toastify({
            text: response.error.user_pass      
            }).showToast();
          }
          
         }

        //  If Valid 
        if (response.success) {
          if (response.success.status) {
            window.location=response.success.link_to
          }
        }


        }
      });
      
    });
  </script>
</body>

</html>