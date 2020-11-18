<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/v1')->group(function () {
    Route::middleware('auth:api')->get('/user', 'UserController@profile')->name('.user');
    Route::middleware('auth:api')->prefix('/users')->name('.users')->group(function () {
        Route::get('/', 'UserController@index')->name('.index');
        Route::get('/{user:id}', 'UserController@show')->name('.show');
        Route::put('/{user:id}', 'UserController@update')->name('.update');
        Route::delete('/{user:id}', 'UserController@destroy')->name('.destroy');
    });
    Route::middleware('throttle:api.login')->post('/login', 'AuthController@login')->name('.login');
    Route::post('/register', 'AuthController@register')->name('.login');
    Route::post('/forgot-password', 'AuthController@forgotPassword')->name('.forgot_password');
    Route::prefix('/roles')->name('.roles')->group(function () {
        Route::get('/', 'RoleController@index');
        Route::get('/{role:name}', 'RoleController@show');
    });
});