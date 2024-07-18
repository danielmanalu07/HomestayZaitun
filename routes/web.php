<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\UserVerifyEmail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Guest.Home');
})->name('home');

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', 'AdminController@Login')->name('login.admin');
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('dashboard', 'AdminController@Dashboard')->name('dashboard.admin');
        Route::get('logout', 'AdminController@Logout')->name('logout.admin');
        Route::resource('kategori-kamar', 'KategoriKamarController');
        Route::resource('fasilitas', 'FasilitasController');
        Route::resource('carousel', 'CarouselController');
        Route::resource('kamar', 'KamarController');
        Route::resource('gallery', 'GalleryController');
        Route::get('kamar/{id}/images', 'KamarController@getImages');
        Route::resource('konten1', 'Kontent1Controller');
        Route::resource('diskon', 'DiskonController');
        Route::get('profile', 'AdminController@Profile');
        Route::post('ubah-password', 'AdminController@UbahPassword')->name('admin.new_password');
    });
});

Route::prefix('/user')->namespace('App\Http\Controllers\User')->group(function () {
    Route::match(['get', 'post'], 'register', 'UserController@Register')->name('register.user');
    Route::match(['get', 'post'], 'login', 'UserController@Login')->name('login.user');
    Route::match(['get', 'post'], 'verification-code-email', 'UserController@verificationCodeEmail')->name('verify.email');
    Route::post('resend-code', 'UserController@ResendCode')->name('resend.code');
    Route::match(['get', 'post'], 'lupa-password', 'UserController@LupaPassword')->name('user.lupapassword');
    Route::match(['get', 'post'], 'code-resetpassword', 'UserController@CodeResetPassword')->name('code.resetpassword');
    Route::post('resend-code-reset-password', 'UserController@ResendCodeResetPassword')->name('resend.codeResetPassword');
    Route::match(['get', 'post'], 'new-password', 'UserController@NewPassword')->name('user.newPassword');

    Route::middleware([UserMiddleware::class, UserVerifyEmail::class])->group(function () {
        Route::get('home', 'UserController@Home')->name('user.home');
        Route::get('logout', 'UserController@Logout')->name('logout.user');
    });
});
