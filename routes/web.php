<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PortfolioController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/mobile-app', 'section.blog.mobile_app')->name('section.blog.mobile_app');
Route::view('/web-app', 'section.blog.web_app')->name('section.blog.web_app');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::view('/contact', 'contact')->name('contact');
// Portfolio routes (DB-driven)
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.details');
