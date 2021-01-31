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

//Route::get('/login', 'PhotoController@indexlogin')->name('login');

Route::group(['middleware' => ['auth', 'checkRole:user,admin']], function () {
    Route::get('/dashboard', 'DashboardController@index');
});

Route::group(['middleware' => ['auth', 'checkRole:user']], function () {
    Route::get('/plgn/biodata', 'UsersController@myprofile');
    // Route::get('/changemyprofile', 'AkunController@indexmyprofile');
    Route::put('/changemyprofile/update', 'UsersController@updatemyprofile');
    Route::get('/changepassword', 'UsersController@IndexPassword');
    Route::put('/changepassword/update', 'UsersController@UpdatePassword');

    Route::get('/allproduk', 'ProdukController@indexproduk');
    Route::get('/plgn/pesanan', 'OrderController@indexpesanan');
    Route::get('/plgn/chatbot', 'ChatbotController@index');
    Route::post('/chatbot/chat', 'ChatbotController@chatbotchat');
    Route::get('/plgn/pesanan/detail/{id}', 'OrderController@Dpesanan');
    Route::get('/plgn/pesanan/detail/print/{id}', 'OrderController@pdf');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/admin/users', 'UsersController@index');
    Route::post('/users/create', 'UsersController@create');
    Route::get('/users/{id}', 'UsersController@edit');
    Route::put('/users/update', 'UsersController@update');
    Route::get('/users/hapus/{id}', 'UsersController@delete');

    Route::get('/admin/produk', 'ProdukController@index');
    Route::post('/produk/create', 'ProdukController@create');
    // Route::post('/photo/create', 'PhotoController@create');
    Route::get('/produk/{id}', 'ProdukController@edit');
    Route::put('/produk/update', 'ProdukController@update');
    Route::get('/produk/hapus/{id}', 'ProdukController@delete');
    Route::get('/admin/biodata', 'UsersController@myprofileadmin');
    // Route::get('/photoproduk/{id}', 'ProdukController@photoproduk');
    // Route::get('/photoproduk/hapus/{id}', 'PhotoController@delete');
    Route::put('/changepasswordadmin/update', 'UsersController@UpdatePasswordadmin');
    Route::get('/users/biodata/{id}', 'UsersController@biodata');
    Route::get('/users/biodata/{id}/edit', 'UsersController@edit');
    Route::put('/users/biodata/update', 'UsersController@updateusersadmin');

    Route::put('/changemyprofileadmin/update', 'UsersController@updatemyprofile');
    Route::get('/tambahstok', 'TambahstokController@indextambahstok');
    Route::post('/tambahstok/create', 'TambahstokController@create');
    Route::get('/tambahstok/hapus/{id}', 'TambahstokController@delete');
    Route::get('/admin/pesanan/detail/{id}', 'OrderController@orderdetailpesanan');

    Route::get('/admin/pesanan', 'OrderController@indexorder');
    Route::get('/admin/pesananmasuk', 'OrderController@orderin');
    Route::get('/admin/pesanan/detail/print/{id}', 'OrderController@pdf');
    Route::get('/updatetosd/{id}', 'OrderController@updatetosd');
    Route::get('/updatetops/{id}', 'OrderController@updatetops');

    Route::get('/admin/dataset', 'ChatbotController@indexdataset');
    Route::post('/admin/dataset/create', 'ChatbotController@create');
    Route::get('/superadmin_datasetchatbot/{id}', 'ChatbotController@getdatabyid');
    Route::put('/superadmin_datasetchatbot/update', 'ChatbotController@update');
    Route::get('/superadmin_datasetchatbot/{id}/delete', 'ChatbotController@delete');

    Route::get('admin/proses_nlp', 'KalimatController@indexProsessNLP');
    Route::get('admin/proses_nlp/detail/{id}', 'KalimatController@prosesnlpdetail');
    Route::get('admin/similarity', 'SimilarityController@index');
});
