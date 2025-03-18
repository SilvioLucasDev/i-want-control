<?php declare(strict_types = 1);

use App\User\Models\User;

if (!function_exists('user')) {
    /**
     * Get the authenticated user.
     */
    function user(): ?User
    {
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();

        if ($auth->check()) {
            return $auth->user();
        }

        return null;
    }
}

if (!function_exists('logged_in_user_id')) {
    /**
     * Get the ID of the authenticated user.
     */
    function logged_in_user_id(): ?int
    {
        $user = user();

        if ($user instanceof \App\User\Models\User) {
            return $user->id;
        }

        return null;
    }
}
