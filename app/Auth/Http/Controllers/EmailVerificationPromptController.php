<?php

namespace App\Auth\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Inertia\{Inertia, Response};

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
