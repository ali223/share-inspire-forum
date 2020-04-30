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

Route::group([
    'namespace' => 'Admin',
    'as' => 'admin.',
    'prefix' => '/admin',
], function ($router) {
    $router->group([
        'middleware' => 'guest:admin',
    ], function ($router) {
        $router->get('/login', 'SessionsController@create')->name('sessions.create');
        $router->post('/login', 'SessionsController@store')->name('sessions.store');
    });

    $router->group([
        'middleware' => 'auth:admin',
    ], function ($router) {
        $router->get('/', 'DashboardController@index')->name('dashboard.index');

        $router->get('/categories', 'CategoriesController@index')->name('categories.index');
        $router->post('/categories', 'CategoriesController@store')->name('categories.store');
        $router->patch('/categories/{category}', 'CategoriesController@update')->name('categories.update');

        $router->get('/topics', 'TopicsController@index')->name('topics.index');
        $router->get('/topics/approve/{topic}', 'TopicsController@approve')->name('topics.approve');
        $router->get('/topics/disapprove/{topic}', 'TopicsController@disapprove')->name('topics.disapprove');

        $router->get('/logout', 'SessionsController@destroy')->name('sessions.destroy');
    });
});

Route::group([
    'middleware' => 'guest',
], function ($router) {
    $router->get('/login', 'SessionsController@create')->name('sessions.create');
    $router->post('/login', 'SessionsController@store')->name('sessions.store');

    $router->get('/registrations/create', 'RegistrationsController@create')->name('registrations.create');
    $router->post('/registrations', 'RegistrationsController@store')->name('registrations.store');
});

Route::group([
    'middleware' => 'auth',
], function ($router) {
    $router->get('/categories/{category}/topics/create', 'TopicsController@create')->name('topics.create');
    $router->post('/categories/{category}/topics', 'TopicsController@store')->name('topics.store');

    $router->get('/topics/{topic}/posts/create', 'PostsController@create')->name('posts.create');
    $router->post('/topics/{topic}/posts', 'PostsController@store')->name('posts.store');
    $router->put('/topics/{topic}/posts/{post}', 'PostsController@update')->name('posts.update');
    $router->delete('/topics/{topic}/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

    $router->get('/likedposts', 'LikedPostsController@index')->name('likedposts.index');
    $router->post('/posts/{post}/like', 'LikesController@store')->name('likes.store');
    $router->delete('/posts/{post}/like', 'LikesController@destroy')->name('likes.destroy');

    $router->get('/chatmessages', 'ChatMessagesController@index')->name('chatmessages.index');
    $router->post('/chatmessages', 'ChatMessagesController@store')->name('chatmessages.store');

    $router->get('/notifications', 'NotificationsController@index')->name('notifications.index');
    $router->delete('/notifications/{id}', 'NotificationsController@destroy')->name('notifications.destroy');

    $router->get('/profiles/edit/{user}', 'ProfilesController@edit')->name('profiles.edit');
    $router->patch('/profiles/{user}', 'ProfilesController@update')->name('profiles.update');

    $router->get('/logout', 'SessionsController@destroy')->name('sessions.destroy');
});

Route::get('/posts/latest', 'PostsController@latest')->name('posts.latest');
Route::get('/posts/search', 'PostsController@search')->name('posts.search');

Route::get('/', 'CategoriesController@index')->name('home');
Route::get('/categories', 'CategoriesController@index')->name('categories.index');

Route::get('/categories/{category}/topics', 'TopicsController@index')->name('topics.index');

Route::get('/topics/{topic}/posts', 'PostsController@index')->name('posts.index');

Route::get('/topics/search', 'TopicsSearchController@index')->name('topics.search');

Route::get('/profiles/{id}', 'ProfilesController@show')->name('profiles.show');
