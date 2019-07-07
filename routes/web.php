<?php

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
Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
// Route::get('/desa/{desa}', 'HomeController@index');
// Route::get('/home', function(){
//     return redirect('/');
// });

Route::group(['prefix' => 'admin','namespace' => 'Admin','as' => 'admin.','middleware' => 'auth'], function(){
    Route::get('/','DashboardController@index')->name('dashboard.index');
    Route::get('/user/profile','UserController@profile')->name('user.profile');
    Route::get('/pemesanan','PemesananController@index')->name('pemesanan.index');
    Route::get('/pemesanan/{id}/konfirmasi','PemesananController@showConfirm')->name('pemesanan.konfirmasi');
    Route::post('/pemesanan/{id}/update','PemesananController@ConfirmTicket')->name('pemesanan.update');
    Route::get('/pengunjung','PengunjungController@index')->name('pengunjung.index');
    Route::get('/pengunjung/{id}/detail','PengunjungController@show')->name('pengunjung.detail');

    Route::resources([
        '/tiket' => 'TiketController',
        '/user' => 'UserController'
    ]);
});

//3563-01-013367-53-7
//pemesanan tiket -> nampilin tiket dari api, dan konfirmasi pembayaran
//pengunjung -> menampilkan data pengunjung, ketika show maka menampilkan tiket yang pernah dipesan pengunjung