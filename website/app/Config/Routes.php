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
$routes->get('auth/login', 'auth\Login::index');
$routes->get('auth/logout', 'auth\Login::logout');
$routes->post('auth/login', 'auth\Login::execute');
//Master
$routes->get('/', 'master\Dashboard::index');
$routes->get('/admin/dashboard', 'master\Dashboard::index');
// start instansi
$routes->get('/admin/instansi', 'master\Instansi::index');
$routes->get('/admin/instansi/tambah', 'master\Instansi::tambah');
$routes->post('/admin/instansi/add', 'master\Instansi::add');
$routes->post('/admin/instansi/edit', 'master\Instansi::edit');
$routes->get('/admin/instansi/delete/(:num)', 'master\Instansi::delete/$1');
//end instansi

//start pasien
$routes->get('/admin/pasien', 'master\Pasien::index');
$routes->get('/admin/pasien/tambah', 'master\Pasien::tambah');
$routes->get('/admin/pasien/keuangan/(:num)', 'master\Pasien::keuangan/$1');
$routes->post('/admin/pasien/topup', 'master\Pasien::topup');
$routes->post('/admin/pasien/add', 'master\Pasien::add');
$routes->post('/admin/pasien/edit', 'master\Pasien::edit');
$routes->get('/admin/pasien/delete/(:num)', 'master\Pasien::delete/$1');
//end pasien
$routes->get('/admin/riwayat_berobat', 'master\RiwayatBerobat::index');

//start dokter
$routes->get('/admin/dokter', 'master\Dokter::index');
$routes->get('/admin/dokter/tambah', 'master\Dokter::tambah');
$routes->post('/admin/dokter/add', 'master\Dokter::add');
$routes->post('/admin/dokter/edit', 'master\Dokter::edit');
$routes->get('/admin/dokter/delete/(:num)', 'master\Dokter::delete/$1');
$routes->get('/admin/dokter/detail_jadwal/(:num)', 'master\Dokter::detail_jadwal/$1');
$routes->post('/admin/dokter/add_jadwal', 'master\Dokter::add_jadwal');
$routes->post('/admin/dokter/edit_jadwal', 'master\Dokter::edit_jadwal');
$routes->get('/admin/dokter/jadwal_delete/(:num)/(:num)', 'master\Dokter::jadwal_delete/$1/$2');
//end dokter



//Routes for API
//routes for auth
$routes->post('/api/v1/auth/login', 'api\v1\auth\Login::index');
$routes->delete('/api/v1/auth/logout', 'api\v1\auth\Login::logout');
$routes->post('/api/v1/auth/refresh', 'api\v1\auth\Login::refresh');
$routes->post('/api/v1/auth/register', 'api\v1\auth\Register::index');

//routes for profile
$routes->get('/api/v1/profile/pasien', 'api\v1\profile\Pasien::index');
$routes->put('/api/v1/profile/pasien', 'api\v1\profile\Pasien::update');
$routes->put('/api/v1/profile/pasien/password', 'api\v1\profile\Pasien::change_password');

//routes for master
$routes->get('/api/v1/master/dashboard', 'api\v1\master\Dashboard::index');
$routes->get('/api/v1/master/dokter', 'api\v1\master\Dokter::index');
$routes->get('/api/v1/master/dokter/(:num)', 'api\v1\master\Dokter::detail/$1');


//routes for transaction
$routes->get('/api/v1/transaction/invoice', 'api\v1\transaction\Invoice::index');
$routes->get('/api/v1/transaction/invoice/(:num)', 'api\v1\transaction\Invoice::detail/$1');
$routes->get('/api/v1/transaction/payments', 'api\v1\transaction\Payments::index');
$routes->post('/api/v1/transaction/checkout', 'api\v1\transaction\Invoice::check_out');
$routes->post('/api/v1/transaction/give_rating', 'api\v1\transaction\Invoice::give_rating');


$routes->post('/api/v1/test', 'api\v1\Test::index');
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
