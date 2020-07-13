<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API\\'], function () {
    Route::get('/books', 'BookController@index');

   // Route::group(['middleware' => 'auth:api'], function () {
        Route::prefix('books')->group(function () {
            Route::post('/store', 'BookController@store');
            Route::get('/edit/{id}', 'BookController@edit');
            Route::patch('/update/{id}', 'BookController@update');
            Route::delete('/delete/{id}', 'BookController@destroy');
        });
    //});
});

