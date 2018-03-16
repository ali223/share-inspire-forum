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

Route::prefix('admin')->group( function () {
	Route::get('/', 'AdminController@index')->name('admins.index');

	Route::get('/categories', 'AdminCategoriesController@index')->name('admincategories.index');

	Route::post('/categories', 'AdminCategoriesController@store')->name('admincategories.store');

	Route::patch('/categories/{category}', 'AdminCategoriesController@update')->name('admincategories.update');


	Route::get('/topics', 'AdminTopicsController@index')->name('admintopics.index');

	Route::get('/topics/approve/{topic}', 'AdminTopicsController@approve')->name('admintopics.approve');

	Route::get('/topics/disapprove/{topic}', 'AdminTopicsController@disapprove')->name('admintopics.disapprove');


	Route::get('/login', 'AdminSessionsController@create')->name('adminsessions.create');

	Route::post('/login', 'AdminSessionsController@store')->name('adminsessions.store');

	Route::get('/logout', 'AdminSessionsController@destroy')->name('adminsessions.destroy');


});

Route::get('/posts/latest', 'PostsController@latest')->name('posts.latest');
Route::get('/posts/search', 'PostsController@search')->name('posts.search');


Route::get('/', 'CategoriesController@index')->name('home');

Route::get('/categories', 'CategoriesController@index')->name('categories.index');


Route::get('/categories/{category}/topics', 'TopicsController@index')->name('topics.index'); 

Route::get('/categories/{category}/topics/create', 'TopicsController@create')->name('topics.create');

Route::post('/categories/{category}/topics', 'TopicsController@store')->name('topics.store');

Route::get('/topics/{topic}/posts', 'PostsController@index')->name('posts.index');

Route::get('/topics/{topic}/posts/create', 'PostsController@create')->name('posts.create');

Route::post('/topics/{topic}/posts', 'PostsController@store')->name('posts.store');

Route::put('/topics/{topic}/posts/{post}', 'PostsController@update')->name('posts.update');

Route::delete('/topics/{topic}/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

Route::get('/registrations/create', 'RegistrationsController@create')->name('registrations.create');
Route::post('/registrations', 'RegistrationsController@store')->name('registrations.store');

Route::get('/profiles/edit/{user}', 'ProfilesController@edit')->name('profiles.edit');
Route::patch('/profiles/{user}', 'ProfilesController@update')->name('profiles.update');
Route::get('/profiles/{id}', 'ProfilesController@show')->name('profiles.show');

Route::get('/login', 'SessionsController@create')->name('sessions.create');
Route::post('/login', 'SessionsController@store')->name('sessions.store');

Route::get('/logout', 'SessionsController@destroy')->name('sessions.destroy');

Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');

Route::delete('/notifications/{id}', 
	'NotificationsController@destroy')
	->name('notifications.destroy');


Route::get('/welcomemail', function () {
	return new \App\Mail\WelcomeMail(\App\User::find(1));
});

Route::get('/chatmessages', 'ChatMessagesController@index')->name('chatmessages.index');

Route::post('/chatmessages', 'ChatMessagesController@store')->name('chatmessages.store');

Route::post('/posts/{post}/like', 'LikesController@store');
Route::delete('/posts/{post}/like', 'LikesController@destroy');
