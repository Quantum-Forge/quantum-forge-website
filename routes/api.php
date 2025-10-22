<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

// API routes are automatically prefixed with '/api' via bootstrap/app.php
Route::middleware('api.key')->group(function () {
    Route::get('/news', [NewsController::class, 'apiIndex'])->name('api.news');
});