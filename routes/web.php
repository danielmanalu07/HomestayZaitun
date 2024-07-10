<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Guest.Home');
});

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
    });
});
