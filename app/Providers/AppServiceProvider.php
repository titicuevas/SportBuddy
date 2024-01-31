<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MensajeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MensajeService::class, function ($app) {
            return new MensajeService();
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
