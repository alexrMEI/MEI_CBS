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

Route::get('/home', 'HomeController@index')->name('home');


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

Route::group(['middleware' => ['role:admin']], function () {
});
Route::group(['middleware' => ['role:admin|developer']], function () {
});
Route::group(['middleware' => ['role:admin|salesman']], function () {
});
Route::group(['middleware' => ['role:admin|client']], function () {
});