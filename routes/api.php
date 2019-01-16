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

Route::apiResource('products', 'API\ProductsController')->except('store', 'update', 'destroy');
Route::patch('products/{product}/purchase', 'API\ProductsController@purchase')->name('products.purchase');

Route::post('auth', 'Auth\AuthController@login')->name('auth');
