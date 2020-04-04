<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use ActiveCampaign;


class ActiveCampaignProvider extends ServiceProvider
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
        $this->app->singleton('ActiveCampaign', function ($app) {
            return new ActiveCampaign(
                config('services.activecampaign.url'),
                config('services.activecampaign.key')
            );
        });
    }
}
