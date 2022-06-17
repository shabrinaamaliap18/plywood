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
Route::livewire('/notapdf/pdf/{id}', 'notapdf')->name('notapdf');
Route::livewire('/detailcustom', 'detail-custom')->name('detailcustom');

Route::middleware(['auth'])->group(function() {
    Route::livewire('/historyc', 'history-c')->name('historyc');
    Route::livewire('/historyy', 'historyy')->name('historyy');
});

Route::middleware('auth.admin')->group(function() {
    //DASHBOARD
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('/dashboard', 'Admin\DashboardController');

    //CATEGORI
    Route::get('/categories/edit/{id}', 'Admin\CategoriController@edit');
    Route::put('/categories/update/{id}', 'Admin\CategoriController@update');
    Route::get('/categories/tambah', 'Admin\CategoriController@tambah');
    Route::get('/categories/hapus/{id}', 'Admin\CategoriController@delete');
    Route::get('/categories/cari', 'Admin\CategoriController@cari');
    Route::get('/categories/trash', 'Admin\CategoriController@trash');
    Route::get('/categories/kembalikan/{id}', 'Admin\CategoriController@kembalikan');
    Route::get('/categories/kembalikan_semua', 'Admin\CategoriController@kembalikan_semua');
    Route::get('/categories/hapus_permanen/{id}', 'Admin\CategoriController@hapus_permanen');
    Route::get('/categories/hapus_permanen_semua', 'Admin\CategoriController@hapus_permanen_semua');
    Route::resource('/categories', 'Admin\CategoriController');
    //BATAS CATEGORI


    //PESANAN
    Route::get('/pesanan/edit/{id}', 'Admin\PesananController@edit');
    Route::patch('/pesanan/update/{id}', 'Admin\PesananController@update');
    Route::get('/pesanan/editbayar/{id}', 'Admin\PesananController@editbayar');
    Route::patch('/pesanan/updatebayar/{id}', 'Admin\PesananController@updatebayar');
    Route::get('/pesanan/bayar', 'Admin\PesananController@bayar');
    Route::get('/pesanan/hapus/{id}', 'Admin\PesananController@delete');
    Route::resource('/pesanan', 'Admin\PesananController');
    //BATAS PESANAN

    //CUSTOM
    Route::get('/customm/edit/{id}', 'Admin\AdminCustomController@edit');
    Route::get('/customm/editbayar/{id}', 'Admin\AdminCustomController@editbayar');
    Route::patch('/customm/update/{id}', 'Admin\AdminCustomController@update');
    Route::patch('/customm/updatebayar/{id}', 'Admin\AdminCustomController@updatebayar');
    Route::get('/customm/bayar', 'Admin\AdminCustomController@bayar');
    Route::get('/customm/hapus/{id}', 'Admin\AdminCustomController@delete');
    Route::resource('/customm', 'Admin\AdminCustomController');
    //BATAS CUSTOM

    //REKAP LAPORAN
    Route::post('/rekap/date', 'Admin\RekapLaporanController@search');
    Route::resource('/rekap', 'Admin\RekapLaporanController');
    //BATAS REKAP LAPORAN

    //CUSTOMER
    Route::get('/customer/hapus/{id}', 'Admin\UserCustomerController@delete');
    Route::resource('/customer', 'Admin\UserCustomerController');
    //CUSTOMER

    //MATERIAL
    Route::get('/material/edit/{id}', 'Admin\MaterialController@edit');
    Route::put('/material/update/{id}', 'Admin\MaterialController@update');
    Route::get('/material/tambah', 'Admin\MaterialController@tambah');
    Route::get('/material/hapus/{id}', 'Admin\MaterialController@delete');
    Route::resource('/material', 'Admin\MaterialController');
    //BATAS MATERIAL

    //PRODUK
    Route::get('/produk/edit/{id}', 'Admin\ProductController@edit');
    Route::put('/produk/update/{id}', 'Admin\ProductController@update');
    Route::get('/produk/tambah', 'Admin\ProductController@tambah');
    Route::get('/produk/hapus/{id}', 'Admin\ProductController@delete');
    Route::resource('/produk', 'Admin\ProductController');
    //BATAS PRODUK

    //USER ADMIN
    Route::get('/admin/edit/{id}', 'Admin\UserAdminController@edit');
    Route::put('/admin/update/{id}', 'Admin\UserAdminController@update');
    Route::put('/admin/update/{id}', 'Admin\UserAdminController@update');
    Route::get('/admin/tambah', 'Admin\UserAdminController@tambah');
    Route::get('/admin/hapus/{id}', 'Admin\UserAdminController@delete');
    Route::resource('/admin', 'Admin\UserAdminController');
    //USER ADMIN

    //USER CUSTOMER
    // Route::get('/customer/edit/{id}', 'Admin\UserCustomerController@edit');
    // Route::put('/customer/update/{id}', 'Admin\UserCustomerController@update');
    // Route::get('/customer/tambah', 'Admin\UserCustomerController@tambah');
    // Route::get('/customer/hapus/{id}', 'Admin\UserCustomerController@delete');
    // Route::resource('/customer', 'Admin\UserCustomerController');
    //USER CUSTOMER

    //ONGKIR
    Route::get('/ongkir/edit/{id}', 'Admin\OngkirController@edit');
    Route::put('/ongkir/update/{id}', 'Admin\OngkirController@update');
    Route::get('/ongkir/tambah', 'Admin\OngkirController@tambah');
    Route::get('/ongkir/hapus/{id}', 'Admin\OngkirController@delete');
    Route::resource('/ongkir', 'Admin\OngkirController');
    //ONGKIR

    //UKURAN
    Route::get('/ukuran/edit/{id}', 'Admin\UkuranController@edit');
    Route::put('/ukuran/update/{id}', 'Admin\UkuranController@update');
    Route::get('/ukuran/tambah', 'Admin\UkuranController@tambah');
    Route::get('/ukuran/hapus/{id}', 'Admin\UkuranController@delete');
    Route::resource('/ukuran', 'Admin\UkuranController');
    //UKURAN
});
