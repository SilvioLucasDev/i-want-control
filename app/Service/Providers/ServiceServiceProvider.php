<?php declare(strict_types = 1);

namespace App\Service\Providers;

use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->setupLogViewer();
    }

    /**
     * Setup log viewer.
     */
    private function setupLogViewer(): void
    {
        // TODO :: Adicionar lógica de autenticação, somente ADM.
        LogViewer::auth(fn ($request): true => true);
    }
}
