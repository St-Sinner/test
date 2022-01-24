<?php

declare(strict_types=1);

namespace App\Providers;

use App\Clients\ExternalService\ExternalCalculateClient;
use Illuminate\Support\ServiceProvider;
use Psr\Log\NullLogger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('nullLogger', function () {
            return new NullLogger();
        });

        $this->app->bind('externalCalculateClient', function () {
            return new \App\Facades\ExternalCalculateClient();
        });

        $this->app->singleton(ExternalCalculateClient::class, function ($app) {
            return new ExternalCalculateClient(config('external-service'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
