<?php

use App\Product;

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

Auth::routes();

Route::get('/log', 'API\UserController@log');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mail', 'MailController@index')->name('mailForm');

// GOOGLE AUTH

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Shopping Cart & Paypal

Route::get('/add/{product}', 'API\ShoppingCartController@addToCart')->name('add.to.cart');
Route::get('/remove/{productId}', 'API\ShoppingCartController@removeProductFromCart')->name('remove');
Route::get('/empty', 'API\ShoppingCartController@destroyCart')->name('empty');

Route::group(['middleware' => ['auth']], function () {
    Route::get('checkout', 'PaypalController@payWithpaypal')->name('checkout');
	Route::get('status', 'PaypalController@getPaymentStatus');
});

// Products

Route::get('/products', 'API\ProductController@index')->name('products');


Route::group(['middleware' => ['role:admin']], function () {
	Route::get('/admin', 'AdminController@index')->name('admin');

	Route::get('/admin/users', 'API\UserController@admin')->name('admin.users');
	Route::get('/admin/users/{user}', 'AdminController@editUser')->name('admin.users.edit');
	Route::post('/admin/users/update/{user}', 'AdminController@updateUser')->name('admin.users.update');

	Route::get('/admin/products', 'API\ProductController@admin')->name('admin.products');

	Route::get('/admin/files', 'API\ProductFileController@admin')->name('admin.files');

	Route::get('/admin/licenses', 'API\ProductLicenseController@admin')->name('admin.licenses');

	Route::get('/admin/authentication', 'AdminController@authentication')->name('admin.authentication');
});

Route::group(['middleware' => ['role:admin|developer']], function () {});
Route::group(['middleware' => ['role:admin|salesman']], function () {});
Route::group(['middleware' => ['role:admin|client']], function () {});
