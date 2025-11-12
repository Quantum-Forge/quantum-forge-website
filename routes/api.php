<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PortfolioController;

// API routes are automatically prefixed with '/api' via bootstrap/app.php
Route::middleware('api.key')->group(function () {
    Route::get('/news', [NewsController::class, 'apiIndex'])->name('api.news');
    Route::get('/portfolios', [PortfolioController::class, 'apiIndex'])->middleware('throttle:60,1')->name('api.portfolios');
});