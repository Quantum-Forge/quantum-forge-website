<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/mobile-app', 'section.blog.mobile_app')->name('section.blog.mobile_app');
Route::view('/web-app', 'section.blog.web_app')->name('section.blog.web_app');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::view('/contact', 'contact')->name('contact');
// Portfolio detail route
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::get('/portfolio/{id}', function ($id) {
    return view('details.portfolio');
})->name('details.portfolio');
