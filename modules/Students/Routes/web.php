<?php

Route::group(['prefix' => 'admin', 'as' =>'admin.'] , function() {

    Route::prefix('students')->name('students.')->group( function () {

        Route::get('/','StudentsController@index')->name('index');

        Route::get('/data','StudentsController@data')->name('data');

        Route::get('/create','StudentsController@create')->name('create');

        Route::post('/create','StudentsController@store')->name('store');

        Route::get('/edit/{student}','StudentsController@edit')->name('edit');

        Route::put('/edit/{student}','StudentsController@update')->name('update');

        Route::delete('/delete/{student}','StudentsController@delete')->name('delete');
    });
 });


Route::group([ 'as' =>'students.'] , function() {

    Route::group(['prefix' => 'tai-khoan', 'as' => 'account.'], function () {
        Route::get('/', 'clients\AccountController@index')->name('index');
        Route::get('/thong-tin', 'clients\AccountController@profile')->name('profile');
        Route::get('/cap-nhap-thong-tin', 'clients\AccountController@editProfile')->name('edit-profile');
        Route::post('/cap-nhap-thong-tin', 'clients\AccountController@updateProfile')->name('update-profile');
        Route::get('/khoa-hoc', 'clients\AccountController@myCourses')->name('courses');
        Route::get('/don-hang', 'clients\AccountController@myOrders')->name('orders');
        Route::get('/doi-mat-khau', 'clients\AccountController@changePassword')->name('password');
        Route::post('/doi-mat-khau', 'clients\AccountController@updatePassword');
    });
});
