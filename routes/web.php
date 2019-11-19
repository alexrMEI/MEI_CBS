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

Route::get('/', function () {
	$products = Product::All();
    return view('welcome', compact('products')); 
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mail', 'MailController@index')->name('mailForm');


//GOOGLE AUTH
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Products
Route::get('/products', 'API\ProductController@index');

// Shopping Cart
Route::group(['middleware' => ['web']], function () {
    Route::get('/cart/add/{productId}', 'API\ShoppingCartController@addProduct')->name('add.to.cart');
	Route::get('/cart/remove/{productId}', 'API\ShoppingCartController@removeProduct')->name('remove.from.cart');
});

Route::post('/cart/checkout', 'PaypalController@payWithpaypal')->name('checkout.cart');

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
Route::group(['middleware' => ['role:admin|developer']], function () {
});
Route::group(['middleware' => ['role:admin|salesman']], function () {
});
Route::group(['middleware' => ['role:admin|client']], function () {
});
