<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['prefix' => '/book','middleware' => ['role:admin']], function () {
        Route::get('/create', 'BookController@create')->name('book.create');
        Route::post('/store', 'BookController@store')->name('book.store');
        Route::get('/{book}/edit', 'BookController@edit')->name('book.edit');
        Route::patch('/{book}/update', 'BookController@update')->name('book.update');
        Route::delete('/{book}/delete', 'BookController@destroy')->name('book.destroy');
    });
    Route::group(['prefix' => '/user', 'middleware' => ['role:admin']], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/store', 'UserController@store')->name('user.store');
        Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::patch('/{user}', 'UserController@update')->name('user.update');
    });
});


