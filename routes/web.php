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

Route::get('/login', 'PhotoController@indexlogin')->name('login');

Route::group(['middleware' => ['auth', 'checkRole:user,admin,superadmin']], function () {
    Route::get('/dashboard', 'DashboardController@index');
});

Route::group(['middleware' => ['auth', 'checkRole:user']], function () {
    Route::get('/myprofile', 'AkunController@myprofile');
    Route::get('/changemyprofile', 'AkunController@indexmyprofile');
    Route::put('/changemyprofile/update', 'AkunController@updatemyprofile');
    Route::get('/changepassword', 'UsersController@IndexPassword');

    Route::put('/changepassword/update', 'UsersController@UpdatePassword');

    Route::get('/transaksi', 'OrderController@indextransaksi');
    Route::get('/cart', 'CartController@index');
    Route::post('/cart/addproduk', 'CartController@addprodukcart');
    Route::post('/ordercart/{id}', 'CartController@indexcart');
    Route::get('/clearcart', 'CartController@deletecart');
    Route::get('/clearcartitem/{id}', 'CartController@deletecartitem');
    Route::get('/allproduk', 'ProdukController@indexproduk');
    Route::get('/pesanan', 'OrderController@indexpesanan');
    Route::get('/chatbot', 'ChatbotController@index');
    Route::post('/chatbot/chat', 'ChatbotController@chatbotchat');
    Route::get('/Dpesanan/{id}', 'OrderController@Dpesanan');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/users', 'UsersController@index');
    Route::post('/users/create', 'UsersController@create');
    Route::get('/users/{id}', 'UsersController@edit');
    Route::put('/users/update', 'UsersController@update');
    Route::get('/users/hapus/{id}', 'UsersController@delete');

    Route::get('/produk', 'ProdukController@index');
    Route::post('/produk/create', 'ProdukController@create');
    Route::post('/photo/create', 'PhotoController@create');

    Route::get('/produk/{id}', 'ProdukController@edit');
    Route::put('/produk/update', 'ProdukController@update');
    Route::get('/produk/hapus/{id}', 'ProdukController@delete');
    Route::get('/photoproduk/{id}', 'ProdukController@photoproduk');
    Route::get('/photoproduk/hapus/{id}', 'PhotoController@delete');

    Route::get('/users/biodata/{id}', 'AkunController@biodata');
    Route::get('/users/biodata/{id}/edit', 'AkunController@edit');
    Route::put('/users/biodata/update', 'AkunController@update');


    Route::get('/tambahstok', 'TambahstokController@indextambahstok');
    Route::post('/tambahstok/create', 'TambahstokController@create');
    Route::get('/tambahstok/hapus/{id}', 'TambahstokController@delete');
    Route::get('/detailpesanan/{id}', 'OrderController@orderdetailpesanan');
    Route::get('/indexorder', 'OrderController@indexorder');

    Route::get('/updatetosd/{id}', 'OrderController@updatetosd');
    Route::get('/updatetops/{id}', 'OrderController@updatetops');
});

Route::group(['middleware' => ['auth', 'checkRole:superadmin']], function () {
    Route::get('/superadmin_users', 'UsersController@indexsuperadmin');
    Route::post('/superadmin_users/create', 'UsersController@createsuperadmin');
    Route::get('/superadmin_users/biodata/{id}', 'AkunController@getdatabyid');
    Route::put('/superadmin_users/biodata/update', 'AkunController@updatesuperadmin');
    Route::get('/superadmin_users/{id}', 'UsersController@getdatabyid');
    Route::put('/superadmin_users/update', 'UsersController@updatesuperadmin');
    Route::get('/superadmin_users/{id}/delete', 'UsersController@deletesuperadmin');

    Route::get('/superadmin_biodata/{id}', 'AkunController@biodatasuperadmin');
    Route::get('/superadmin_biodata/{id}/edit', 'AkunController@editsuperadmin');
    Route::put('/superadmin_biodata/{id}/update', 'AkunController@updatesuperadmin');

    Route::get('/superadmin_produk', 'ProdukController@indexsuperadmin');
    Route::get('/superadmin_tambahstok', 'TambahstokController@indexsuperadmin');
    Route::get('/superadmin_Prosess_NLP', 'KalimatController@indexProsessNLP');

    Route::get('/superadmin_aturan', 'AturanController@index');
    Route::post('/superadmin_aturan/create', 'AturanController@create');
    Route::get('/superadmin_aturan/{id}', 'AturanController@getdatabyid');
    Route::put('/superadmin_aturan/update', 'AturanController@update');
    Route::get('/superadmin_aturan/{id}/delete', 'AturanController@delete');

    Route::get('/superadmin_bahasaalami', 'BahasaalamiController@index');
    Route::post('/superadmin_bahasaalami/create', 'BahasaalamiController@create');
    Route::get('/superadmin_bahasaalami/{id}', 'BahasaalamiController@getdatabyid');
    Route::put('/superadmin_bahasaalami/update', 'BahasaalamiController@update');
    Route::get('/superadmin_bahasaalami/{id}/delete', 'BahasaalamiController@delete');

    Route::get('/superadmin_datasetchatbot', 'ChatbotController@indexsuperadmin');
    Route::post('/superadmin_datasetchatbot/create', 'ChatbotController@create');
    Route::get('/superadmin_datasetchatbot/{id}', 'ChatbotController@getdatabyid');
    Route::put('/superadmin_datasetchatbot/update', 'ChatbotController@update');
    Route::get('/superadmin_datasetchatbot/{id}/delete', 'ChatbotController@delete');
});
