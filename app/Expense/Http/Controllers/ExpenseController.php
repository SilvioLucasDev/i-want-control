<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use Inertia\{Inertia, Response};

class ExpenseController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Expense/Index');
    }
}
