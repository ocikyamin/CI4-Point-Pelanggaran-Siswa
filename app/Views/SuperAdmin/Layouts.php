<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PPS | <?=$title?></title>
        <link rel="shortcut icon" type="image/png" href="<?=base_url('public/')?>assets/images/logos/icon.png" />
        <link rel="stylesheet" href="<?=base_url('public/')?>assets/css/styles.min.css" />
        <script src="<?=base_url('public/')?>assets/libs/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/toastify-js/toastify.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/sweetalert2/sweetalert2.min.css">
        <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/toastify-js/toastify.js"></script>
        <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>assets/libs/DataTables/datatables.min.css">
        <script type="text/javascript" src="<?=base_url('public/')?>assets/libs/DataTables/datatables.min.js"></script>
<style>
.round-16 {
width: 16px;
height: 16px;
}
.sidebar-nav ul .sidebar-item .first-level .sidebar-link .ti {
font-size: 7px;
}
</style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex bg-light align-items-center justify-content-between">
          <a href="<?=base_url('admin')?>" class="text-nowrap logo-img">
            <img src="<?=base_url('public/')?>assets/images/logos/brand.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- <hr class="border border-primary border-2 opacity-50"> -->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <!-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li> -->
            <li class="sidebar-item mt-3">
              <a class="sidebar-link" href="<?=base_url('admin')?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MAIN MENU</span>
            </li>
              <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/users')?>" aria-expanded="false">
                <span>
                <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>
              <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/setting')?>" aria-expanded="false">
                <span>
                <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Pengaturan</span>
              </a>
            </li>
            
            <!-- <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                  <i class="ti ti-settings"></i>
                  </span>
                  <span class="hide-menu">Pengaturan</span>
                  <span class="ti ti-arrow-circle-down"></span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="<?=base_url('admin/setting/periode')?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Periode</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="<?=base_url('admin/setting/sekolah')?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Sekolah</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="<?=base_url('admin/setting/kelas')?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Kelas</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="<?=base_url('admin/setting/langgar')?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Pelanggaran</span>
                    </a>
                  </li>
            
                </ul>
              </li> -->
            <!-- <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                  <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">Siswa</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <?php
                    foreach (ListOfSekolah() as $s):?>
                  <li class="sidebar-item">
                    <a href="<?=base_url('admin/student/sekolah/'.$s['id'])?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?=$s['nm_sekolah']?></span>
                    </a>
                  </li>
                  <?php endforeach; ?>
            
                </ul>
              </li> -->
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/student')?>" aria-expanded="false">
                <span>
                <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Siswa</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/walas')?>" aria-expanded="false">
                <span>
                <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Wali Kelas</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/walas')?>" aria-expanded="false">
                <span>
                <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Guru</span>
              </a>
            </li> -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/pelanggaran')?>" aria-expanded="false">
                <span>
                <i class="ti ti-history"></i>
                </span>
                <span class="hide-menu">Pelanggaran</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">User</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/#')?>" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Account</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('admin/logout')?>" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </li>
            
    
          </ul>
          <!-- <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">PPS</h6>
                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">V.1</a>
              </div>
              <div class="unlimited-access-img">
                <img src="<?=base_url('public/')?>assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
              </div>
            </div>
          </div> -->
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
       <!--  Header Start -->
       <header class="app-header bg-light">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="#" class="btn btn-dark"><i class="ti ti-calendar-event"></i>
              <?php
              if (PeriodeAktif()) {
                echo PeriodeAktif()->nm_periode;
              }
              ?></a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?=base_url('public/')?>assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="<?=base_url('admin/logout')?>" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->     
    
      <!--  Header End -->
      <div class="container-fluid">
      <?= $this->renderSection('content') ?>
      </div>
    </div>
  </div>
  <script src="<?=base_url('public/')?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url('public/')?>assets/js/sidebarmenu.js"></script>
  <script src="<?=base_url('public/')?>assets/js/app.min.js"></script>
  <!-- <script src="<?=base_url('public/')?>assets/libs/simplebar/dist/simplebar.js"></script> -->
</body>

</html>