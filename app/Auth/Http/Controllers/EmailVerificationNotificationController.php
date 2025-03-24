<?php declare(strict_types = 1);

namespace App\Auth\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard.index', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
