<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repository interfaces to implementations
        $this->app->bind(
            \Src\domain\Contracts\IUserRepository::class,
            \Src\infrastructure\Repositories\EloquentUserRepository::class
        );

        $this->app->bind(
            \Src\domain\Contracts\IProductRepository::class,
            \Src\infrastructure\Repositories\EloquentProductRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../src/infrastructure/Migrations');
    }
}
