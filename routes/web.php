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

Route::get('/','ChartController@charts' );

Route::resource('supplier', 'SupplierController', ['except'=>['store','edit']]);
Route::resource('account', 'AccountController', ['except'=>['store','edit']]);
Route::resource('user', 'UserController', ['except'=>['store','edit']]);


Auth::routes();

Route::get('/home', 'ChartController@charts');
Route::get('/transactions', 'TransactionController@index');
Route::get('/addtransactions', 'TransactionController@create');
Route::post('/saveTrans', 'TransactionController@save');
Route::get('/updateTrans', 'TransactionController@updatePV');
Route::get('/deleteTrans', 'TransactionController@deletePayment');
Route::get('/reviewTrans', 'TransactionController@reviewPayment');
Route::get('/approveTrans', 'TransactionController@approvePayment');
Route::get('/makePayment', 'TransactionController@makePayment');
Route::get('/multireject', 'TransactionController@reject');
Route::get('/review', 'TransactionController@review');
Route::get('/exportExcel', 'ExcelController@exportExcel');
Route::get('/printCheque', 'ExcelController@cheque');
Route::get('/download', 'TransactionController@downloadFile');
Route::get('/multiapprove', 'TransactionController@approve');
Route::get('/multidelete', 'TransactionController@multiDelete');
Route::get('/multireview', 'TransactionController@reviewStatus');
Route::get('/mail', 'MailController@sendMail');
Route::get('/reportTrans', 'PDFController@genPDF');
