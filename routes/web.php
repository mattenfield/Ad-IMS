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
    return view('auth/login');
});

Auth::routes();
Route::resource('stock', 'StockController');
Route::resource('request', 'RequestController');
Route::resource('manageusers', 'ManageUsersController');
Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/stock/create', 'StockController@create')->name('stock');
Route::get('/stock/missing', 'StockController@missing')->name('missingstock');
Route::get('/stock/take', 'StockController@take')->name('stocktake');

