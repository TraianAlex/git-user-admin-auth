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

/*----------------------------------*/

Route::get('blogs', [
		'uses' => 'PostController@getBlogIndex',
		'as' => 'blog.index'
	]);

	Route::get('/blog/{post_id}&{end}', [
		'uses' => 'PostController@getSinglePost',
		'as' => 'blog.single'
	]);

	Route::get('/blog/posts/create', [
		'uses' => 'PostController@getCreatePost',
		'as' => 'admin.blog.create_post'
	]);

	Route::post('/blog/post/create', [
		'uses' => 'PostController@postCreatePost',
		'as' => 'admin.blog.post.create'
	]);

	Route::get('/about', function(){
		return view('other.about');
	})->name('about');

	Route::get('/contact', [
		'uses' => 'ContactMessageController@getContactIndex',
		'as' => 'contact'
	]);

	Route::post('/contact/sendmail', [
		'uses' => 'ContactMessageController@postSendMessage',
		'as' => 'contact.send'
	]);

/*----------------------------------*/

	Route::group(['prefix' => '/admin'], function(){

		Route::get('/login', [
			'uses' => 'AdminController@getLogin',
			'as' => 'login.admin'
		]);

		Route::post('/login', [
			'uses' => 'AdminController@postLogin',
			'as' => 'login.admin'
		]);

		Route::group(['middleware' => 'admin'], function(){
			Route::get('/dashboard', [
				'uses' => 'AdminController@getDashboard',
				//'middleware' => 'auth',
				'as' => 'admin.dashboard'
			]);

			Route::get('/quotes', function(){
				return view('admin.quotes');
			});//->middleware('auth')

			Route::get('/logout', [
				'uses' => 'AdminController@getLogout',
				'as' => 'admin.logout'
			]);

			Route::get('/blog/posts', [
				'uses' => 'PostController@getPostIndex',
				'as' => 'admin.blog.index'
			]);

			Route::get('/blog/post/{post_id}&{end}', [
				'uses' => 'PostController@getSinglePost',
				'as' => 'admin.blog.post'
			]);

			Route::get('/blog/post/{post_id}/update', [
				'uses' => 'PostController@getUpdatePost',
				'as' => 'admin.blog.post.edit'
			]);

			Route::post('/blog/post/update', [
				'uses' => 'PostController@postUpdatePost',
				'as' => 'admin.blog.post.update'
			]);

			Route::get('/blog/post/{post_id}/delete', [
				'uses' => 'PostController@getDeletePost',
				'as' => 'admin.blog.post.delete'
			]);

			Route::get('/blog/categories', [
				'uses' => 'CategoryController@getCategoryIndex',
				'as' => 'admin.blog.category'
			]);

			Route::post('/blog/category/create', [
				'uses' => 'CategoryController@postCreateCategory',
				'as' => 'admin.blog.category.create'
			]);

			Route::post('/blog/categories/update', [
				'uses' => 'CategoryController@postUpdateCategory',
				'as' => 'admin.blog.category.update'
			]);

			Route::get('/blog/category/{category_id}/delete', [
				'uses' => 'CategoryController@getDeleteCategory',
				'as' => 'admin.blog.category.delete'
			]);

			Route::get('/contact/messages', [
				'uses' => 'ContactMessageController@getContactMessageIndex',
				'as' => 'admin.contact.index'
			]);

			Route::get('/contact/message/{message_id}/delete', [
				'uses' => 'ContactMessageController@getDeleteMessage',
				'as' => 'admin.contact.delete'
			]);
		});

	});
	
		
	Route::get('/', function () {
	    return view('welcome');
	});
});
