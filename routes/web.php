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

Route::get('/', 'CategoriesController@index');
Route::get('/categories', 'CategoriesController@index');

Route::get('/categories/{category}/topics', 'TopicsController@index');

Route::get('/categories/{category}/topics/create', 'TopicsController@create');
Route::post('/categories/{category}/topics', 'TopicsController@store');

Route::get('/topics/{topic}/posts', 'PostsController@index');