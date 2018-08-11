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

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::resource('sys/aureole-lookup', 'Api\Sys\AureoleLookupController');
Route::group(['middleware' => 'auth:api'], function() {

    // Sys

    // Stock
    Route::get('stock/tumbrow/get-lov', 'Api\Stock\TumbrowController@getLOV');
    Route::resource('stock/tumbrow', 'Api\Stock\TumbrowController');

    Route::get('details', 'Api\AuthController@details');
});
