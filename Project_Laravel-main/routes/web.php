<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages_Controller;
// ------------------------------------------------------------------------
use App\Http\Controllers\Data_Pakaian_Controller;
use App\Http\Controllers\Data_Pembelian_Controller;
use App\Http\Controllers\Detail_Pembelian_Controller;
use App\Http\Controllers\Kategori_Pakaian_Controller;
use App\Http\Controllers\Metode_Pembayaran_Controller;
use App\Http\Controllers\Review_Pakaian_Controller;
use App\Http\Controllers\Cart_Controller;
use App\Http\Controllers\User_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/login', [Pages_Controller::class, 'loginPage'])->name('login');

Route::post('/login', [User_Controller::class, 'login'])->name('user.login');

Route::get('/register', [Pages_Controller::class, 'registerPage'])->name('register');

Route::post('/register', [User_Controller::class, 'register'])->name('user.register');

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/dashboard', [Pages_Controller::class, 'dashboardPage'])->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/search', [Pages_Controller::class, 'searchPage'])->name('search');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/detail/{pakaian_id}', [Pages_Controller::class, 'detailPage'])->name('detail');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::post('/add-to-cart', [Cart_Controller::class, 'addToCart'])->name('cart.add');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::post('/remove-from-cart',  [Cart_Controller::class, 'removeFromCart'])->name('cart.remove');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/checkout', [Pages_Controller::class, 'checkoutPage'])->name('checkout');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/profil', [Pages_Controller::class, 'profilPage'])->name('profil');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/admin', [Pages_Controller::class, 'adminPage'])->name('admin');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/kategori_pakaian', [Pages_Controller::class, 'kategori_pakaianPage'])->name('kategori_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/data_pakaian', [Pages_Controller::class, 'data_pakaianPage'])->name('data_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/review_pakaian', [Pages_Controller::class, 'review_pakaianPage'])->name('review_pakaian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/data_user', [Pages_Controller::class, 'data_userPage'])->name('data_user');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/metode_pembayaran', [Pages_Controller::class, 'metode_pembayaranPage'])->name('metode_pembayaran');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/data_pembelian', [Pages_Controller::class, 'data_pembelianPage'])->name('data_pembelian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/detail_pembelian', [Pages_Controller::class, 'detail_pembelianPage'])->name('detail_pembelian');
});

//* kategori_pakaian =================================================================

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/create_kategori_pakaian', [Kategori_Pakaian_Controller::class, 'createKategori_Pakaian'])->name('create_kategori_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::post('/create_kategori_pakaian', [Kategori_Pakaian_Controller::class, 'create'])->name('action.create_kategori_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/update_kategori_pakaian/{kategori_pakaian_id}', [Kategori_Pakaian_Controller::class, 'updateKategori_Pakaian'])->name('update_kategori_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::patch('/kategori_pakaian/{kategori_pakaian_id}', [Kategori_Pakaian_Controller::class, 'update'])->name('kategori_pakaian.update');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::delete('/kategori_pakaian/{kategori_pakaian_id}', [Kategori_Pakaian_Controller::class, 'delete'])->name('kategori_pakaian.delete');
});

//* data_pakaian =================================================================

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/create_data_pakaian', [Data_Pakaian_Controller::class, 'createData_Pakaian'])->name('create_data_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::post('/create_data_pakaian', [Data_Pakaian_Controller::class, 'create'])->name('action.create_data_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/update_data_pakaian/{pakaian_id}', [Data_Pakaian_Controller::class, 'updateData_Pakaian'])->name('update_data_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::patch('/data_pakaian/{pakaian_id}', [Data_Pakaian_Controller::class, 'update'])->name('data_pakaian.update');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::delete('/data_pakaian/{pakaian_id}', [Data_Pakaian_Controller::class, 'delete'])->name('data_pakaian.delete');
});

//* review_pakaian =================================================================

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/create_review_pakaian', [Review_Pakaian_Controller::class, 'createReview_Pakaian'])->name('create_review_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::post('/create_review_pakaian', [Review_Pakaian_Controller::class, 'create'])->name('action.create_review_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/update_review_pakaian/{review_id}', [Review_Pakaian_Controller::class, 'updateReview_Pakaian'])->name('update_review_pakaian');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::patch('/review_pakaian/{review_id}', [Review_Pakaian_Controller::class, 'update'])->name('review_pakaian.update');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::delete('/review_pakaian/{review_id}', [Review_Pakaian_Controller::class, 'delete'])->name('review_pakaian.delete');
});

//* data_user =================================================================

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/create_data_user', [User_Controller::class, 'createData_User'])->name('create_data_user');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::post('/create_data_user', [User_Controller::class, 'create'])->name('action.create_data_user');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::get('/update_data_user/{user_id}', [User_Controller::class, 'updateData_User'])->name('update_data_user');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::patch('/data_user/{user_id}', [User_Controller::class, 'update'])->name('data_user.update');
});

Route::group(['middleware' => ['auth', 'role', 'akses:admin']], function () {
    Route::delete('/data_user/{user_id}', [User_Controller::class, 'delete'])->name('data_user.delete');
});

Route::patch('/data_user/{id}/update_profile', [User_Controller::class, 'upload_profile'])->name('action.upload_profile');

//* metode_pembayaran =================================================================

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/create_metode_pembayaran', [Metode_Pembayaran_Controller::class, 'createMetode_Pembayaran'])->name('create_metode_pembayaran');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::post('/create_metode_pembayaran', [Metode_Pembayaran_Controller::class, 'create'])->name('action.create_metode_pembayaran');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/update_metode_pembayaran/{metode_pembayaran_id}', [Metode_Pembayaran_Controller::class, 'updateMetode_Pembayaran'])->name('update_metode_pembayaran');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::patch('/metode_pembayaran/{metode_pembayaran_id}', [Metode_Pembayaran_Controller::class, 'update'])->name('metode_pembayaran.update');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::delete('/metode_pembayaran/{metode_pembayaran_id}', [Metode_Pembayaran_Controller::class, 'delete'])->name('metode_pembayaran.delete');
});

//* data_pembelian =================================================================

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/create_data_pembelian', [Data_Pembelian_Controller::class, 'createData_Pembelian'])->name('create_data_pembelian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::post('/create_data_pembelian', [Data_Pembelian_Controller::class, 'create'])->name('action.create_data_pembelian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/update_data_pembelian/{pembelian_id}', [Data_Pembelian_Controller::class, 'updateData_Pembelian'])->name('update_data_pembelian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::patch('/data_pembelian/{pembelian_id}', [Data_Pembelian_Controller::class, 'update'])->name('data_pembelian.update');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::delete('/data_pembelian/{pembelian_id}', [Data_Pembelian_Controller::class, 'delete'])->name('data_pembelian.delete');
});

//* detail_pembelian =================================================================

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/create_detail_pembelian', [Detail_Pembelian_Controller::class, 'createDetail_Pembelian'])->name('create_detail_pembelian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::post('/create_detail_pembelian', [Detail_Pembelian_Controller::class, 'create'])->name('action.create_detail_pembelian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/update_detail_pembelian/{detail_pembelian_id}', [Detail_Pembelian_Controller::class, 'updateDetail_Pembelian'])->name('update_detail_pembelian');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::patch('/detail_pembelian/{detail_pembelian_id}', [Detail_Pembelian_Controller::class, 'update'])->name('detail_pembelian.update');
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::delete('/detail_pembelian/{detail_pembelian_id}', [Detail_Pembelian_Controller::class, 'delete'])->name('detail_pembelian.delete');
});