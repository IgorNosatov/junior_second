<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API\\'], function () {
    Route::get('/library', 'LibraryController@index');

    //Route::group(['middleware' => 'auth:api'], function () {
        Route::prefix('library')->group(function () {
            Route::post('/store', 'LibraryController@store');
            Route::get('/edit/{id}', 'LibraryController@edit');
            Route::patch('/{id}/update', 'LibraryController@update');
            Route::delete('/delete/{id}', 'LibraryController@destroy');
        });
    //});
});
