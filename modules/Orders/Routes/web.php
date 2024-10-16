<?php

Route::group(['prefix' => 'admin', 'as' =>'admin.'] , function() {

    Route::prefix('orderss')->name('orderss.')->group( function () {

        Route::get('/', 'ordersController@index')->name('index');

        Route::get('/data', 'ordersController@data')->name('data');

        Route::get('/create', 'ordersController@create')->name('create');

        Route::post('/create', 'ordersController@store')->name('store');

        Route::get('/edit/{orders}', 'ordersController@edit')->name('edit');

        Route::put('/edit/{orders}', 'ordersController@update')->name('update');

        Route::delete('/delete/{orders}', 'ordersController@delete')->name('delete');
    });
 });
