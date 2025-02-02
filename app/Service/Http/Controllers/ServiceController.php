<?php

namespace App\Service\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use Inertia\{Inertia, Response};

class ServiceController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Service/Index');
    }
}
