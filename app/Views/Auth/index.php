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
<style>

        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .password-toggle i {
            font-size: 1.5em; /* Change this value to make the icon larger or smaller */
        }
        
    </style>
</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin1" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-4 col-lg-4 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <div class="text-center">
                <a href="<?=base_url()?>" class="logo-img">
                  <img src="<?=base_url('public/')?>assets/images/logos/brand.png" width="200" class="img-fluid" alt="Logo PPS">
                </a>
                </div>
                
                <p class="text-center">
                  <b>PONDOK PESANTREN</b> <br>
                  <strong style="font-size:20px">مدرسة
التربية
الإسلامية
جندونج</strong>
                </p>
                <div class="mb-2 text-center text-sm" style="line-height: 1.2;font-size:12px">
                
                  Masukkan ID / Password yang diberikan oleh administrator untuk masuk pada halaman utama aplikasi.
                  
                </div>
                <form id="login-form" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="user_code" class="form-label">ID/NISN</label>
                <input type="text" class="form-control" name="user_code" id="user_code" placeholder="212321001">
            </div>
            <div class="mb-4 password-container">
                <label for="user_pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="* * * * *">
                <span class="password-toggle" id="toggle-password">
                    <i class="ti ti-eye text-primary"></i>
                </span>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2"> <i class="ti ti-login"></i> Login</button>
            
            <button type="button" id="install-button" class="btn btn-secondary btn-sm w-100 mb-4 rounded-2" style="display: none;">
    <i class="ti ti-download"></i> Install App
</button>

            <div class="d-flex align-items-center justify-content-center">
                <p class="fs-4 mb-0 fw-bold"><b>#MTIC</b> Go Digital</p>
            </div>
        </form>
              </div>
            </div>
            <p>
            <div class="text-center">© <a href="https://github.com/ocikyamin" class="link-secondary" target="_blank">ocikyamin</a> at MTIC</div>
            </p>
         
          </div>
        </div>
       
      </div>
    </div>
    
  </div>
  <script src="<?=base_url('public/')?>assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url('public/')?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/toastify-js/toastify.js"></script>
  <script>
     $(document).ready(function() {
            $('#toggle-password').on('click', function() {
                const passwordField = $('#user_pass');
                const passwordFieldType = passwordField.attr('type');
                const icon = $(this).find('i');
                
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('ti-eye').addClass('ti-eye-off text-danger');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('ti-eye-off text-danger').addClass('ti-eye');
                }
            });
        });
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
            text: response.error.user_code,
            style: {
        background: "red",
        }  
            }).showToast();
          }

          if (response.error.user_pass) {
            $('#user_pass').addClass('is-invalid');
            Toastify({
            text: response.error.user_pass,
            style: {
        background: "red",
        } 
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
  <script>
    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent the mini-infobar from appearing on mobile
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;
        // Update UI notify the user they can install the PWA
        document.getElementById('install-button').style.display = 'block';
    });

    const installButton = document.getElementById('install-button');

    installButton.addEventListener('click', async () => {
        // Hide the app provided install promotion
        installButton.style.display = 'none';
        // Show the install prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        const { outcome } = await deferredPrompt.userChoice;
        if (outcome === 'accepted') {
            console.log('User accepted the install prompt');
        } else {
            console.log('User dismissed the install prompt');
        }
        // We've used the prompt, and can't use it again, throw it away
        deferredPrompt = null;
    });

    window.addEventListener('appinstalled', (evt) => {
        console.log('a2hs installed');
        // Hide the install button once the app is installed
        installButton.style.display = 'none';
    });
</script>

</body>

</html>