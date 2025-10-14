<?php

namespace Src\infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class DatabaseProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
    }
}
