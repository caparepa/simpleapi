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

Route::group(['namespace' => 'Api\V1', 'middleware' => ['api', 'cors'], 'prefix' => 'v1'], function () {

    Route::post('register', 'UserController@register');
    Route::post('auth/login', 'ApiAuthController@login');
    Route::get('auth/token', 'ApiAuthController@token');
    Route::get('auth/user', 'ApiAuthController@getAuthUser');

    //Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@getProfile');
    Route::put('users/{id}', 'UserController@update');


});

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {

    Route::get('users', 'UserController@index');

});