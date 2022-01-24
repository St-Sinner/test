<?php

declare(strict_types=1);

namespace App\Providers;

use App\Clients\ExternalCalculateClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ExternalCalculateServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('external-calculate', static function ($app) {
            $url = $app['config']->get('services.external-calculate.url');
            $logger = $app->make('log');
            $client = new Client();

            return new ExternalCalculateClient($url, $client, $logger);
        });
    }

}
