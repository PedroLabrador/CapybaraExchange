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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get ('/', 'ExchangeController@main');

Route::group(['middleware' => ['auth']], function() {
	Route::group(['prefix' => 'user'], function(){
		Route::get ('/', 'HomeController@home');
		Route::post('/exchange', 'ExchangeController@store');
		Route::get ('/exchange', 'ExchangeController@index');
        Route::get ('/exchange/list', 'UserController@list');
        Route::post('/profile', 'UserController@update');
        Route::get ('/profile', 'UserController@index');
        Route::post('/profile/update', 'UserController@phone');
        Route::get ('/profile/delete/{id}', 'UserController@delete');
	});
});

Route::group(['middleware' => ['auth']], function() {
	Route::group(['prefix' => 'admin'],function(){
        Route::get ('/', 'AdminController@index');
    	Route::get ('/finances', 'AdminController@finances');
    	Route::post('/currency', 'CurrencyController@store');
    	Route::get ('/currency', 'CurrencyController@create');
    	Route::get ('/exchange/list', 'ExchangeController@list');
        Route::get ('/exchange/list/approved', 'ExchangeController@listapproved');
        Route::get ('/exchange/list/disapproved', 'ExchangeController@listdisapproved');
    	Route::get ('/exchange/list/{id}', 'ExchangeController@show');
    	Route::post('/bank', 'AdminController@bankcreate');
    	Route::get ('/bank', 'AdminController@bank');
    	Route::get ('/bank/activate/{id}', 'AdminController@activate');
    	Route::get ('/bank/deactivate/{id}', 'AdminController@deactivate');
        Route::post('/exchange/approve/{id}', 'ExchangeController@approve');
    	Route::post('/exchange/disapprove/{id}', 'ExchangeController@disapprove');
    	Route::post('/currency/edit/{id}', 'CurrencyController@update');
    	Route::get ('/currency/edit/{id}', 'CurrencyController@edit');
    	Route::get ('/currency/activate/{id}', 'CurrencyController@activate');
    	Route::get ('/currency/deactivate/{id}', 'CurrencyController@deactivate');
	});
});
