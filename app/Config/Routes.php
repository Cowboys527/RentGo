<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Welcome & Auth
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');


$routes->group('admin', function($routes) {

    $routes->get('dashboard', 'Admin::dashboard');

    // Kendaraan
    $routes->get('kendaraan', 'Kendaraan::index');
    $routes->get('kendaraan/tambah', 'Kendaraan::tambah');
    $routes->post('kendaraan/simpan', 'Kendaraan::simpan');
    $routes->get('kendaraan/edit/(:num)', 'Kendaraan::edit/$1');
    $routes->post('kendaraan/update/(:num)', 'Kendaraan::update/$1');
    $routes->get('kendaraan/hapus/(:num)', 'Kendaraan::hapus/$1');

    // User
    $routes->get('user', 'User::index');
    $routes->get('user/tambah', 'User::tambah');
    $routes->post('user/simpan', 'User::simpan');
    $routes->get('user/edit/(:num)', 'User::edit/$1');
    $routes->post('user/update/(:num)', 'User::update/$1');
    $routes->get('user/hapus/(:num)', 'User::hapus/$1');

});


$routes->group('kasir', function($routes){
    $routes->get('dashboard', 'Kasir::dashboard');

    // TRANSAKSI
    $routes->get('transaksi', 'Kasir::transaksi');
    $routes->get('transaksi/tambah', 'Kasir::tambah');

    // STEP 1
    $routes->post('transaksi/simpan', 'Kasir::simpanTransaksi');

    // STEP 2
    $routes->get('transaksi/pembayaran', 'Kasir::pembayaran');
    $routes->post('transaksi/proses', 'Kasir::prosesPembayaran');
    $routes->get('transaksi/batal', 'Kasir::batalPembayaran');

    $routes->get('transaksi/detail/(:num)', 'Kasir::detail/$1');
    $routes->post('transaksi/bayar-sisa/(:num)', 'Kasir::bayarSisa/$1');
    $routes->get('transaksi/struk/(:num)', 'Kasir::struk/$1');
    $routes->get('transaksi/kembalikan/(:num)', 'Kasir::formKembalikan/$1');
    $routes->post('transaksi/kembalikan/proses/(:num)', 'Kasir::prosesKembalikan/$1');

});

$routes->group('owner', function($routes){
    $routes->get('dashboard', 'Owner::dashboard');
    $routes->get('laporan', 'Owner::laporan');
    $routes->get('laporan/export', 'Owner::export');
    $routes->get('log', 'Owner::logActivity');
});