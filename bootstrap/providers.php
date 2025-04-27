<?php declare(strict_types = 1);

return [
    App\Common\Providers\CommonServiceProvider::class,
    App\Auth\Providers\AuthServiceProvider::class,
    App\Dashboard\Providers\DashboardServiceProvider::class,
    App\Expense\Providers\ExpenseServiceProvider::class,
    App\Project\Providers\ProjectServiceProvider::class,
    App\User\Providers\UserServiceProvider::class,
];
