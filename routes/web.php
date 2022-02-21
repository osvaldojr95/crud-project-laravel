<?php

use App\Http\Controllers\PhotoController;

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

Route::get('/', ['uses' => 'PostsController@index', 'as' => 'index']);

Route::resource('/posts',PostsController::class);

Route::get('ajax/{src}',['uses' => 'AjaxController@get']);