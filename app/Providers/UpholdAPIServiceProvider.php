<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Uphold\UpholdClient;
use App\Services\UpholdAPI;


class UpholdAPIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $config = config('uphold');
        $this->app->singleton(UpholdAPI::class, function($app) use ($config) {
            $api = new UpholdAPI($config);
            return $api;
        });
        $this->app->singleton(UpholdClient::class, function($app) {
            $client = new UpholdClient([
                'sandbox'       => config('uphold.sandbox'),
                'client_id'     => config('uphold.client_id'),
                'client_secret' => config('uphold.client_secret'),
            ]);
            return $client;
        });
    }
}
