<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('auth', static function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::LoginCheck');
    $routes->get('register', 'Auth::Register');
    $routes->post('check', 'Auth::RegisterCheck');
});

$routes->group('teacher', static function ($routes) {
    $routes->get('/', 'Guru\Home::index');
    $routes->get('logout', 'Guru\Home::Logout');
    $routes->post('cari', 'Guru\Home::CariSiswa');
    $routes->post('cari/rombel', 'Guru\Home::CariSiswaRombel');
    // Student 
    $routes->get('student', 'Guru\Student::index');
    $routes->get('student/add', 'Guru\Student::StudentAdd');
    $routes->post('student/save', 'Guru\Student::StudentSave');
    $routes->get('student/rombel', 'Guru\Student::StudentByRombel');

    $routes->get('student/edit', 'Guru\Student::StudentEdit');
    $routes->post('student/update', 'Guru\Student::StudentUpdate');


    // Pengaturan Kelas 
    $routes->get('setting/kelas', 'Guru\Setting::SettingKelas');
    $routes->post('setting/simpan-pengaturan-kelas', 'Guru\Setting::SimpanSettingKelas');
    $routes->post('setting/remove-type', 'Guru\Setting::RemoveTypeAkun');
    // Pelanggaran 
    $routes->get('student/pelanggaran/siswa/(:num)', 'Guru\Pelanggaran::DetailPelanggaran/$1/');
    $routes->post('student/form-pelanggaran', 'Guru\Pelanggaran::FormPelanggaran');
    $routes->post('student/pelanggaran/save', 'Guru\Pelanggaran::SimpanPelanggaran');
    $routes->post('student/form-edit-pelanggaran', 'Guru\Pelanggaran::FormEditPelanggaran');
    $routes->post('student/pelanggaran/update', 'Guru\Pelanggaran::SimpanPelanggaran');
});

// Presensi
$routes->group('teacher/presensi', static function ($routes) {
    $routes->get('/', 'Guru\Presensi::index');
    $routes->get('kelas/(:num)', 'Guru\Presensi::PresensiKelas/$1');
    $routes->get('rekap', 'Guru\Presensi::RekapPresensiKelas');
    $routes->get('presensi', 'Guru\Presensi::FormPresensiKelas');
    $routes->post('save', 'Guru\Presensi::Save');
    $routes->get('edit', 'Guru\Presensi::EditPresensiKelas');
    $routes->post('update', 'Guru\Presensi::UpdatePresensiKelas');
    $routes->post('delete', 'Guru\Presensi::Delete');
});
// Kelas
$routes->group('teacher/kelas', static function ($routes) {
    $routes->get('/', 'Guru\Kelas::index');
    $routes->get('add', 'Guru\Kelas::Add');
    $routes->post('save', 'Guru\Kelas::Save');
    $routes->post('delete', 'Guru\Kelas::Delete');
});
// history Entry 

$routes->group('teacher/history', static function ($routes) {
    $routes->get('/', 'Guru\History::index');
    $routes->post('delete', 'Guru\History::Delete');
});


// Admin Routes //

// Admin Login 
$routes->group('auth/admin', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Auth::index');
    $routes->post('check', 'SuperAdmin\Auth::CheckLogin');
});

$routes->group('admin', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Home::index');
    $routes->get('logout', 'SuperAdmin\Home::Logout');
});

// Users 
$routes->group('admin/users', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Users\UserC::index');
    $routes->get('super', 'SuperAdmin\Users\UserC::SuperUserList');
    $routes->get('guru', 'SuperAdmin\Users\UserC::GuruList');
    $routes->post('guru/status', 'SuperAdmin\Users\UserC::SetStatusGuru');
    $routes->post('guru/reset', 'SuperAdmin\Users\UserC::ResetPasswordGuru');
    // $routes->get('guru', 'SuperAdmin\Users\GuruC::index');
});

// Student 
$routes->group('admin/student', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Student\StudentC::index');
    $routes->get('sekolah/(:num)', 'SuperAdmin\Student\StudentC::BySekolahId/$1');
    $routes->get('rombel', 'SuperAdmin\Student\StudentC::ByRombel');
});


// Wali Kelas 
$routes->group('admin/walas', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Walas\WalasC::index');
    $routes->get('detail/(:num)', 'SuperAdmin\Walas\WalasC::Detail/$1');
});

$routes->group('admin/pelanggran', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Walas\WalasC::index');
    $routes->get('detail/(:num)', 'SuperAdmin\Walas\WalasC::Detail/$1');
});

// Pelanggaran - admin
$routes->group('admin/pelanggaran', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Pelanggaran\PelanggaranC::index');
    $routes->get('news', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranNews');
    $routes->get('kelas', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranByKelas');
    $routes->get('tanggal', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranByTanggal');
});

$routes->group('report', static function ($routes) {
    $routes->get('pelanggaran/siswa/(:num)', 'Report::PelanggaranSiswaId/$1');
    $routes->get('pelanggaran/kelas/(:num)', 'Report::PelanggaranSiswaKelas/$1');

    $routes->get('presensi/kelas/(:num)', 'Report::PresensiByKelasMengajar/$1');
});
$routes->group('master', static function ($routes) {

    $routes->get('kelas-level', 'Master::KelasLevel');
    $routes->get('kelas-rombel', 'Master::KelasRombel');


    $routes->post('item-pelanggaran', 'Master::ItemPelanggaranByJenis');
    $routes->get('pelanggaran/kelas/(:num)', 'Report::PelanggaranSiswaKelas/$1');
});

$routes->get('public/PWA/manifest.json', 'PWAController::manifest');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
