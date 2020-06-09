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

// home page
Route::get('/', 'PostController@index')->name('home');

// auth routes
Auth::routes();

// posts
Route::resource('posts', 'PostController');
Route::get('/my-posts', 'PostController@myPosts')->name('my-posts');

// Route::get('/{cat}/{post}', 'PostController@showCat');

// categories
Route::resource('categories', 'CategorieController')->only('show');

// comments
Route::resource('comments', 'CommentController')->except('index', 'show', 'create', 'store');
Route::post('comments/store/{post}', 'CommentController@store')->name('comments.store');

// profile routes
Route::resource('/profile', 'ProfileController')
    ->except('index', 'create', 'store', 'destroy')
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

    Route::resource('users', 'UserController')->except('show', 'edit');

    Route::get('posts', 'DashboardController@posts')->name('posts');

    Route::get('categories', 'DashboardController@categories')->name('categories');

    Route::get('comments', 'DashboardController@comments')->name('comments');

    Route::any('{page}', 'DashboardController@error404')->where('page', '(.*)');
});
