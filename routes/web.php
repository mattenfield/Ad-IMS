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

Route::group(['middleware' => 'admin'], function () {
    Route::get('/manageusers/search', 'ManageUsersController@search')->name('managesearch');
    Route::post('/stock/print', 'StockController@print')->name('stockprint');
    Route::get('/stock/print', 'StockController@print')->name('stockprint');
    Route::get('/stock/printall', 'StockController@printall')->name('stockprintall');
    Route::post('/stock/take/complete', 'StockController@completestocktake')->name('completestocktake');
    Route::get('/stock/take/complete', 'StockController@completestocktake')->name('completestocktake');
    Route::post('/stock/checkitem', 'StockController@checkitem')->name('checkitem');
    Route::get('/stock/missing', 'StockController@missing')->name('missingitems');
    Route::resource('manageusers', 'ManageUsersController');
    Route::get('/requests/approve/{id}', 'RequestsController@approve')->name('approverequest');
    Route::get('/requests/decline/{id}', 'RequestsController@decline')->name('declinerequest');
    Route::get('/manageusers', 'ManageUsersController@index')->name('manageusers');
    Route::get('/manageusers/search', 'ManageUsersController@search')->name('managesearch');
    Route::get('manageusers/edit/{id}', 'ManageUsersController@edit');
    Route::post('manageusers/edit/{id}', 'ManageUsersController@edit');
    Route::post('manageusers/edit/update/{id}', 'ManageUsersController@update');
    Route::get('manageusers/delete/{id}', 'ManageUsersController@destroy');
    Route::post('manageusers/create/new', 'ManageUsersController@store')->name('register');
    Route::get('/stock/create', 'StockController@create')->name('stockcreate');
    Route::post('/stock/create', 'StockController@create')->name('stockcreate');
    Route::get('/stock', 'StockController@index')->name('stock');
    Route::get('/stock/take', 'StockController@take')->name('stocktake');
    Route::get('/stock/mobiletake/{id}', 'StockController@mobiletake')->name('mobilestocktake');
    Route::get('/stock/found/{id}','StockController@found');
    Route::get('/stock/delete/{id}','StockController@destroy');
    Route::resource('stock', 'StockController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/changepassword', 'ManageUsersController@changepassword')->name('changepwd');
    Route::post('/changepassword/store', 'ManageUsersController@changepasswordstore')->name('changepwdstore');
    Route::get('/stock/search', 'StockController@search')->name('search');
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::get('/requests/search/', 'RequestsController@search')->name('searchrequests');
    Route::resource('requests', 'RequestsController');
    Route::get('/requests', 'RequestsController@index')->name('requestsview');
    Route::get('/requests/create', 'RequestsController@create')->name('requests');
    Route::post('/requests/create', 'RequestsController@store');
    Route::get('/requests/delete/{id}', 'RequestsController@destroy')->name('deleterequest');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/stock', 'StockController@index')->name('stock');
});







