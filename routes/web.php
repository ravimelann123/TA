<?php

use App\Http\Middleware\CheckRole;
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
    return redirect('/login');
});

//master.masterlayout

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');
Route::get('/viewall', 'PhotoController@viewall');

Route::get('/login', 'PhotoController@indexlogin')->name('login');

Route::group(['middleware' => ['auth', 'checkRole:user,admin']], function () {
    Route::get('/dashboard', 'DashboardController@index');
});

Route::group(['middleware' => ['auth', 'checkRole:user']], function () {
    Route::get('/myprofile', 'AkunController@myprofile');
    Route::get('/changemyprofile', 'AkunController@indexmyprofile');
    Route::put('/changemyprofile/update', 'AkunController@updatemyprofile');
    Route::get('/changepassword', 'UsersController@IndexPassword');
    Route::put('/changepassword/update', 'UsersController@UpdatePassword');
    Route::get('/order', 'OrderController@index');
    Route::get('/order', 'OrderController@index');
    Route::get('/transaksi', 'OrderController@indextransaksi');
    Route::get('/cart', 'CartController@index');
    Route::post('/cart/addproduk/{id}', 'CartController@addprodukcart');
    Route::post('/ordercart/{id}', 'CartController@indexcart');
    Route::get('/clearcart', 'CartController@deletecart');
    Route::get('/clearcartitem/{id}', 'CartController@deletecartitem');
    Route::get('/allproduk', 'ProdukController@indexproduk');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/users', 'UsersController@index');
    Route::post('/users/create', 'UsersController@create');
    Route::get('/users/edit/{id}', 'UsersController@edit');
    Route::put('/users/update/{id}', 'UsersController@update');
    Route::get('/users/hapus/{id}', 'UsersController@delete');


    Route::get('/produk', 'ProdukController@index');
    Route::post('/produk/create', 'ProdukController@create');
    Route::post('/photo/create', 'PhotoController@create');

    Route::get('/produk/edit/{id}', 'ProdukController@edit');
    Route::put('/produk/update/{id}', 'ProdukController@update');
    Route::get('/produk/hapus/{id}', 'ProdukController@delete');
    Route::get('/photoproduk/{id}', 'ProdukController@photoproduk');
    Route::get('/photoproduk/hapus/{id}', 'PhotoController@delete');

    Route::get('/akun', 'AkunController@index');
    Route::get('/akun/edit/{id}', 'AkunController@edit');
    Route::put('/akun/update/{id}', 'AkunController@update');
    Route::get('/tambahstok', 'TambahstokController@indextambahstok');
    Route::post('/tambahstok/create', 'TambahstokController@create');
    Route::get('/tambahstok/hapus/{id}', 'TambahstokController@delete');
    Route::get('/detailpesanan/{id}', 'OrderController@orderdetailpesanan');
    Route::get('/indexorder', 'OrderController@indexorder');
    Route::get('/orderbd', 'OrderController@orderbd');
    Route::get('/ordersd', 'OrderController@ordersd');
    Route::get('/orderps', 'OrderController@orderps');
    Route::get('/updatetosd/{id}', 'OrderController@updatetosd');
    Route::get('/updatetops/{id}', 'OrderController@updatetops');
});
