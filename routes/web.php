<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});



Auth::routes();

Route::post('/custom', 'CustomController@masukcustom');
Route::get('/notapdf/{id}', 'NotapdfController@pdf');
Route::get('/notacustom/{id}', 'NotaCustomController@pdf');

//DASHBOARD
Route::resource('/dashboard', 'admin\DashboardController');

//CATEGORI
Route::get('/categories/edit/{id}', 'admin\CategoriController@edit');
Route::put('/categories/update/{id}', 'admin\CategoriController@update');
Route::get('/categories/tambah', 'admin\CategoriController@tambah');
Route::get('/categories/hapus/{id}', 'admin\CategoriController@delete');
Route::get('/categories/cari', 'admin\CategoriController@cari');
Route::get('/categories/trash', 'admin\CategoriController@trash');
Route::get('/categories/kembalikan/{id}', 'admin\CategoriController@kembalikan');
Route::get('/categories/kembalikan_semua', 'admin\CategoriController@kembalikan_semua');
Route::get('/categories/hapus_permanen/{id}', 'admin\CategoriController@hapus_permanen');
Route::get('/categories/hapus_permanen_semua', 'admin\CategoriController@hapus_permanen_semua');
Route::resource('/categories', 'admin\CategoriController');
//BATAS CATEGORI


//PESANAN
Route::get('/pesanan/edit/{id}', 'admin\PesananController@edit');
Route::patch('/pesanan/update/{id}', 'admin\PesananController@update');
Route::get('/pesanan/editbayar/{id}', 'admin\PesananController@editbayar');
Route::patch('/pesanan/updatebayar/{id}', 'admin\PesananController@updatebayar');
Route::get('/pesanan/bayar', 'admin\PesananController@bayar');
Route::get('/pesanan/hapus/{id}', 'admin\PesananController@delete');
Route::resource('/pesanan', 'admin\PesananController');
//BATAS PESANAN

//CUSTOM
Route::get('/customm/edit/{id}', 'admin\AdminCustomController@edit');
Route::get('/customm/editbayar/{id}', 'admin\AdminCustomController@editbayar');
Route::patch('/customm/update/{id}', 'admin\AdminCustomController@update');
Route::patch('/customm/updatebayar/{id}', 'admin\AdminCustomController@updatebayar');
Route::get('/customm/bayar', 'admin\AdminCustomController@bayar');
Route::get('/customm/hapus/{id}', 'admin\AdminCustomController@delete');
Route::resource('/customm', 'admin\AdminCustomController');
//BATAS CUSTOM

//REKAP LAPORAN
Route::post('/rekap/date', 'admin\RekapLaporanController@search');
Route::resource('/rekap', 'admin\RekapLaporanController');
//BATAS REKAP LAPORAN

//CUSTOMER
Route::get('/customer/hapus/{id}', 'admin\UserCustomerController@delete');
Route::resource('/customer', 'admin\UserCustomerController');
//CUSTOMER

//MATERIAL
Route::get('/material/edit/{id}', 'admin\MaterialController@edit');
Route::put('/material/update/{id}', 'admin\MaterialController@update');
Route::get('/material/tambah', 'admin\MaterialController@tambah');
Route::get('/material/hapus/{id}', 'admin\MaterialController@delete');
Route::resource('/material', 'admin\MaterialController');
//BATAS MATERIAL

//PRODUK
Route::get('/produk/edit/{id}', 'admin\ProductController@edit');
Route::put('/produk/update/{id}', 'admin\ProductController@update');
Route::get('/produk/tambah', 'admin\ProductController@tambah');
Route::get('/produk/hapus/{id}', 'admin\ProductController@delete');
Route::resource('/produk', 'admin\ProductController');
//BATAS PRODUK

//USER ADMIN
Route::get('/admin/edit/{id}', 'admin\UserAdminController@edit');
Route::put('/admin/update/{id}', 'admin\UserAdminController@update');
Route::put('/admin/update/{id}', 'admin\UserAdminController@update');
Route::get('/admin/tambah', 'admin\UserAdminController@tambah');
Route::get('/admin/hapus/{id}', 'admin\UserAdminController@delete');
Route::resource('/admin', 'admin\UserAdminController');
//USER ADMIN

//USER CUSTOMER
// Route::get('/customer/edit/{id}', 'admin\UserCustomerController@edit');
// Route::put('/customer/update/{id}', 'admin\UserCustomerController@update');
// Route::get('/customer/tambah', 'admin\UserCustomerController@tambah');
// Route::get('/customer/hapus/{id}', 'admin\UserCustomerController@delete');
// Route::resource('/customer', 'admin\UserCustomerController');
//USER CUSTOMER

//ONGKIR
Route::get('/ongkir/edit/{id}', 'admin\OngkirController@edit');
Route::put('/ongkir/update/{id}', 'admin\OngkirController@update');
Route::get('/ongkir/tambah', 'admin\OngkirController@tambah');
Route::get('/ongkir/hapus/{id}', 'admin\OngkirController@delete');
Route::resource('/ongkir', 'admin\OngkirController');
//ONGKIR

//UKURAN
Route::get('/ukuran/edit/{id}', 'admin\UkuranController@edit');
Route::put('/ukuran/update/{id}', 'admin\UkuranController@update');
Route::get('/ukuran/tambah', 'admin\UkuranController@tambah');
Route::get('/ukuran/hapus/{id}', 'admin\UkuranController@delete');
Route::resource('/ukuran', 'admin\UkuranController');
//UKURAN



Route::get('dashboard', function () {
    return view('admin.dashboard');
})->middleware('role:admin')->name('dashboard');



Route::livewire('/', 'home')->name('home');
Route::livewire('/products', 'product-index')->name('products');
Route::livewire('/custom', 'custom')->name('custom');
Route::livewire('/products/liga/{ligaId}', 'product-liga')->name('products.liga');
Route::livewire('/products/categories/{categoriId}', 'product-categories')->name('products.categories');
Route::livewire('/products/{id}', 'product-detail')->name('products.detail');
Route::livewire('/keranjang', 'keranjang')->name('keranjang');
Route::livewire('trigger_payment', [Checkout::class, 'tiggerPaymentSuccess']);
Route::livewire('trigger_payment', [DetailCustom::class, 'tiggerPaymentSuccess']);
Route::livewire('/checkout', 'checkout')->name('checkout');
Route::livewire('/historyy', 'historyy')->name('historyy');
Route::livewire('/notapdf/pdf/{id}', 'notapdf')->name('notapdf');
Route::livewire('/detailcustom', 'detail-custom')->name('detailcustom');
Route::livewire('/historyc', 'history-c')->name('historyc');
