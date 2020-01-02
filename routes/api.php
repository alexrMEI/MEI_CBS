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


Route::get('paypal/create-payment', 'PaypalController@createPayment')->name('checkout.cart');
Route::get('paypal/execute-payment', 'PaypalController@getPaymentStatus')->name('checkout.cart');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
