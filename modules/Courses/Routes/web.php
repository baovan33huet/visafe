<?php
 use Illuminate\Support\Facades\Route;

 Route::prefix('admin')->name('admin.')->group(function() {

     Route::prefix('courses')->name('courses.')->group(function() {

            Route::get('/', 'CoursesController@index')->name('index');

             Route::get('/data', 'CoursesController@data')->name('data');

             Route::get('/create', 'CoursesController@create')->name('create');

             Route::post('/create', 'CoursesController@store')->name('store');

             Route::get('/edit/{course}','CoursesController@edit')->name('edit');

             Route::put('/edit/{course}','CoursesController@update')->name('update');

             Route::delete('/delete/{course}','CoursesController@delete')->name('delete');

             Route::post('ajax', 'CoursesController@ajax')->name('ajax');


     });
 });

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['as' => 'courses.'], function() {
    Route::get('/khoa-hoc', 'Clients\ClientsController@index')->name('index');

    Route::get('/khoa-hoc/{slug}', 'Clients\ClientsController@detail')->name('detail');

    Route::prefix('data')->name('data.')->group(function() {
        Route::get('/trial-lesson/{lessonId?}', 'Clients\ClientsController@getTrialLesson')->name('trial');

        Route::get('/stream-video', 'Clients\ClientsController@streamVideo')->name('stream');
    });

});
