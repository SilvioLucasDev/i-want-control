<?php declare(strict_types = 1);

namespace App\Dashboard\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use Inertia\{Inertia, Response};

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard/index');
    }
}
