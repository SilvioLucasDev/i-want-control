<?php

declare(strict_types = 1);

use App\Expense\Http\Controllers\ExpenseController;
use App\Expense\Http\Controllers\InvestmentController;
use App\Expense\Http\Controllers\PaymentMethodController;
use App\Expense\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');

    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods');
    Route::post('/payment-methods', [PaymentMethodController::class, 'store'])->name('payment-methods.store');
    Route::put('/payment-methods/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('payment-methods.update');
    Route::delete('/payment-methods/{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');

    Route::get('/investments', [InvestmentController::class, 'userInvestments'])->name('investments');
    Route::post('/investments', [InvestmentController::class, 'store'])->name('investments.store');
    Route::put('/investments/{investment}', [InvestmentController::class, 'update'])->name('investments.update');
    Route::delete('/investments/{investment}', [InvestmentController::class, 'destroy'])->name('investments.destroy');

    Route::get('/projects', [ProjectController::class, 'userProjects'])->name('projects');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
