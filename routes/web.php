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
Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/stock/search', 'StockController@search')->name('search');
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::resource('stock', 'StockController');
    Route::resource('request', 'RequestController');
    Route::resource('manageusers', 'ManageUsersController');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/stock/create', 'StockController@create')->name('stock');

   

});







