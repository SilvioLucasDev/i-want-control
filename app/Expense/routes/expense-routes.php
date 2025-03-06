<?php declare(strict_types = 1);

use App\Expense\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
});
