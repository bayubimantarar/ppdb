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
Route::group(['prefix' => 'autentikasi'], function() {
    Route::get('/form-login', [
        'uses' => 'Authentication\PenggunaAuthenticationController@loginForm',
        'as' => 'authentication.pengguna.login_form'
    ]);
    Route::post('/login', [
        'uses' => 'Authentication\PenggunaAuthenticationController@login',
        'as' => 'authentication.pengguna.login'
    ]);
    Route::post('/logout', [
        'uses' => 'Authentication\PenggunaAuthenticationController@logout',
        'as' => 'authentication.pengguna.logout'
    ]);
});

Route::group(['middleware' => 'auth:pengguna'], function(){
    Route::get('/', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    Route::group(['prefix' => 'calon-peserta-didik'], function(){
        Route::get('/', [
            'uses' => 'CalonPesertaDidikController@index',
            'as' => 'calon_peserta_didik'
        ]);
        Route::get('/data', [
            'uses' => 'CalonPesertaDidikController@data',
            'as' => 'calon_peserta_didik.data'
        ]);
        Route::get('/form-tambah', [
            'uses' => 'CalonPesertaDidikController@create',
            'as' => 'calon_peserta_didik.form_tambah'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses' => 'CalonPesertaDidikController@edit',
            'as' => 'calon_peserta_didik.form_ubah'
        ]);
        Route::post('/simpan', [
            'uses' => 'CalonPesertaDidikController@store',
            'as' => 'calon_peserta_didik.simpan'
        ]);
        Route::put('/ubah/{id}', [
            'uses' => 'CalonPesertaDidikController@update',
            'as' => 'calon_peserta_didik.ubah'
        ]);
        Route::delete('/hapus/{id}', [
            'uses' => 'CalonPesertaDidikController@destroy',
            'as' => 'calon_peserta_didik.hapus'
        ]);
    });
});
