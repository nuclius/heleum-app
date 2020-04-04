<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\CardRules;

use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'isValidCard', CardRules::class.'@isValidCard',
            'The Card you selected could not be found.'
        );
        Validator::extend(
            'lessThanCardAvailable', CardRules::class.'@lessThanCardAvailable',
            'You have insufficient funds on your card for this transaction.
             You requested :requestAmount, but only have :cardAvailable on card.'
        );
        Validator::replacer(
            'lessThanCardAvailable',
            CardRules::class.'@lessThanCardAvailableMessage'
        );
        Validator::extend(
            'lessThanOrEqualToMaxWithdrawAmount',
            CardRules::class.'@lessThanOrEqualToMaxWithdrawAmount',
            'You requested more than your maximum withdraw amount.
             You requested :requestAmount, but only have :userBalance available.'
        );
        Validator::replacer(
            'lessThanOrEqualToMaxWithdrawAmount',
            CardRules::class.'@lessThanOrEqualToMaxWithdrawAmountMessage'
        );
        Validator::extend(
            'greaterThanZero', CardRules::class.'@greaterThanZero',
            'Amount must be greater than zero.'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Allow a custom storage path, if set in env() manner
        $original = app('path.storage');
        $this->app->bind('path.storage', function () use ($original) {
            $env = env('APP_PATH_STORAGE', '');
            return empty($env) ? $original : $env;
        });
    }
}
