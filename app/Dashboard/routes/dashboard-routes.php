<?php declare(strict_types = 1);

use App\Dashboard\Http\Controllers\{DashboardController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
