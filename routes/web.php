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

        $router->delete('/logout', 'SessionsController@destroy')->name('sessions.destroy');
    });
});

Route::group([
    'middleware' => 'guest',
], function ($router) {
    $router->get('/login', 'SessionsController@create')->name('sessions.create');
    $router->post('/login', 'SessionsController@store')->name('sessions.store');

    $router->get('/social-logins/{provider}', 'SocialLoginsController@redirectToProvider')->name('social-logins.redirect-to-provider');
    $router->get('/social-logins/{provider}/callback', 'SocialLoginsController@handleProviderCallback')->name('social-logins.handle-provider-callback');

    $router->get('/registrations/create', 'RegistrationsController@create')->name('registrations.create');
    $router->post('/registrations', 'RegistrationsController@store')->name('registrations.store');

    $router->get('forgot-passwords/create', 'ForgotPasswordsController@create')->name('forgot-passwords.create');
    $router->post('forgot-passwords', 'ForgotPasswordsController@store')->name('forgot-passwords.store');

    $router->get('reset-passwords/create', 'ResetPasswordsController@create')->name('reset-passwords.create');
    $router->post('reset-passwords', 'ResetPasswordsController@store')->name('reset-passwords.store');
});

Route::group([
    'middleware' => 'auth',
], function ($router) {
    $router->get('/categories/{category}/topics/create', 'TopicsController@create')->name('topics.create');
    $router->post('/categories/{category}/topics', 'TopicsController@store')->name('topics.store');

    $router->post('/topics/{topic}/posts', 'PostsController@store')->name('posts.store');
    $router->patch('/topics/{topic}/posts/{post}', 'PostsController@update')->name('posts.update');
    $router->delete('/topics/{topic}/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

    $router->get('/liked-posts', 'LikedPostsController@index')->name('liked-posts.index');
    $router->post('/posts/{post}/like', 'LikesController@store')->name('likes.store');
    $router->delete('/posts/{post}/like', 'LikesController@destroy')->name('likes.destroy');

    $router->get('/chat-messages', 'ChatMessagesController@index')->name('chat-messages.index');
    $router->post('/chat-messages', 'ChatMessagesController@store')->name('chat-messages.store');

    $router->get('/notifications', 'NotificationsController@index')->name('notifications.index');
    $router->delete('/notifications/{id}', 'NotificationsController@destroy')->name('notifications.destroy');

    $router->get('/profiles/edit/{user}', 'ProfilesController@edit')->name('profiles.edit');
    $router->patch('/profiles/{user}', 'ProfilesController@update')->name('profiles.update');

    $router->delete('/logout', 'SessionsController@destroy')->name('sessions.destroy');
});

Route::get('/posts/latest', 'PostsController@latest')->name('posts.latest');
Route::get('/posts/search', 'PostsController@search')->name('posts.search');

Route::get('/', 'CategoriesController@index')->name('home');
Route::get('/categories', 'CategoriesController@index')->name('categories.index');

Route::get('/categories/{category}/topics', 'TopicsController@index')->name('topics.index');

Route::get('/topics/{topic}/posts', 'PostsController@index')->name('posts.index');

Route::get('/topics/search', 'TopicsSearchController@index')->name('topics.search');

Route::get('/profiles/{id}', 'ProfilesController@show')->name('profiles.show');
