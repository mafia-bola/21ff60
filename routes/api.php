<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register','ApiController@register');
Route::post('auth/login','ApiController@login');
Route::get('tiket/','ApiController@getTiketKecak');
Route::get('pengunjung/','ApiController@getPengunjung');
Route::get('pesan/{id}', 'ApiController@getPesan');
Route::post('pemesanan', 'ApiController@setPesan');
Route::post('konfirmasi/{id}', 'ApiController@konfirmasiPesan');
Route::get('catatan/{id}', 'ApiController@getHistory');
