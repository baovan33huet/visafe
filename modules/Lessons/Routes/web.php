<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' =>'admin.'] , function() {

    Route::prefix('lessons')->name('lessons.')->group( function () {

        Route::get('/{courseId}', 'LessonsController@index')->name('index');

        Route::get('/{courseId}/data', 'lessonsController@data')->name('data');

        Route::get('/{courseId}/create', 'LessonsController@create')->name('create');

        Route::post('/{courseId}/create', 'LessonsController@store')->name('store');

        Route::get('/edit/{lesson}', 'LessonsController@edit')->name('edit');

        Route::put('/edit/{lesson}', 'LessonsController@update')->name('update');

        Route::get('/delete/{lesson}', 'LessonsController@delete')->name('delete');
    });
 });

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['as' => 'lesson.', 'middleware' => ['auth:students', 'verified', 'user.block', 'student.lesson']], function() {
    Route::get('/bai-hoc/{slug}', 'Clients\ClientsController@index')->name('index');

});
