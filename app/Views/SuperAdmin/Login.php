
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PPS (Poin Pelanggaran Santri)</title>
  <link rel="shortcut icon" type="image/png" href="<?=base_url('public/')?>assets/images/logos/icon.png" />
  <link rel="stylesheet" href="<?=base_url('public/')?>assets/css/styles.min.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/toastify-js/toastify.min.css">
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
                <a href="<?=base_url()?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?=base_url('public/')?>assets/images/logos/brand.png" width="180" alt="">
                </a>
                <p class="text-center">MADRASAH TARBIYAH ISLAMIYAH (MTI) CANDUANG</p>
                <form id="login-form" method="post">
                  <?=csrf_field()?>
                  <div class="mb-3">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="user_email" id="user_email" placeholder="yamin@gmail.com">
                  </div>
                  <div class="mb-4">
                    <label for="user_pass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="* * * * *">
                  </div>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
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
        url: "<?=base_url('auth/admin/check')?>",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
          // If in-valid 
         if (response.error) {
          if (response.error.user_email) {
            $('#user_email').addClass('is-invalid');
            Toastify({
            text: response.error.user_email      
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