<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . "Config/Routes.php")) {
  require SYSTEMPATH . "Config/Routes.php";
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace("App\Controllers");
// $routes->setDefaultController('Home'); // default
$routes->setDefaultController("Auth");
$routes->setDefaultMethod("index");
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get("/", "Auth::landing");
$routes->get("/daftar", "Auth::daftar");
$routes->post("/daftar", "Auth::daftarProses");
$routes->get("/masuk", "Auth::masuk");
$routes->post("/masuk", "Auth::masukProses");
$routes->get("/keluar", "Auth::keluar", ["filter" => "auth"]);
$routes->get("/kata_sandi/lupa", "Auth::lupaKataSandi");
$routes->post("/kata_sandi/lupa", "Auth::lupaKataSandiProses");
$routes->get("/aktivasi/kirim_ulang", "Auth::aktivasi");
$routes->post("/aktivasi/kirim_ulang", "Auth::aktivasiProses");
$routes->get("/aktivasi/(:segment)/(:num)/", 'Auth::aktivasiAkun/$1/$2');
$routes->addRedirect("/aktivasi", "/beranda");
$routes->addRedirect("/aktivasi/(:any)/", "/beranda");
$routes->get(
  "/kata_sandi/atur_ulang/(:segment)/(:num)/",
  'Auth::aturUlangKataSandi/$1/$2'
);
$routes->post("/kata_sandi/atur_ulang", "Auth::aturUlangKataSandiProses");
// mau pake addRedirect, kayaknya bentrok sama route post
$routes->get("/kata_sandi/atur_ulang", function () {
  return redirect()->to("/kata_sandi/lupa");
});
$routes->addRedirect("/kata_sandi/atur_ulang/(:any)/", "/kata_sandi/lupa");

// Fitur
$routes->get("/beranda", "Pages::beranda", ["filter" => "auth"]);
$routes->get("/materi/([1-6])", "Pages::materi/$1", ["filter" => "auth"]);
$routes->addRedirect("/materi", "/materi/1");
$routes->addRedirect("/materi/(:any)", "/materi/1");
$routes->addRedirect("/pages/materi", "/materi");
$routes->get("/latihan", "Pages::latihan", ["filter" => "auth"]);
$routes->post("/latihan", "Pages::latihanProses", ["filter" => "auth"]);
$routes->get("/latihan/([1-3])", "Pages::latihanSoal/$1", ["filter" => "auth"]);
$routes->post("/latihan/([1-3])", "Pages::latihanSoalProses/$1", [
  "filter" => "auth",
]);
$routes->addRedirect("/latihan/(:any)/", "/latihan");
$routes->addRedirect("/pages/latihan", "/latihan");
$routes->get("/peringkat", "Pages::peringkat", ["filter" => "auth"]);
$routes->addRedirect("/pages/peringkat", "/peringkat");
$routes->get("/kuis", "Pages::kuis", ["filter" => "auth"]);
$routes->post("/kuis", "Pages::kuisPost", ["filter" => "auth"]);
$routes->addRedirect("/pages/kuis", "/kuis");

$routes->get("/profil", "Pages::profil", ["filter" => "auth"]);
$routes->addRedirect("/pages/profil", "/profil");
$routes->get("/ubah_profil", "Pages::ubahProfil", ["filter" => "auth"]);
$routes->post("/ubah_profil", "Pages::ubahProfilProses", ["filter" => "auth"]);
$routes->addRedirect("/pages/ubah_profil", "/ubah_profil");
$routes->get("/ubah_kata_sandi", "Pages::ubahKataSandi", ["filter" => "auth"]);
$routes->post("/ubah_kata_sandi", "Pages::ubahKataSandiProses", [
  "filter" => "auth",
]);
$routes->addRedirect("/pages/ubah_kata_sandi", "/ubah_kata_sandi");

$routes->get("/admin/beranda", "Admin::beranda", ["filter" => "admin"]);
$routes->get("/admin/manajemen", "Admin::manajemen", ["filter" => "admin"]);
$routes->get("/admin/manajemen/detail/(:num)", "Admin::detail/$1", [
  "filter" => "admin",
]);
$routes->get("/admin/manajemen/tambah", "Admin::tambah", ["filter" => "admin"]);
$routes->post("/admin/manajemen/tambah", "Admin::tambahProses", [
  "filter" => "admin",
]);
$routes->get("/admin/manajemen/ubah/(:num)", "Admin::ubah/$1", [
  "filter" => "admin",
]);
$routes->post("/admin/manajemen/ubah/(:num)", "Admin::ubahProses/$1", [
  "filter" => "admin",
]);
$routes->delete("/admin/manajemen/detail/(:num)", 'Admin::hapus/$1', [
  "filter" => "admin",
]);
$routes->get("/admin/rekapitulasi", "Admin::rekapitulasi", ["filter" => "admin"]);
$routes->get("/admin/rekapitulasi/pelajar/pdf", "Admin::rekapitulasiPelajarPdf", ["filter" => "admin"]);
$routes->get("/admin/rekapitulasi/pelajar/excel", "Admin::rekapitulasiPelajarExcel", ["filter" => "admin"]);
$routes->post("/admin/rekapitulasi/import", "Admin::rekapitulasiImport", ["filter" => "admin"]);
$routes->addRedirect("/admin/rekapitulasi/(:any)", "/admin/rekapitulasi");
$routes->get("/admin/masuk", "Admin::masuk");
$routes->post("/admin/masuk", "Admin::masukPost");
$routes->get("/admin/keluar", "Admin::keluar");
$routes->addRedirect("/admin", "/admin/beranda");

/**
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
if (file_exists(APPPATH . "Config/" . ENVIRONMENT . "/Routes.php")) {
  require APPPATH . "Config/" . ENVIRONMENT . "/Routes.php";
}
