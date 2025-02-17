<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
//$routes->get('/', 'Home::index');
$routes->get('/', 'HomeController::index'); // Set halaman utama ke HomeController

// Dashboard route dengan proteksi middleware
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/dashboard/getChartData', 'Dashboard::getChartData');
$routes->get('/dashboard/getAvailableYears', 'Dashboard::getAvailableYears');
$routes->get('/dashboard/getLatestUsulan', 'Dashboard::getLatestUsulan');

$routes->get('/dashboard/getDetailUsulanDikirim', 'Dashboard::getDetailUsulanDikirim');


// Route untuk Unauthorized Page
$routes->get('unauthorized', function () {
    return view('unauth/unauthorized');
});

// Akun Admin
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'akun\AdminController::index');
    $routes->get('create', 'akun\AdminController::create');
    $routes->post('store', 'akun\AdminController::store');
    $routes->get('edit/(:num)', 'akun\AdminController::edit/$1');
    $routes->post('update/(:num)', 'akun\AdminController::update/$1');
    $routes->get('delete/(:num)', 'akun\AdminController::delete/$1');
    $routes->get('enable/(:num)', 'akun\AdminController::enable/$1');
    $routes->get('disable/(:num)', 'akun\AdminController::disable/$1');
});

// Routes akun Kabid GTK
$routes->group('kabidgtk', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'akun\KabidGTKController::index');
    $routes->get('create', 'akun\KabidGTKController::create');
    $routes->post('store', 'akun\KabidGTKController::store');
    $routes->get('edit/(:num)', 'akun\KabidGTKController::edit/$1');
    $routes->post('update/(:num)', 'akun\KabidGTKController::update/$1');
    $routes->get('delete/(:num)', 'akun\KabidGTKController::delete/$1');
    $routes->get('enable/(:num)', 'akun\KabidGTKController::enable/$1');
    $routes->get('disable/(:num)', 'akun\KabidGTKController::disable/$1');    
});

//Routes akun Operator Dinas
$routes->group('operatordinas', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'akun\OperatorDinasController::index');
    $routes->get('create', 'akun\OperatorDinasController::create');
    $routes->post('store', 'akun\OperatorDinasController::store');
    $routes->get('edit/(:num)', 'akun\OperatorDinasController::edit/$1');
    $routes->post('update/(:num)', 'akun\OperatorDinasController::update/$1');
    $routes->get('delete/(:num)', 'akun\OperatorDinasController::delete/$1');
    $routes->get('enable/(:num)', 'akun\OperatorDinasController::enable/$1');
    $routes->get('disable/(:num)', 'akun\OperatorDinasController::disable/$1');       
});

// Routes akun Operator Cabdin
$routes->group('operatorcabdin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'akun\OperatorCabdinController::index');
    $routes->get('create', 'akun\OperatorCabdinController::create');
    $routes->post('store', 'akun\OperatorCabdinController::store');
    $routes->get('edit/(:num)', 'akun\OperatorCabdinController::edit/$1');
    $routes->post('update/(:num)', 'akun\OperatorCabdinController::update/$1');
    $routes->get('delete/(:num)', 'akun\OperatorCabdinController::delete/$1');
    $routes->get('enable/(:num)', 'akun\OperatorCabdinController::enable/$1');
    $routes->get('disable/(:num)', 'akun\OperatorCabdinController::disable/$1');     
});

// Routes untuk Data Cabang Dinas
$routes->group('cabang-dinas', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'datacabdin\CabangDinasController::index');
    $routes->get('create', 'datacabdin\CabangDinasController::create');
    $routes->post('store', 'datacabdin\CabangDinasController::store');
    $routes->get('edit/(:num)', 'datacabdin\CabangDinasController::edit/$1');
    $routes->post('update/(:num)', 'datacabdin\CabangDinasController::update/$1');
    $routes->get('delete/(:num)', 'datacabdin\CabangDinasController::delete/$1');
});

// Routes untuk Data Kabupaten
$routes->group('kabupaten', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'datakabupaten\KabupatenController::index');
    $routes->get('create', 'datakabupaten\KabupatenController::create');
    $routes->post('store', 'datakabupaten\KabupatenController::store');
    $routes->get('edit/(:num)', 'datakabupaten\KabupatenController::edit/$1');
    $routes->post('update/(:num)', 'datakabupaten\KabupatenController::update/$1');
    $routes->get('delete/(:num)', 'datakabupaten\KabupatenController::delete/$1');
});

$routes->group('sekolah', function ($routes) {
    $routes->get('/', 'SekolahController::index');
    $routes->get('create', 'SekolahController::create');
    $routes->post('store', 'SekolahController::store');
    $routes->get('edit/(:num)', 'SekolahController::edit/$1');
    $routes->post('update/(:num)', 'SekolahController::update/$1');
    $routes->get('delete/(:num)', 'SekolahController::delete/$1');

    // Fitur Import Data
    $routes->get('import', 'SekolahController::importView'); // Tampilan Import
    $routes->post('previewExcel', 'SekolahController::previewExcel'); // Proses Preview Data
    $routes->post('saveImportedData', 'SekolahController::saveImportedData'); // Simpan Data Setelah Preview

    // Fitur Ekspor Data
    $routes->get('export', 'SekolahController::exportExcel'); // Proses Ekspor
    $routes->get('download-template', 'SekolahController::downloadTemplate'); // Download Template
});




$routes->get('/user/changePassword', 'UserController::changePassword');
$routes->post('/user/updatePassword', 'UserController::updatePassword');
$routes->get('/user/profile', 'UserController::profile');
$routes->post('/user/updateProfile', 'UserController::updateProfile');

