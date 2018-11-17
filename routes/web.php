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

Route::get ('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get ('/register', 'Auth\RegisterController@showRegistrationForm')->name('register'); //Si quieres desactivar los registros, comenta esta linea.
Route::post('/register', 'Auth\RegisterController@register');
Route::get ('/logout', 'Auth\LoginController@logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get ('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get ('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');


// Route::auth();

Route::get ('/', 'ExchangeController@main');
Route::get ('/howto', 'HomeController@howto');
Route::get ('/howdeposit', 'HomeController@howdeposit');
Route::get ('/termsofservice', 'HomeController@termsofservice');
Route::get ('/testzone', 'HomeController@testzone');

Route::group(['middleware' => ['auth']], function() {
	Route::group(['prefix' => 'user'], function(){
		Route::get ('/', 'UserController@home');
		Route::post('/exchange', 'ExchangeController@store');
		Route::get ('/exchange', 'ExchangeController@index');
        Route::get ('/exchange/list', 'UserController@list');
        Route::post('/profile', 'UserController@update');
        Route::get ('/profile', 'UserController@index');
        Route::post('/profile/update', 'UserController@phone');
        Route::get ('/profile/delete/{id}', 'UserController@delete');
        Route::get ('/profile/update/{id}', 'UserController@show');
        Route::post('/profile/update/{id}', 'UserController@update_single');
	});
});

Route::group(['middleware' => ['auth']], function() {
	Route::group(['prefix' => 'admin'],function(){
        Route::get ('/', 'AdminController@index');
        Route::get ('/users', 'AdminController@users');
        Route::get ('/users/delete/{id}', 'AdminController@deleteuser');
        Route::get ('/users/details/{id}', 'AdminController@detailsuser');
        Route::post('/users/details/{id}', 'AdminController@updatedetails');
        Route::get ('/finances', 'AdminController@finances');
        Route::post('/finances', 'AdminController@rates');
        Route::get ('/finances/{id}', 'AdminController@financesedit');
    	Route::post('/finances/{id}', 'AdminController@financesupdate');
    	Route::post('/currency', 'CurrencyController@store');
    	Route::get ('/currency', 'CurrencyController@create');
    	Route::get ('/exchange/list', 'ExchangeController@list');
        Route::get ('/exchange/list/approved', 'ExchangeController@listapproved');
        Route::get ('/exchange/list/disapproved', 'ExchangeController@listdisapproved');
    	Route::get ('/exchange/list/{id}', 'ExchangeController@show');
    	Route::get ('/bank/deactivateall', 'AdminController@deactivateall');
        Route::post('/bank', 'AdminController@bankcreate');
        Route::get ('/bank', 'AdminController@bank');
        Route::get ('/bank/{id}', 'AdminController@bankedit');
        Route::post('/bank/{id}', 'AdminController@bankupdate');
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
