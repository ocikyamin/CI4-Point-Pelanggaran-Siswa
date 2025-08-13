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
    // $routes->get('register', 'Auth::Register');
    // $routes->post('check', 'Auth::RegisterCheck');
});

$routes->group('teacher', static function ($routes) {
    $routes->get('/', 'Guru\Home::index');
    $routes->get('logout', 'Guru\Home::Logout');
    $routes->post('cari', 'Guru\Home::CariSiswa');
    $routes->post('cari/rombel', 'Guru\Home::CariSiswaRombel');

    // Notif
    $routes->get('notif', 'Guru\Home::Notif');


    // Student 
    // $routes->get('student', 'Guru\Student::index');
    // $routes->get('student/add', 'Guru\Student::StudentAdd');
    // $routes->post('student/save', 'Guru\Student::StudentSave');
    // $routes->get('student/rombel', 'Guru\Student::StudentByRombel');

    // $routes->get('student/edit', 'Guru\Student::StudentEdit');
    // $routes->post('student/update', 'Guru\Student::StudentUpdate');


    // Pengaturan Kelas 
    // $routes->get('setting/kelas', 'Guru\Setting::SettingKelas');
    // $routes->post('setting/simpan-pengaturan-kelas', 'Guru\Setting::SimpanSettingKelas');
    // Pelanggaran 
    $routes->post('student/form-pelanggaran', 'Guru\Pelanggaran::FormPelanggaran');
    $routes->post('student/pelanggaran/edit', 'Guru\Pelanggaran::FormEditPelanggaran');
    $routes->post('student/pelanggaran/save', 'Guru\Pelanggaran::SimpanPelanggaran');
    $routes->get('student/pelanggaran/info', 'Guru\Pelanggaran::Info');
    $routes->get('student/pelanggaran/detail', 'Guru\Pelanggaran::DetailPelanggaran');
    
    $routes->post('langgar/riwayat', 'Guru\Pelanggaran::PelanggaranTanggal');

});

// Presensi
// $routes->group('teacher/presensi', static function ($routes) {
//     $routes->get('/', 'Guru\Presensi::index');
//     $routes->get('kelas/(:num)', 'Guru\Presensi::PresensiKelas/$1');
//     $routes->get('rekap', 'Guru\Presensi::RekapPresensiKelas');
//     $routes->get('presensi', 'Guru\Presensi::FormPresensiKelas');
//     $routes->post('save', 'Guru\Presensi::Save');
//     $routes->get('edit', 'Guru\Presensi::EditPresensiKelas');
//     $routes->post('update', 'Guru\Presensi::UpdatePresensiKelas');
//     $routes->post('delete', 'Guru\Presensi::Delete');
// });
// Jurnal / Jadwal

$routes->group('teacher/jurnal', static function ($routes) {
    // Jadwal
    $routes->get('/', 'Guru\JurnalMengajar::index');
    $routes->get('jadwal/list', 'Guru\JurnalMengajar::JadwalList');
    $routes->get('jadwal/add', 'Guru\JurnalMengajar::JadwalAdd');
    $routes->get('jadwal/edit', 'Guru\JurnalMengajar::JadwalEdit');
    $routes->post('jadwal/save', 'Guru\JurnalMengajar::JadwalSave');
    $routes->post('jadwal/delete', 'Guru\JurnalMengajar::JadwalDelete');

    // Agenda
    $routes->get('agenda/(:num)', 'Guru\JurnalMengajar::Agenda/$1');
    $routes->get('agenda/list', 'Guru\JurnalMengajar::AgendList');
    $routes->post('agenda/add', 'Guru\JurnalMengajar::AgendaAdd');
    $routes->post('agenda/edit', 'Guru\JurnalMengajar::AgendaEdit');
    $routes->post('agenda/save', 'Guru\JurnalMengajar::AgendaSave');
    $routes->post('agenda/delete', 'Guru\JurnalMengajar::AgendaDelete');
    $routes->get('agenda/print/(:num)', 'Guru\JurnalMengajar::AgendaPrint/$1');
    // Presensi
    $routes->get('presensi/list', 'Guru\JurnalMengajar::PresensiList');
    $routes->post('presensi/save', 'Guru\JurnalMengajar::PresensiSave');
    $routes->get('presensi/rekap', 'Guru\JurnalMengajar::PresensiRekap');
});

$routes->group('teacher/history', static function ($routes) {
    $routes->get('/', 'Guru\History::index');
    $routes->post('delete', 'Guru\History::Delete');
});

$routes->group('teacher/walas', static function ($routes) {
    $routes->get('/', 'Guru\Walas::index');
    $routes->get('kelas/(:num)', 'Guru\Walas::Kelas/$1');
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
    $routes->get('guru/add', 'SuperAdmin\Users\UserC::AddGuru');
    $routes->get('guru/edit', 'SuperAdmin\Users\UserC::EditGuru');
    $routes->post('guru/store', 'SuperAdmin\Users\UserC::StoreGuru');
    $routes->post('guru/update', 'SuperAdmin\Users\UserC::UpdateGuru');
    $routes->post('guru/del', 'SuperAdmin\Users\UserC::DeleteGuru');
    $routes->post('guru/status', 'SuperAdmin\Users\UserC::SetStatusGuru');
    $routes->post('guru/reset', 'SuperAdmin\Users\UserC::ResetPasswordGuru');
    $routes->get('guru/import', 'SuperAdmin\Users\UserC::ImportGuru');
    $routes->post('guru/store-import', 'SuperAdmin\Users\UserC::StoreImportGuru');
    // $routes->get('guru', 'SuperAdmin\Users\GuruC::index');
});



