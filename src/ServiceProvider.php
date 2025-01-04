<?php

namespace ItLabs\Widgets\Currency;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/currencies.php' => config_path('currencies.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'currencyWidget');
    }

    public function register()
    {
        app()->singleton(CurrencyStatement::class, function(){
            return new CurrencyStatement(config('currencies.localeCurrencies', []));
        });
    }
}
