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
Route::post('rpt/download-report/download', 'Rpt\DownloadReportController@downloadReport');
Route::post('rpt/download-report/get-group-form', 'Rpt\DownloadReportController@getGroupForm');
Route::post('rpt/download-report/get-report-list', 'Rpt\DownloadReportController@getReportList');
Route::resource('rpt/download-report', 'Rpt\DownloadReportController');
Route::post('sys/mail/simulate', 'Sys\MailController@simulate');
Route::resource('sys/mail', 'Sys\MailController');
Route::resource('sys/send-mail', 'Sys\SendMailController');

Route::get('/home', 'HomeController@index')->name('home');

// =============== Mail Routes =================
Route::get('/mailable', function () {
   $data = ['message' => 'This is a test!'];

    Mail::to('satishkumr001@gmail.com')->send(new App\Mail\TestEmail($data));

    // return new App\Mail\TestEmail();
});
