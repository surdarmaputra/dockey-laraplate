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

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index');
    Route::group(['prefix' => 'user-administrations', 'namespace' => 'UserAdministrations'], function() {
        Route::resource('users', 'UsersController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('roles', 'RolesController');
    });
});
