<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FilmApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FilmApiService::class, function ($app) {
            return new FilmApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
