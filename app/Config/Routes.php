<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login/get_login', 'LoginController::get_login');
$routes->get('/login/logout', 'LoginController::logout');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/pengguna', 'PenggunaController::index');
$routes->get('pengguna/getData', 'PenggunaController::getData');
$routes->post('pengguna/insert_data', 'PenggunaController::insert_data');
$routes->post('pengguna/del_data', 'PenggunaController::del_data');
$routes->post('pengguna/reset_data', 'PenggunaController::reset_data');
$routes->get('pengguna/get_edit', 'PenggunaController::get_edit');
$routes->post('pengguna/update_data', 'PenggunaController::update_data');
