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

Route::get('products', 'ProductsController@index')->name('products.index');
Route::post('products/store', 'ProductsController@store')->name('products.store');
Route::get('products/load-data', 'ProductsController@load')->name('products.load');
