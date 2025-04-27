<?php declare(strict_types = 1);

namespace App\User\Http\Controllers;

use App\User\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(Request $request): void
    {

    }
}
