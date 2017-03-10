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
