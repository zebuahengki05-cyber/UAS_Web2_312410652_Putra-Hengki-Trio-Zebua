<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * @var RouteCollection $routes
 */

// ==========================================
// 1. RUTE NAVIGASI UTAMA (PUBLIC)
// ==========================================
$routes->get('/', 'Artikel::index');
$routes->get('/artikel', 'Artikel::index');
$routes->get('/about', 'Artikel::about');
$routes->get('/contact', 'Artikel::contact');
$routes->get('/faqs', 'Artikel::faqs');

// ==========================================
// 2. RUTE AUTHENTICATION USER
// ==========================================
$routes->get('/user/login', 'User::login');
$routes->post('/user/login_action', 'User::login_action');
$routes->get('/user/logout', 'User::logout');
$routes->post('auth/login', 'Auth::login');

// ==========================================
// 3. GRUP RUTE ADMIN (DIPROTEKSI FILTER AUTH)
// ==========================================
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->get('artikel/add', 'Artikel::add');
    $routes->post('artikel/insert', 'Artikel::insert');
    $routes->get('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->post('artikel/update/(:num)', 'Artikel::update/$1');
    $routes->get('artikel/delete/(:num)', 'Artikel::delete/$1');
});

// ==========================================
// 4. RUTE API (UNTUK VUEJS - SPA)
// ==========================================

// Rute Login (Tanpa filter auth, karena ini pintu masuknya)
$routes->options('api/login', 'Api\Auth::login');
$routes->post('api/login', 'Api\Auth::login');

// Rute API Artikel (DIBUNGKUS FILTER AUTH)
// Semua rute di dalam group ini WAJIB memiliki token yang valid
$routes->group('artikel', ['filter' => 'auth'], function($routes) {
    $routes->get('get_data_api', 'Artikel::get_data_api');
    $routes->post('tambah_data_api', 'Artikel::insert_data_api');
    $routes->post('insert_data_api', 'Artikel::insert_data_api');
    $routes->post('update_data_api/(:num)', 'Artikel::update_data_api/$1');
    $routes->get('delete_data_api/(:num)', 'Artikel::delete_data_api/$1');
});

// Jika kamu masih perlu akses api/artikel di luar group
// pastikan kamu juga memberikan filter jika memang itu data privat
$routes->get('api/artikel', 'Artikel::get_data_api', ['filter' => 'auth']);

// ==========================================
// 5. RUTE AJAX
// ==========================================
$routes->get('ajax/getData', 'AjaxController::getData');
$routes->post('ajax/insert', 'AjaxController::insert');
$routes->post('ajax/update/(:num)', 'AjaxController::update/$1');
$routes->get('ajax/delete/(:num)', 'AjaxController::delete/$1');