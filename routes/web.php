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


Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategorieController');

Route::resource('comments', 'CommentController');

Route::get('/my-posts', 'MyPostsController@index')->name('my-posts');

// Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Route::prefix('dashboard')->name("dashboard.")->group(function () { });


Route::group([
    'prefix'     => 'dashboard',
    'as'         => 'dashboard.',
    'middleware' => 'role:admin'
], function () {

    Route::get('/', 'DashboardController@index')->name('index');
    // Route::get('users', 'DashboardController@users')->name('users');
    Route::resource('users', 'UserController')->except('show');

});
