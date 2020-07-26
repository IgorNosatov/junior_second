<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API\\'], function () {
    Route::post('login', 'API\\UserController@login');
    Route::post('register', 'API\\UserController@register');
    Route::get('/books', 'BookController@index');
    Route::delete('/delete/{id}', 'BookController@destroy');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::prefix('books')->group(function () {
            Route::post('/store', 'BookController@store');
            Route::get('/edit/{id}', 'BookController@edit');
            Route::post('/update/{id}', 'BookController@update');
        });
    });
});
