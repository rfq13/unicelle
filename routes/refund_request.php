<?php

/*
|--------------------------------------------------------------------------
| Refund System Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin Panel
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/refund-request-all', 'RefundRequestController@admin_index')->name('refund_requests_all');
    Route::get('/refund-request-config', 'RefundRequestController@refund_config')->name('refund_time_config');
    Route::get('/paid-refund', 'RefundRequestController@paid_index')->name('paid_refund');
    Route::post('/refund-request-pay', 'RefundRequestController@refund_pay')->name('refund_request_money_by_admin');
    Route::post('/refund-request-time-store', 'RefundRequestController@refund_time_update')->name('refund_request_time_config');
    Route::post('/refund-request-sticker-store', 'RefundRequestController@refund_sticker_update')->name('refund_sticker_config');
    Route::post('/refund-request-poin-store', 'RefundRequestController@refund_poin_update')->name('refund_request_poin_config');
    Route::post('/refund_reason/show', 'RefundRequestController@showReasonModal')->name('reason.showReasonModal');
    Route::post('/detail/pesanan/refund', 'RefundRequestController@showDetailPesanan')->name('refund.showDetailPesanan');
    Route::post('/refund/store/dana', 'RefundRequestController@confirmDanaModal')->name('confirmDanaModal');

});

//FrontEnd User panel
Route::group(['middleware' => ['user', 'verified']], function(){
	Route::post('refund-request-send/{id}', 'RefundRequestController@request_store')->name('refund_request_send');
    Route::get('refund-request', 'RefundRequestController@vendor_index')->name('vendor_refund_request');
    Route::get('sent-refund-request', 'RefundRequestController@customer_index')->name('customer_refund_request');
    Route::post('refund-reuest-vendor-approval', 'RefundRequestController@request_approval_vendor')->name('vendor_refund_approval');
    Route::get('refund-request/{id}/{poin?}', 'RefundRequestController@refund_request_send_page')->name('refund_request_send_page');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('refund-request-reason/{id}', 'RefundRequestController@reason_view')->name('reason_show');
});
