<?php declare(strict_types = 1);

namespace App\Project\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class ProjectServiceProvider extends ServiceProvider
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
        $this->setupModels();
        $this->setupCommands();
        $this->setupUrls();
        $this->setupDate();
    }

    /**
     * Setup log viewer.
     */
    private function setupLogViewer(): void
    {
        // TODO :: Adicionar lógica de autenticação, somente ADM.
        LogViewer::auth(fn ($request): true => true);
    }

    /**
     * Setup models.
     */
    private function setupModels(): void
    {
        // Make sure that all properties being called exist in the model.
        Model::shouldBeStrict();

        // Prevent lazy loading in non-production environments.
        Model::preventLazyLoading(
            value: !app()->isProduction()
        );
    }

    /**
     * Setup commands.
     */
    private function setupCommands(): void
    {
        // Prohibit destructive commands in production.
        DB::prohibitDestructiveCommands(
            prohibit: app()->isProduction()
        );
    }

    /**
     * Setup URLs.
     */
    private function setupUrls(): void
    {
        // Force HTTPS if the configuration is set.
        URL::forceHttps(
            force: config('app.force_https')
        );
    }

    /**
     * Setup date.
     */
    private function setupDate(): void
    {
        // Use CarbonImmutable as the default date class.
        Date::use(CarbonImmutable::class);
    }
}
