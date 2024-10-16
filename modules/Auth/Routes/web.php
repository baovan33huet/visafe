<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

    Route::get('/login', "Admin\LoginController@showLoginForm")->name('login');

     Route::post('/login', "Admin\LoginController@login")->name('login');

     Route::post('/logout', "Admin\LoginController@logout")->name('logout');

     Route::get('/dang-nhap', 'Clients\LoginController@showLoginFormClient')->name('clients.login');

    Route::post('/dang-nhap', 'Clients\LoginController@LoginClient');

    Route::get('/dang-ki', 'Clients\RegisterController@showRegisterFormClient')->name('clients.register');

    Route::post('/dang-ki', 'Clients\RegisterController@registerFormClient');

    Route::post('dang-xuat', 'Clients\LoginController@LogoutClient')->name('clients.logout');

    Route::get('/block', 'Clients\BlockController@index')->middleware('auth:students')->name('client.block');

    Route::get('/check-course-student', 'Clients\BlockController@checkCourseStudent')->name('client.checkCourse');


    Route::get('/email/verify', 'Clients\VerifyController@index')->middleware('auth:students')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('home.index');
    })->middleware(['auth:students', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', 'Clients\RegisterController@resendEmail')->middleware(['auth:students', 'throttle:6,1'])->name('verification.send');
