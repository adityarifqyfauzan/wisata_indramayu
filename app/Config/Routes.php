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
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


// Route untuk API
// $routes->resource('/api', ['controller' => 'Webhook\DialogflowRespond']);
// $routes->get('/api/tempatwisata', 'Webhook\DialogflowRespond::index');
$routes->post('/api/tempatwisata', 'Webhook\DialogflowRespond::index');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('/', function($routes){

	$routes->get('', 'GeneralPages::index');
	$routes->get('tentang', 'GeneralPages::tentang');
	$routes->get('kontak', 'GeneralPages::kontak');
	$routes->get('kuliner', 'GeneralPages::kuliner');
	$routes->get('wisata/(:segment)', 'Wisata::index/$1');
	$routes->get('detail_wisata/(:segment)', 'Wisata::detail/$1');

	$routes->group('pengelola', ['filter' => 'pengelola_loggedin'], function($routes){

		//Route untuk halaman autentikasi pengelola tempat wisata

		$routes->get('registrasi', 'AuthPagesPengelola::registrasi');
		$routes->get('login', 'AuthPagesPengelola::login');
		$routes->get('lupa-password', 'AuthPagesPengelola::lupaPassword');

		$routes->post('registrasi', 'Pengelola\Auth::registrasi');
		$routes->post('login', 'Pengelola\Auth::login');
		$routes->post('lupa-password', 'Pengelola\Auth::lupaPassword');

	});

	$routes->group('pengelola', ['filter' => 'pengelola_auth'], function($routes){

		//Route untuk pengelola ketika sudah berhasil login

		$routes->get('logout', 'Pengelola\Auth::logout');

		//Route untuk menampilkan halaman dashboard
		$routes->get('dashboard', 'Pengelola\Dashboard::index');

		//Route untuk menampilkan halaman konfigurasi akun pengelola
		$routes->get('akun', 'Pengelola\Akun::index');

		//Route untuk memproses pembaruan data pengelola
		$routes->post('perbarui_data', 'Pengelola\Akun::updateAkun');
		
		//Route untuk upload foto utama tempat wisata
		$routes->post('upload_gambar_utama', 'Pengelola\Akun::uploadMainImage');

		//Route untuk menampilkan halaman galeri (bikin dibawah sini) pakai method get ya jangan lupa
		$routes->get('galeri', 'Pengelola\Galeri::index');
		
		//Route untuk memproses upload foto digaleri, pake method post (bikin dibawah sini)
		$routes->post('upload_foto', 'Pengelola\Galeri::uploadFoto');
		
		//Route untuk menghapus foto dari galeri
		$routes->get('hapus_foto_galeri/(:segment)', 'Pengelola\Galeri::hapusFoto/$1');

		//Route untuk setting hari operasional pengelola
		$routes->post('set_waktu_operasional', 'Pengelola\Akun::setHari');
		
		//Route untuk setting jam operasional pengelola
		$routes->post('setJam', 'Pengelola\Akun::setJam');

		//Route untuk mengelola tiket pengelola
		$routes->post('tambah_tiket', 'Pengelola\Tiket::tambahTiket');
		$routes->post('perbarui_tiket', 'Pengelola\Tiket::editTiket');
		$routes->get('hapus_tiket/(:segment)', 'Pengelola\Tiket::hapusTiket/$1');
		
	});

	//Route untuk admin yang sudah login
	$routes->group('admin', ['filter' => 'admin_auth'], function($routes){
		
		//Route untuk logout
		$routes->get('logout', 'Admin\Auth::logout');
		
		//Route untuk menampilkan halaman dashboard
		$routes->get('dashboard','Admin\Dashboard::index');
	
		//Route admin untuk mengelola halaman wisata
		$routes->get('wisata', 'Admin\DataWisata::index');
		$routes->get('wisata/baru', 'Admin\DataWisata::pengajuanBaru');
		$routes->get('wisata/(:segment)', 'Admin\DataWisata::detail/$1');
		
		$routes->get('aktifkan_wisata/(:segment)', 'Admin\DataWisata::aktifkanAkunWisata/$1');
		$routes->get('nonaktif_wisata/(:segment)', 'Admin\DataWisata::nonAktifkanAkunWisata/$1');

		//Route admin untuk mengelola halaman kuliner
		$routes->get('kuliner', 'Admin\Kuliner::index');
		$routes->post('tambah_kuliner', 'Admin\Kuliner::tambahKuliner');
		$routes->post('update_kuliner', 'Admin\Kuliner::editKuliner');
		$routes->get('hapus_kuliner/(:segment)', 'Admin\Kuliner::hapusKuliner/$1');

		//Route admin untuk mengelola halaman kategori wisata
		$routes->get('kategori_wisata', 'Admin\KategoriWisata::index');
		$routes->post('kategori_wisata', 'Admin\KategoriWisata::tambahKategori');
		$routes->post('update_kategori_wisata', 'Admin\KategoriWisata::editKategori');
		$routes->get('hapus_kategori_wisata/(:segment)', 'Admin\KategoriWisata::hapusKategori/$1');

	});

	//Route untuk admin yang belum login
	$routes->group('admin', ['filter' => 'admin_loggedin'], function ($routes)
	{
		//Route untuk autentikasi admin
		$routes->get('login', 'Admin\Auth::login_form');
		$routes->post('auth', 'Admin\Auth::login');
		
	});

});



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}