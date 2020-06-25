<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '/user', 'middleware' => ['role:admin']], function () {
    Route::get('/', 'UserController@index')->name('user');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/store', 'UserController@store')->name('user.store');
    Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/{user}', 'UserController@update')->name('user.update');
});

Route::group(['prefix' => '/laratrust', 'middleware' => ['role:admin']], function () {
    Route::get('/', function () {});
    Route::get('/roles-assignment', function () {});
    Route::get('/roles', function () {});
    Route::get('/permissions', function () {});
    Route::get('/roles/create', function () {});
});
