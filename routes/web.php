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

Route::get('/', function () {
    return view('index');
});


// Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'user'], function(){
	Route::get ('/', 'HomeController@home');
	Route::get ('/exchange', 'ExchangeController@index');
	Route::post('/profile', 'UserController@update');
	Route::get ('/profile', 'UserController@index');
	
});

Route::group(['middleware' => ['auth']], function() {
	Route::group(['prefix' => 'admin'],function(){
    	Route::get ('/', 'AdminController@index');
    	Route::post('/currency', 'CurrencyController@store');
    	Route::get ('/currency', 'CurrencyController@create');
    	Route::get ('/exchange/list', 'ExchangeController@list');
	});
});

// Route::post('/exchange/create', 'HomeController@create');
// Route::get('/exchange/list', 'HomeController@list');