// Routes untuk usulan
$routes->group('usulan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UsulanController::index');
    $routes->get('create', 'UsulanController::create');
    $routes->post('store', 'UsulanController::store');
    $routes->get('edit/(:num)', 'UsulanController::edit/$1');
    $routes->post('update/(:num)', 'UsulanController::update/$1');
    $routes->get('delete/(:num)', 'UsulanController::delete/$1');
    $routes->get('deletetolak/(:num)', 'UsulanController::deletetolak/$1');    
    $routes->get('revisi/(:num)', 'UsulanController::revisi/$1');
    $routes->post('updateRevisi/(:num)', 'UsulanController::updateRevisi/$1');
    $routes->get('getHistory/(:segment)', 'UsulanController::getHistory/$1');
});
$routes->post('revisi_usulan/deleteByNomorUsulan', 'RevisiUsulanController::deleteByNomorUsulan');
$routes->get('usulan/revisi/(:any)', 'UsulanController::revisi/$1');

$routes->get('/api/get-cabang-dinas/(:num)', 'UsulanController::getCabangDinas/$1');
$routes->get('/api/get-sekolah/(:num)', 'UsulanController::getSekolah/$1');


$routes->get('/usulan/konfirmasi-cetak/(:segment)', 'UsulanController::konfirmasiCetak/$1');
$routes->get('/usulan/generate-resi/(:any)', 'UsulanController::generateResi/$1');

//$routes->get('/usulan/generate-resi/(:segment)', 'UsulanController::generateResi/$1');

$routes->get('/pengiriman', 'PengirimanController::index');
$routes->post('/pengiriman/updateStatus', 'PengirimanController::updateStatus');
$routes->post('/verifikasi/update', 'VerifikasiController::updateStatus');

$routes->get('uploads/rekomendasi/(:any)', 'FileController::viewRekomendasi/$1');

// Routes untuk Verifikasi Usulan
$routes->group('verifikasi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'VerifikasiController::index');
});

$routes->group('telaah', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TelaahController::index');
    $routes->post('update', 'TelaahController::update');
});
/*
$routes->group('rekomkadis', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'RekomkadisController::index');
    $routes->post('store', 'RekomkadisController::store');
    $routes->get('delete/(:num)', 'RekomkadisController::delete/$1');
    $routes->get('edit/(:num)', 'RekomkadisController::edit/$1');
    $routes->post('updaterekomkadis/(:num)', 'RekomkadisController::updaterekomkadis/$1');
    $routes->get('sematkan/(:num)', 'SematkanController::index/$1');
});
// Rute khusus untuk proses penyematan rekomendasi
$routes->post('sematkan/proses', 'SematkanController::proses');
*/

$routes->group('rekomkadis', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'RekomkadisController::index');
    $routes->post('store', 'RekomkadisController::store');
    $routes->get('edit/(:num)', 'RekomkadisController::edit/$1');    
    $routes->get('delete/(:num)', 'RekomkadisController::delete/$1');
    $routes->post('updaterekomkadis/(:num)', 'RekomkadisController::updaterekomkadis/$1');

    // 🔹 **Perubahan Rute Sematkan**
    $routes->post('sematkan', 'RekomkadisController::sematkan'); // **Menangani penyematan langsung**
    $routes->post('batalrekomdis', 'RekomkadisController::batalrekomdis');
});


$routes->get('file/rekomkadis/(:segment)', 'FileController::viewRekomkadis/$1');


// Route untuk halaman Kirim Berkas ke BKPSDM
$routes->get('/berkasbkpsdm', 'BerkasBKPSDMController::index', ['filter' => 'auth']);
$routes->post('/berkasbkpsdm/kirim', 'BerkasBKPSDMController::kirimKeBKPSDM');


$routes->group('skmutasi', function ($routes) {
    $routes->get('/', 'SkMutasiController::index'); // Tampilan utama
    $routes->post('upload', 'SkMutasiController::upload'); // Simpan SK Mutasi (tabel kiri)
    $routes->post('update', 'SkMutasiController::update'); // Update SK Mutasi (tabel kanan)
    $routes->get('delete/(:num)', 'SkMutasiController::delete/$1'); // Hapus SK Mutasi
});
$routes->get('file/skmutasi/(:segment)', 'FileController::viewSkMutasi/$1');


// Routing untuk Menu
$routes->get('/usulan', 'UsulanController::index', ['filter' => 'auth']);
$routes->get('/pengiriman', 'PengirimanController::index', ['filter' => 'auth']);
$routes->get('/proses-dinas', 'ProsesDinasController::index', ['filter' => 'auth']);
//$routes->get('/lacak-status', 'LacakStatusController::index', ['filter' => 'auth']);

// Routes untuk Auth (Login & Logout)
$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');
$routes->get('/log_aktivitas', 'LogAktivitasController::index');

$routes->get('/auth/authenticate', function() {
    return redirect()->to('/login');
});

$routes->get('/lacak-mutasi', 'LacakUsulanController::index');
$routes->post('/lacak-mutasi/search', 'LacakUsulanController::search');
// 🔹 Rute untuk mengunduh SK Mutasi / Nota Dinas (Status 07)
$routes->get('/lacak-mutasi/download/sk/(:any)/(:any)', 'LacakUsulanController::downloadSK/$1/$2');

// 🔹 Rute untuk mengunduh Rekomendasi Kadis (Status 05)
$routes->get('/lacak-mutasi/download/rekom/(:any)/(:any)', 'LacakUsulanController::downloadRekomKadis/$1/$2');

// 🔹 Rute untuk mengunduh Dokumen Rekomendasi dari Pengiriman Usulan (Status 02)
$routes->get('/lacak-mutasi/download/dokumen/(:any)/(:any)', 'LacakUsulanController::downloadDokumenRekom/$1/$2');




// Catch-all untuk halaman yang tidak ditemukan (opsional)
$routes->set404Override();