// Student 
$routes->group('admin/student', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Student\StudentC::index');
    $routes->post('rombel', 'SuperAdmin\Student\StudentC::ByRombel');
    $routes->post('move', 'SuperAdmin\Student\StudentC::MoveSiswa');
    $routes->post('delete', 'SuperAdmin\Student\StudentC::DeleteSiswa');
    $routes->post('upload', 'SuperAdmin\Student\StudentC::UploadSiswa');
    $routes->get('add', 'SuperAdmin\Student\StudentC::Add');
    $routes->get('edit', 'SuperAdmin\Student\StudentC::Edit');
    $routes->post('save', 'SuperAdmin\Student\StudentC::StudentStore');
    // $routes->get('sekolah/(:num)', 'SuperAdmin\Student\StudentC::BySekolahId/$1');
});


// Wali Kelas 
$routes->group('admin/walas', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Walas\WalasC::index');
    $routes->post('periode', 'SuperAdmin\Walas\WalasC::WalasPeriode');
    $routes->post('add', 'SuperAdmin\Walas\WalasC::AddWalas');
    $routes->post('store', 'SuperAdmin\Walas\WalasC::StoreWalas');
    $routes->post('del', 'SuperAdmin\Walas\WalasC::DeleteWalas');
    $routes->post('edit', 'SuperAdmin\Walas\WalasC::EditWalas');


    $routes->get('detail/(:num)', 'SuperAdmin\Walas\WalasC::Detail/$1');
});

// $routes->group('admin/pelanggran', static function ($routes) {
//     $routes->get('/', 'SuperAdmin\Walas\WalasC::index');
//     $routes->get('detail/(:num)', 'SuperAdmin\Walas\WalasC::Detail/$1');
// });

// Pelanggaran - admin
$routes->group('admin/pelanggaran', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Pelanggaran\PelanggaranC::index');
    $routes->get('news', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranNews');
    $routes->get('info', 'SuperAdmin\Pelanggaran\PelanggaranC::InfoPelanggaran');
    $routes->get('detail', 'SuperAdmin\Pelanggaran\PelanggaranC::DetailPelanggaran');


    $routes->get('kelas', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranByKelas');
    // $routes->get('tanggal', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranByTanggal');



    $routes->get('kelas/all', 'SuperAdmin\Pelanggaran\PelanggaranC::PelanggaranKelasAll');
    
    
    
    // grafik
    $routes->get('grafik', 'SuperAdmin\Pelanggaran\PelanggaranC::GrafikPelanggaran');
});

$routes->group('report', static function ($routes) {
    $routes->get('pelanggaran/siswa/(:num)', 'Report::PelanggaranSiswaId/$1');
    $routes->get('pelanggaran/kelas/(:num)', 'Report::PelanggaranSiswaKelas/$1');

    $routes->get('presensi/kelas/(:num)', 'Report::PresensiByKelasMengajar/$1');
});
$routes->group('master', static function ($routes) {
    $routes->get('kelas-level', 'Master::KelasLevel');
    $routes->get('kelas-rombel', 'Master::KelasRombel');
    $routes->get('kelas-rombel-periode', 'Master::RombelBySekolahPeriode');
    // $routes->post('kelas-rombel', 'Master::KelasRombel');


    $routes->post('item-pelanggaran', 'Master::ItemPelanggaranByJenis');
    $routes->get('pelanggaran/kelas/(:num)', 'Report::PelanggaranSiswaKelas/$1');
});

// Setting 

$routes->group('admin/setting/', static function ($routes) {
    $routes->get('/', 'SuperAdmin\Setting::index');
    // Pelanggran 
    $routes->post('langgar/list', 'SuperAdmin\Setting::LanggarList');
    $routes->get('langgar/add', 'SuperAdmin\Setting::AddItemLanggar');
    $routes->get('langgar/edit', 'SuperAdmin\Setting::EditItemLanggar');
    $routes->post('langgar/store', 'SuperAdmin\Setting::StoreLanggar');
    $routes->post('langgar/del', 'SuperAdmin\Setting::DeleteLanggar');
    // Periode
    $routes->post('periode/list', 'SuperAdmin\Setting::PeriodeList');
    $routes->post('periode/set', 'SuperAdmin\Setting::SetPeriodeStt');
    $routes->get('periode/add', 'SuperAdmin\Setting::AddPeriode');
    $routes->get('periode/edit', 'SuperAdmin\Setting::EditPeriode');
    $routes->post('periode/store', 'SuperAdmin\Setting::StorePeriode');
    $routes->post('periode/del', 'SuperAdmin\Setting::DeletePeriode');
    $routes->post('periode/setsem', 'SuperAdmin\Setting::SetSemester');
    
    // Sekolah
    $routes->post('sekolah/list', 'SuperAdmin\Setting::SekolahList');
    $routes->get('sekolah/add', 'SuperAdmin\Setting::AddSekolah');
    $routes->get('sekolah/edit', 'SuperAdmin\Setting::EditSekolah');
    $routes->post('sekolah/store', 'SuperAdmin\Setting::StoreSekolah');
    $routes->post('sekolah/del', 'SuperAdmin\Setting::DeleteSekolah');
});

// Ajax 
// $routes->group('ajax', static function ($routes) {
//     $routes->post('get-kelas', 'Master::ItemPelanggaranByJenis');
// });

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
