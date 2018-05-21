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

Route::resource('sys/global-value', 'Sys\GlobalValueController');
Route::resource('rpt/define-report', 'Rpt\DefineReportController');
Route::resource('rpt/download-report', 'Rpt\DownloadReportController');

Route::get('/home', 'HomeController@index')->name('home');
