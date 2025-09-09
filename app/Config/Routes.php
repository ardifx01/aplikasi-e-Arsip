<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
//login
$routes->get('/login', 'LoginController::index');
$routes->post('/login/get_login', 'LoginController::get_login');
$routes->get('/login/logout', 'LoginController::logout');
//dashboard
$routes->get('/dashboard', 'DashboardController::index');
//pengguna
$routes->get('/pengguna', 'PenggunaController::index');
$routes->get('pengguna/getData', 'PenggunaController::getData');
$routes->post('pengguna/insert_data', 'PenggunaController::insert_data');
$routes->post('pengguna/del_data', 'PenggunaController::del_data');
$routes->post('pengguna/reset_data', 'PenggunaController::reset_data');
$routes->get('pengguna/get_edit', 'PenggunaController::get_edit');
$routes->post('pengguna/update_data', 'PenggunaController::update_data');
//unit
$routes->get('/unit', 'UnitController::index');
$routes->get('unit/getData', 'UnitController::getData');
$routes->post('unit/insert_data', 'UnitController::insert_data');
$routes->post('unit/del_data', 'UnitController::del_data');
$routes->post('unit/update_data', 'UnitController::update_data');
$routes->get('unit/get_edit', 'UnitController::get_edit');
//jenis
$routes->get('/jenis', 'JenisController::index');
$routes->get('jenis/getData', 'JenisController::getData');
$routes->post('jenis/insert_data', 'JenisController::insert_data');
$routes->post('jenis/del_data', 'JenisController::del_data');
$routes->post('jenis/update_data', 'JenisController::update_data');
$routes->get('jenis/get_edit', 'JenisController::get_edit');
// sifat
$routes->get('/sifat', 'SifatController::index');
$routes->get('sifat/getData', 'SifatController::getData');
$routes->post('sifat/insert_data', 'SifatController::insert_data');
$routes->post('sifat/del_data', 'SifatController::del_data');
$routes->post('sifat/update_data', 'SifatController::update_data');
$routes->get('sifat/get_edit', 'SifatController::get_edit');
// klasifikasi
$routes->get('/klasifikasi', 'KlasifikasiController::index');
$routes->get('klasifikasi/getData', 'KlasifikasiController::getData');
$routes->post('klasifikasi/insert_data', 'KlasifikasiController::insert_data');
$routes->post('klasifikasi/del_data', 'KlasifikasiController::del_data');
$routes->post('klasifikasi/update_data', 'KlasifikasiController::update_data');
$routes->get('klasifikasi/get_edit', 'KlasifikasiController::get_edit');
// surat masuk
//pegajuan surat masuk
$routes->get('/pengajuansuratmasuk', 'SuratMasukController::index');
$routes->get('/pengajuansuratmasuk/getData', 'SuratMasukController::getData');
$routes->post('/pengajuansuratmasuk/verifikasiSurat', 'SuratMasukController::verifikasiSurat');
$routes->get('pengajuansuratmasuk/getNotifications', 'SuratMasukController::getNotifications');
// verifikasi surat masuk
$routes->get('/verifikasisuratmasuk', 'SuratMasukController::verifikasiView');
$routes->get('verifikasisuratmasuk/getData', 'SuratMasukController::getDataVerifikasi');
$routes->post('verifikasisuratmasuk/setujuiSurat', 'SuratMasukController::setujuiSurat');
// CUD
$routes->post('suratmasukpengajuan/insert_data', 'SuratMasukController::insert_data');
$routes->post('suratmasuk/del_data', 'SuratMasukController::del_data');
$routes->post('suratmasuk/update_data', 'SuratMasukController::update_data');
$routes->get('suratmasuk/get_edit', 'SuratMasukController::get_edit');
$routes->post('suratmasukpengajuan/update_data', 'SuratMasukController::update_data');
// surat keluar
$routes->get('/pengajuansuratkeluar', 'SuratKeluarController::index');
$routes->get('/pengajuansuratkeluar/getData', 'SuratKeluarController::getData');
$routes->post('/pengajuansuratkeluar/verifikasiSurat', 'SuratKeluarController::verifikasiSurat');
$routes->get('pengajuansuratkeluar/getNotifications', 'SuratKeluarController::getNotifications');
// verifikasi surat keluar
$routes->get('/verifikasisuratkeluar', 'SuratKeluarController::verifikasiView');
$routes->get('verifikasisuratkeluar/getData', 'SuratKeluarController::getDataVerifikasi');
$routes->post('verifikasisuratkeluar/setujuiSurat', 'SuratKeluarController::setujuiSurat');
// CUD
$routes->post('suratkeluarpengajuan/insert_data', 'SuratKeluarController::insert_data');
$routes->post('suratkeluar/del_data', 'SuratKeluarController::del_data');
$routes->post('suratkeluar/update_data', 'SuratKeluarController::update_data');
$routes->get('suratkeluar/get_edit', 'SuratKeluarController::get_edit');
$routes->post('suratkeluarpengajuan/update_data', 'SuratKeluarController::update_data');
//laporan
$routes->get('laporan/suratmasuk', 'LaporanController::suratMasuk');
$routes->get('laporan/suratkeluar', 'LaporanController::suratKeluar');
$routes->get('laporan/getSuratMasukByUnit', 'LaporanController::getSuratMasukByUnit');
$routes->get('laporan/getSuratKeluarByUnit', 'LaporanController::getSuratKeluarByUnit');
//akun
$routes->get('/akun', 'AkunController::index');
$routes->post('akun/updatePassword', 'AkunController::updatePassword');