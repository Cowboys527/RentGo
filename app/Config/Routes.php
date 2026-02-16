<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Welcome page and login/logout
$routes->get('/', 'Home::index'); // welcome page
$routes->get('/login', 'Auth::index');

$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Admin Routes
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

// Transaksi
$routes->get('transaksi', 'Transaksi::index');

});



