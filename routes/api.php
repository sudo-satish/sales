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

Route::get('sys/aureole-lookup/translation/{translationType}', 'Api\Sys\AureoleLookupController@getTranslationDetail');
Route::get('sys/aureole-lookup/translations', 'Api\Sys\AureoleLookupController@translations');
Route::resource('sys/aureole-lookup', 'Api\Sys\AureoleLookupController');

Route::group(['middleware' => 'auth:api'], function() {

    // Sys

    // Stock
    Route::get('stock/tumbrow/get-lov', 'Api\Stock\TumbrowController@getLOV');
    Route::resource('stock/tumbrow', 'Api\Stock\TumbrowController');

    Route::get('details', 'Api\AuthController@details');

    //============ Address Routes ============//
    Route::get('hrm/address/get-lov', 'Api\Hrm\AddressController@getLOV');
    Route::resource('hrm/address', 'Api\Hrm\AddressController');
    
    
    //============ Address Routes ============//
    Route::get('hrm/client-address/get-client-address/{clientId}', 'Api\Hrm\ClientAddressController@getCLientAddress');
    Route::get('hrm/client-address/get-lov', 'Api\Hrm\ClientAddressController@getLOV');
    Route::resource('hrm/client-address', 'Api\Hrm\ClientAddressController');


    //============ User Routes ============//
    Route::get('hrm/user/get-user-profile', 'Api\Hrm\UserController@getUserProfile');
    Route::put('hrm/user/update-user-profile', 'Api\Hrm\UserController@updateUserProfile');
    Route::post('hrm/user/update-user-profile', 'Api\Hrm\UserController@updateUserProfile');
    Route::post('hrm/user/get-user-profile-image', 'Api\Hrm\UserController@getUserProfileImage');
    Route::get('hrm/user/get-lov', 'Api\Hrm\UserController@getLov');
    Route::resource('hrm/user', 'Api\Hrm\UserController');

    //============ Department Routes ============//
    Route::resource('hrm/department', 'Api\Hrm\DepartmentController');
    
    //============ Designation Routes ============//
    Route::resource('hrm/designation', 'Api\Hrm\DesignationController');
    
    //============ Location Routes ============//
    Route::resource('hrm/location', 'Api\Hrm\LocationController');
    
    //============ Client Routes ============//
    Route::get('hrm/client/search-client', 'Api\Hrm\ClientController@searchClient');
    Route::resource('hrm/client', 'Api\Hrm\ClientController');
    
    //============ Pricing Plan Routes ============//
    //getCLientPlan
    Route::get('hrm/pricing-plan/get-client-plan/{clientId}', 'Api\Hrm\PricingPlanController@getCLientPlan');
    Route::get('hrm/pricing-plan/get-lov', 'Api\Hrm\PricingPlanController@getLOV');
    Route::resource('hrm/pricing-plan', 'Api\Hrm\PricingPlanController');

    Route::group(["prefix"=>"stock", "namespace" => "Api\Stock"], function() {
        Route::post('item/get-item-code', 'ItemController@getItemCode');
        Route::get('item/get-lov', 'ItemController@getLov');
        Route::resource('item', 'ItemController');
    });

    Route::group(["prefix"=>"stock", "namespace" => "Api\Stock"], function() {
        Route::resource('price-mapping', 'PriceMappingController');
    });

    Route::group(["prefix"=>"stock", "namespace" => "Api\Stock"], function() {
        Route::resource('default-price-mapping', 'DefaultPriceMappingController');
    });

});


Route::prefix('pla')->group(function () {
    Route::namespace('Api\Pla')->group(function () {
        Route::post('playground', 'PlaController@index');
    });
});


