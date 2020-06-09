<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/cat', 'CategorieController@index');
Route::get('/testpost', 'PostController@indexapi');

Route::post('/categories', 'CategorieController@store');
Route::delete('/categories/{id}', 'CategorieController@destroy');
Route::put('/categories/{id}', 'CategorieController@update');



Route::put('/comments/{comment}', 'CommentController@update');