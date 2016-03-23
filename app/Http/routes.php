<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::auth();

    Route::get('/home/{author?}', [
		'uses' => 'QuoteController@getIndex',
		'as' => 'index'
	]);

	Route::post('/new', [
		'uses' => 'QuoteController@postQuote',
		'as' => 'create'
	]);

	Route::get('/delete/{quote_id}', [
		'uses' => 'QuoteController@getDeleteQuote',
		'as' => 'delete'
	]);

	Route::get('/getemail/{author_name}', [
		'uses' => 'QuoteController@getMailCallback',
		'as' => 'mail_callback'
	]);

	Route::get('/login/admin', [
		'uses' => 'AdminController@getLogin',
		'as' => 'login.admin'
	]);

	Route::post('/login/admin', [
		'uses' => 'AdminController@postLogin',
		'as' => 'login.admin'
	]);

	Route::group(['middleware' => 'admin'], function(){
		Route::get('/admin/dashboard', [
			'uses' => 'AdminController@getDashboard',
			//'middleware' => 'auth',
			'as' => 'admin.dashboard'
		]);

		Route::get('/admin/quotes', function(){
			return view('admin.quotes');
		});//->middleware('auth')

		Route::get('admin/logout', [
			'uses' => 'AdminController@getLogout',
			'as' => 'admin.logout'
		]);
	});
		
		Route::get('/', function () {
		    return view('welcome');
		});
});
