<?php

use App\Service\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
});
