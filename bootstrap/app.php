<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('web')
            ->group(base_path('app/Common/routes/common-routes.php'));

            Route::middleware('web')
                ->group(base_path('app/Auth/routes/auth-routes.php'));

            Route::middleware('web')
                ->group(base_path('app/Dashboard/routes/dashboard-routes.php'));

            Route::middleware('web')
                ->group(base_path('app/Expense/routes/expense-routes.php'));

            Route::middleware('web')
                ->group(base_path('app/Service/routes/service-routes.php'));

            Route::middleware('web')
                ->group(base_path('app/User/routes/user-routes.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Common\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
