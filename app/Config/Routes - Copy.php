<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');

// Dashboard route dengan proteksi middleware
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Routes untuk Cabdin Management
$routes->get('/cabang-dinas', 'CabangDinasController::index');
$routes->get('/cabang-dinas/create', 'CabangDinasController::create');
$routes->post('/cabang-dinas/store', 'CabangDinasController::store');
$routes->get('/cabang-dinas/edit/(:num)', 'CabangDinasController::edit/$1');
$routes->post('/cabang-dinas/update/(:num)', 'CabangDinasController::update/$1');
$routes->get('/cabang-dinas/delete/(:num)', 'CabangDinasController::delete/$1');


// Routes untuk User Management
$routes->group('users', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('usulan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UsulanController::index');
    $routes->get('create', 'UsulanController::create');
    $routes->post('store', 'UsulanController::store');
    $routes->get('edit/(:num)', 'UsulanController::edit/$1');
    $routes->post('update/(:num)', 'UsulanController::update/$1');
    $routes->get('delete/(:num)', 'UsulanController::delete/$1');
});


// Routing untuk Menu
$routes->get('/usulan', 'UsulanController::index', ['filter' => 'auth']);
$routes->get('/pengiriman', 'PengirimanController::index', ['filter' => 'auth']);
$routes->get('/proses-dinas', 'ProsesDinasController::index', ['filter' => 'auth']);
$routes->get('/lacak-status', 'LacakStatusController::index', ['filter' => 'auth']);


// Routes untuk Auth (Login & Logout)
$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

// Catch-all untuk halaman yang tidak ditemukan (opsional)
$routes->set404Override();
