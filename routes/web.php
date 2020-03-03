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

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/stock', 'StockController@stock')->name('stock');
Route::get('/stocktake', 'StockController@stocktake')->name('stocktake');
Route::get('/addstock', 'StockController@addstock')->name('addstock');
Route::get('/missingstock', 'StockController@missingstock')->name('missingstock');
Route::get('/requests', 'RequestsController@requests')->name('requests');
Route::get('/manageusers', 'ManageUsersController@manageusers')->name('manageusers');
