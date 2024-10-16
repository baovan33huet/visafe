<?php


    Route::prefix('carts')->name('carts.')->middleware('auth:students', 'verified', 'user.block')->group( function () {

        Route::get('/', 'cartsController@index')->name('index');

        Route::get('/create/{courseId}', 'cartsController@create')->name('create');

        Route::post('/update/', 'CartsController@update')->name('update');

        Route::get('/delete/{courseId}', 'cartsController@delete')->name('delete');

        Route::get('/clear', 'cartsController@delete')->name('clear');
    });

