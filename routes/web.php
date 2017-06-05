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

Route::get('/','ChartController@charts' )->middleware('auth');

Route::resource('supplier', 'SupplierController', ['except'=>['store','edit']]);
Route::resource('account', 'AccountController', ['except'=>['store','edit']]);
Route::resource('user', 'UserController');
Route::get('/newuser','UserController@showForm');
Route::resource('department', 'DeptController', ['except'=>['store','edit']]);

Route::get('/password/change', function(){
    return view ('auth.changepassword');   
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'ChartController@charts');
Route::get('/chart', 'ChartController@chartPeriod');
Route::post('/change', 'UserController@changePassword');
Route::get('/userstatus', 'UserController@changeStatus');
Route::get('/transactions', 'TransactionController@index');
Route::get('/viewtransactions', 'TransactionController@view');
Route::get('/addtransactions', 'TransactionController@create');
Route::post('/saveTrans', 'TransactionController@save');
Route::get('/updateTrans', 'TransactionController@updatePV');
Route::get('/showTrans', 'TransactionController@show');
Route::get('/deleteTrans', 'TransactionController@deletePayment');
Route::get('/reviewTrans', 'TransactionController@reviewPayment');
Route::get('/approveTrans', 'TransactionController@approvePayment');
Route::get('/makePayment', 'TransactionController@makePayment');
Route::get('/multireject', 'TransactionController@multireject');
Route::get('/approve', 'TransactionController@approve');
Route::get('/review', 'TransactionController@review');
Route::get('/exportExcel', 'ExcelController@exportExcel');
Route::post('/importExcel', 'ExcelController@importExcel');
Route::get('/printCheque', 'ExcelController@cheque');
Route::get('/download', 'TransactionController@downloadFile');
Route::get('/multiapprove', 'TransactionController@approve');
Route::get('/multidelete', 'TransactionController@multiDelete');
Route::get('/multireview', 'TransactionController@reviewStatus');
Route::get('/reviewmail', 'MailController@sendReviewMail');
Route::get('/approvemail', 'MailController@sendApproveMail');
Route::get('/rejectmail', 'MailController@sendRejectMail');
Route::get('/approvalmail', 'MailController@approvalMail');
Route::get('/reportTrans', 'PDFController@genPDF');
