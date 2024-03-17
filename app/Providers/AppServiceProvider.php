<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\MovieService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieRepositoryInterface::class, MovieService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): array
    {
        return [ MovieRepositoryInterface::class ];
    }
}
