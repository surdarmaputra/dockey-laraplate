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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function() {
    Route::get('documentation', 'DocumentationController@index');
    Route::group(['prefix' => 'basic'], function() {
        Route::post('success', 'BasicApiController@trySuccess');
        Route::post('failure', 'BasicApiController@tryFailure');
        Route::post('unauthorized', 'BasicApiController@tryUnauthorized');
        Route::post('forbidden', 'BasicApiController@tryForbidden');
        Route::post('not-found', 'BasicApiController@tryNotFound');
        Route::post('invalid-parameters', 'BasicApiController@tryInvalidParameters');
        Route::post('custom', 'BasicApiController@tryCustom');
    });
    Route::group(['prefix' => 'encapsulated'], function() {
        Route::post('success', 'EncapsulatedApiController@trySuccess');
        Route::post('failure', 'EncapsulatedApiController@tryFailure');
        Route::post('unauthorized', 'EncapsulatedApiController@tryUnauthorized');
        Route::post('forbidden', 'EncapsulatedApiController@tryForbidden');
        Route::post('not-found', 'EncapsulatedApiController@tryNotFound');
        Route::post('invalid-parameters', 'EncapsulatedApiController@tryInvalidParameters');
        Route::post('custom', 'EncapsulatedApiController@tryCustom');
    });
});
