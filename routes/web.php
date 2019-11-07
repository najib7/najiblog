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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('posts', 'PostController');
Route::get('/my-posts', 'PostController@myPosts')->name('my-posts');

Route::resource('categories', 'CategorieController');

Route::resource('comments', 'CommentController')->except('index', 'show', 'create');

Route::resource('/profile', 'ProfileController')
    ->except('index', 'create', 'store')
    ->parameters([
        'profile' => 'user'
    ]);
Route::get('/profile/changePassword/{user}', [
    'as' => 'profile.editpassword',
    'uses'  => 'ProfileController@editPassword',
    'middleware' => 'password.confirm'
]);
Route::put('/profile/changePassword/{user}', [
    'as' => 'profile.updatepassword',
    'uses'  => 'ProfileController@updatePassword',
]);

//only for admin
Route::group([
    'prefix'     => 'dashboard',
    'as'         => 'dashboard.',
    'middleware' => 'role:admin'
], function () {

    Route::get('/', 'DashboardController@index')->name('index');

    Route::resource('users', 'UserController')->except('show');

    Route::get('posts', 'DashboardController@posts')->name('posts');

    Route::get('categories', 'DashboardController@categories')->name('categories');

    Route::get('comments', 'DashboardController@comments')->name('comments');

    Route::any('{page}', 'DashboardController@error404')->where('page', '(.*)');
});
