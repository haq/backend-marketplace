<?php

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

// prodcts
Route::get('products', 'API\ProductsController@index')->name('products.index');
Route::post('products', 'API\ProductsController@create')->name('products.create');
Route::get('products/{product}', 'API\ProductsController@show')->name('products.show');

// shopping carts
Route::post('carts', 'API\ShoppingCartsController@create')->name('carts.create');
Route::get('carts/{shoppingCart}', 'API\ShoppingCartsController@show')->name('carts.show');
Route::patch('carts/{shoppingCart}/add', 'API\ShoppingCartsController@add')->name('carts.add');
Route::patch('carts/{shoppingCart}/remove', 'API\ShoppingCartsController@remove')->name('carts.remove');
Route::patch('carts/{shoppingCart}/complete', 'API\ShoppingCartsController@complete')->name('carts.complete');

// auth
Route::post('auth', 'Auth\AuthController@login')->name('auth');
