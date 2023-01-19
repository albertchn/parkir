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
$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::auth');
$routes->get('/masuk', 'Kasir::masuk', ['filter' => 'auth']);
$routes->post('/masuk/tambah', 'Kasir::tambahMasuk', ['filter' => 'auth']);
$routes->get('/keluar', 'Kasir::keluar', ['filter' => 'auth']);
$routes->post('/keluar', 'Kasir::keluar', ['filter' => 'auth']);
$routes->post('/keluar', 'Kasir::keluar', ['filter' => 'auth']);
$routes->post('/keluar/bayar', 'Kasir::bayar', ['filter' => 'auth']);
$routes->get('/admin', 'Admin::index', ['filter' => 'admin']);
$routes->get('/admin/kasir', 'Admin::kasir', ['filter' => 'admin']);
$routes->get('/admin/kategori', 'Admin::kategori', ['filter' => 'admin']);
$routes->post('/kategori/update/(:num)', 'Admin::updateKategori/$1', ['filter' => 'admin']);
$routes->post('/kategori/tambah', 'Admin::tambahKategori', ['filter' => 'admin']);
$routes->delete('/kategori/(:num)', 'Admin::hapusKategori/$1', ['filter' => 'admin']);
$routes->post('/kasir/tambah', 'Admin::tambahKasir', ['filter' => 'admin']);
$routes->post('/kasir/status', 'Admin::ubahStatus', ['filter' => 'admin']);
$routes->get('/kasir/edit/(:num)', 'Admin::editKasir/$1', ['filter' => 'admin']);
$routes->post('/kasir/update/(:num)', 'Admin::updateKasir/$1', ['filter' => 'admin']);
$routes->delete('/kasir/(:num)', 'Admin::hapusKasir/$1', ['filter' => 'admin']);
$routes->get('/admin/transaksi', 'Admin::transaksi', ['filter' => 'admin']);
$routes->post('/transaksi/export', 'Admin::exportTransaksi', ['filter' => 'admin']);
$routes->get('/admin/member', 'Admin::member', ['filter' => 'admin']);
$routes->post('/member/tambah', 'Admin::tambahMember', ['filter' => 'admin']);
$routes->post('/member/update/(:num)', 'Admin::updateMember/$1', ['filter' => 'admin']);
$routes->delete('/member/(:num)', 'Admin::hapusMember/$1', ['filter' => 'admin']);
$routes->get('/logout', 'Home::logout', ['filter' => 'auth']);

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
