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
});
