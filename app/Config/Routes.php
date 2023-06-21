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
$routes->setDefaultController('Karyawan');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->post('/karyawan/asset/save', 'KaryawanController::saveAsset');
$routes->get('/karyawan/asset/edit/(:num)', 'KaryawanController::editAsset/$1');
$routes->put('/karyawan/updateAsset/(:segment)', 'KaryawanController::updateAsset/$1');
$routes->post('/karyawan/deleteAsset/(:segment)', 'KaryawanController::deleteAsset/$1');

$routes->post('/karyawan/peminjaman/save', 'KaryawanController::savePeminjaman');
$routes->get('/karyawan/peminjaman/edit/(:num)', 'KaryawanController::editPeminjaman/$1');
$routes->put('/karyawan/updatePeminjaman/(:segment)', 'KaryawanController::updatePeminjaman/$1');
$routes->post('/karyawan/deletePeminjaman/(:segment)', 'KaryawanController::deletePeminjaman/$1');

$routes->post('/karyawan/tracking/save', 'KaryawanController::saveTracking');
$routes->get('/karyawan/tracking/edit/(:num)', 'KaryawanController::editTracking/$1');
$routes->put('/karyawan/updateTracking/(:segment)', 'KaryawanController::updateTracking/$1');
$routes->post('/karyawan/deleteTracking/(:segment)', 'KaryawanController::deleteTracking/$1');

$routes->post('/karyawan/investasi/simpanInvestasi', 'KaryawanController::simpanInvestasi');
$routes->get('/karyawan/investasi/edit/(:num)', 'KaryawanController::editInvestasi/$1');
$routes->put('/karyawan/investasi/updateInvestasi/(:segment)', 'KaryawanController::updateInvestasi/$1');
$routes->post('/karyawan/investasi/deleteInvestasi/(:segment)', 'KaryawanController::deleteInvestasi/$1');

$routes->post('/karyawan/upload', 'KaryawanController::upload');

$routes->post('/KaryawanController/saveUser', 'KaryawanController::saveUser');
$routes->get('/KaryawanController/editUser/(:num)', 'KaryawanController::editUser/$1');
$routes->post('/KaryawanController/updateUser/(:segment)', 'KaryawanController::updateUser/$1');
$routes->post('/KaryawanController/deleteUser/(:segment)', 'KaryawanController::deleteUser/$1');

$routes->get('/export', 'AssetController::exportToExcel');
$routes->get('/peminjaman/export', 'PeminjamanController::exportToExcel');
$routes->get('/pengaduan/exportToExcel', 'PengaduanController::exportToExcel');
$routes->get('TrackingController/export', 'TrackingController::exportToExcel');
$routes->get('investasi/export', 'InvestasiController::export');

$routes->post('/pengaduan', 'KaryawanController::savePengaduan');
$route['KaryawanController/deletePengaduan/(:any)'] = 'KaryawanController/deletePengaduan/$1';
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
$routes->get('/', 'Menu::index');
$routes->get('/pengaduan', 'PengaduanUser::index',['filter'=> 'pengaduanFilters']);
$routes->get('/karyawan', 'KaryawanController::index',['filter'=> 'karyawanFilters']);

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
