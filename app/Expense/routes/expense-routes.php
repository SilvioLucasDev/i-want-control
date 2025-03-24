<?php

declare(strict_types = 1);

use App\Expense\Http\Controllers\ExpenseController;
use App\Expense\Http\Controllers\InvestmentController;
use App\Expense\Http\Controllers\PaymentMethodController;
use App\Expense\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::group(['prefix' => 'expenses'], function (): void {
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
    });

    Route::group(['prefix' => 'payment-methods'], function (): void {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('payment-methods.index');
        Route::post('/', [PaymentMethodController::class, 'store'])->name('payment-methods.store');
        Route::put('/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('payment-methods.update');
        Route::delete('/{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');
    });

    Route::group(['prefix' => 'investments'], function (): void {
        Route::get('/', [InvestmentController::class, 'index'])->name('investments.index');
        Route::post('/', [InvestmentController::class, 'store'])->name('investments.store');
        Route::put('/{investment}', [InvestmentController::class, 'update'])->name('investments.update');
        Route::delete('/{investment}', [InvestmentController::class, 'destroy'])->name('investments.destroy');
    });

    Route::group(['prefix' => 'projects'], function (): void {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
});
