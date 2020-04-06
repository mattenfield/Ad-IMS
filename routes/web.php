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


Auth::routes(['register' => false]);
Route::get('/', function () {
    return view('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/stock/take', 'StockController@take')->name('stocktake');
    Route::get('/stock/take/complete', 'StockController@completestocktake')->name('completestocktake');
    Route::post('/stock/checkitem', 'StockController@checkitem')->name('checkitem');
    Route::get('/stock/search', 'StockController@search')->name('search');
    Route::get('/stock/missing', 'StockController@missing')->name('missingitems');
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::resource('stock', 'StockController');
    Route::resource('requests', 'RequestsController');
    Route::resource('manageusers', 'ManageUsersController');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/stock/create', 'StockController@create')->name('stockcreate');
    Route::get('/stock', 'StockController@index')->name('stock');
    Route::get('/stock/delete/{id}','StockController@destroy');


   

});







