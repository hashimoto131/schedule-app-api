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

Route::post('login', 'AuthController@login')->name('auth.login');
Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/{user}', 'UsersController@show')->name('users.show')->where('user', '[0-9]+');
Route::post('users', 'UsersController@store')->name('users.store');
Route::post('users/update/{user}', 'UsersController@update')->name('users.update')->where('user', '[0-9]+');
Route::post('users/destroy/{user}', 'UsersController@destroy')->name('users.destroy')->where('user', '[0-9]+');
Route::post('users/checkPass/{user}', 'UsersController@checkPass')->name('users.checkPass')->where('user', '[0-9]+');
// Route::resource('users', 'UsersController');
// Route::middleware(['jwtAuth'])->group(function () {
// });

