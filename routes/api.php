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
Route::resource('/kegiatan','KegiatanController');
Route::resource('/jurusan','JurusanController');

Route::resource('/mahasiswa','MahasiswaController');
Route::resource('/panitia','PanitiaController');
Route::resource('/jabatan','JabatanController');

Route::get('/kegiatan/jurusan/{id_jurusan}','KegiatanController@showByJurusan');
Route::get('mahasiswa/jurusan/{id_jurusan}','MahasiswaController@showByJurusan');
