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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/', 'Dashboard\HomeController@index');
    Route::group(['prefix' => 'user-administrations'], function() {
        Route::resource('users', 'Dashboard\UserController');
        Route::resource('permissions', 'Dashboard\PermissionController');
        Route::resource('roles', 'Dashboard\RoleController');
    });
});
