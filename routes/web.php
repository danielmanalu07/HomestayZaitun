<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', 'AdminController@Login')->name('login.admin');
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('dashboard', 'AdminController@Dashboard')->name('dashboard.admin');
        Route::get('logout', 'AdminController@Logout')->name('logout.admin');
        Route::resource('kategori-kamar', 'KategoriKamarController');
        Route::resource('fasilitas', 'FasilitasController');
    });
});
