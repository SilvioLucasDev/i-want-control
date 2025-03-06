<?php declare(strict_types = 1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            $basePath = base_path('app');

            Route::middleware('web')
                ->group($basePath . '/Common/routes/common-routes.php')
                ->group($basePath . '/Auth/routes/auth-routes.php')
                ->group($basePath . '/Dashboard/routes/dashboard-routes.php')
                ->group($basePath . '/Expense/routes/expense-routes.php')
                ->group($basePath . '/Service/routes/service-routes.php')
                ->group($basePath . '/User/routes/user-routes.php');
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
