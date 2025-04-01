<?php declare(strict_types = 1);

use App\Project\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::group(['prefix' => 'projects'], function (): void {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/get-projects-by-user', [ProjectController::class, 'getProjectsByUser'])->name('projects.get-projects-by-user');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
});
