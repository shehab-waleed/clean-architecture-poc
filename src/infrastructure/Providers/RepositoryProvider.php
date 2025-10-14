<?php

namespace Src\infrastructure\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
    }
}
