<?php declare(strict_types = 1);

use App\Service\Http\Controllers\ProjectController;
use App\Service\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

    Route::group(['prefix' => 'projects'], function (): void {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
});
