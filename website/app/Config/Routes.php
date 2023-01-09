<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//Routes for WEB
//auth
$routes->get('/auth/login', 'Auth\Login::index');
$routes->get('/auth/logout', 'Auth\Login::logout');
$routes->post('/auth/login', 'Auth\Login::execute');
//Master
$routes->get('/', 'Master\Dashboard::index');
$routes->get('/admin/dashboard', 'Master\Dashboard::index');
// start instansi
$routes->get('/admin/instansi', 'Master\Instansi::index');
$routes->get('/admin/instansi/tambah', 'Master\Instansi::tambah');
$routes->post('/admin/instansi/add', 'Master\Instansi::add');
$routes->post('/admin/instansi/edit', 'Master\Instansi::edit');
$routes->get('/admin/instansi/delete/(:num)', 'Master\Instansi::delete/$1');
//end instansi

//start pasien
$routes->get('/admin/pasien', 'Master\Pasien::index');
$routes->get('/admin/pasien/tambah', 'Master\Pasien::tambah');
$routes->get('/admin/pasien/keuangan/(:num)', 'Master\Pasien::keuangan/$1');
$routes->post('/admin/pasien/topup', 'Master\Pasien::topup');
$routes->post('/admin/pasien/add', 'Master\Pasien::add');
$routes->post('/admin/pasien/edit', 'Master\Pasien::edit');
$routes->get('/admin/pasien/delete/(:num)', 'Master\Pasien::delete/$1');
//end pasien
$routes->get('/admin/riwayat_berobat', 'Master\RiwayatBerobat::index');

//start dokter
$routes->get('/admin/dokter', 'Master\Dokter::index');
$routes->get('/admin/dokter/tambah', 'Master\Dokter::tambah');
$routes->post('/admin/dokter/add', 'Master\Dokter::add');
$routes->post('/admin/dokter/edit', 'Master\Dokter::edit');
$routes->get('/admin/dokter/delete/(:num)', 'Master\Dokter::delete/$1');
$routes->get('/admin/dokter/detail_jadwal/(:num)', 'Master\Dokter::detail_jadwal/$1');
$routes->post('/admin/dokter/add_jadwal', 'Master\Dokter::add_jadwal');
$routes->post('/admin/dokter/edit_jadwal', 'Master\Dokter::edit_jadwal');
$routes->get('/admin/dokter/jadwal_delete/(:num)/(:num)', 'Master\Dokter::jadwal_delete/$1/$2');
$routes->get('/admin/dokter/reviews/(:num)', 'Master\Dokter::detail_reviews/$1');
//end dokter

//start verifikasi antrian
$routes->get('/admin/verifikasi_antrian', 'Master\VerifikasiAntrian::index');
$routes->post('/admin/verifikasi_antrian/confirm', 'Master\VerifikasiAntrian::confirm');
$routes->get('/admin/verifikasi_antrian/refund/(:num)', 'Master\VerifikasiAntrian::refund/$1');
//end verifikasi antrian


//calback from duitku
$routes->post('/duitku/callback', 'Callback::callback');


//Routes for API
//routes for auth
$routes->post('/api/v1/auth/login', 'Api\V1\Auth\Login::index');
$routes->post('/api/v1/auth/test', 'Api\V1\Auth\Test::index');
$routes->delete('/api/v1/auth/logout', 'Api\V1\Auth\Login::logout');
$routes->post('/api/v1/auth/refresh', 'Api\V1\Auth\Login::refresh');
$routes->post('/api/v1/auth/register', 'Api\V1\Auth\Register::index');

//routes for profile
$routes->get('/api/v1/profile/pasien', 'Api\V1\Profile\Pasien::index');
$routes->put('/api/v1/profile/pasien', 'Api\V1\Profile\Pasien::update');
$routes->put('/api/v1/profile/pasien/password', 'Api\V1\Profile\Pasien::change_password');

//routes for master
$routes->get('/api/v1/master/dashboard', 'Api\V1\Master\Dashboard::index');
$routes->get('/api/v1/master/dokter', 'Api\V1\Master\Dokter::index');
$routes->get('/api/v1/master/dokter/(:num)', 'Api\V1\Master\Dokter::detail/$1');


//routes for transaction
$routes->get('/api/v1/transaction/invoice', 'Api\V1\Transaction\Invoice::index');
$routes->get('/api/v1/transaction/invoice/(:num)', 'Api\V1\Transaction\Invoice::detail/$1');
$routes->get('/api/v1/transaction/payments', 'Api\V1\Transaction\Payments::index');
$routes->post('/api/v1/transaction/checkout', 'Api\V1\Transaction\Invoice::check_out');
$routes->post('/api/v1/transaction/give_rating', 'Api\V1\Transaction\Invoice::give_rating');


$routes->post('/api/v1/test', 'Api\V1\Test::index');
//$routes->resource('api/v1/auth/login');

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
