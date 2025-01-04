<?php

namespace ItLabs\Widgets\Currency;

use ItLabs\Widgets\Currency\Statement\SessionStorage;
use ItLabs\Widgets\Currency\Statement\StorageInterface;

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
        app()->singleton(StorageInterface::class, function (){
            return new SessionStorage();
        });

        app()->singleton(CurrencyStatement::class, function(){
            return new CurrencyStatement(
                config('currencies.localeCurrencies', []),
                app(StorageInterface::class)
            );
        });

        app()->singleton(PriceFormatter::class, function(){
            return new PriceFormatter(
                app(CurrencyStatement::class)
            );
        });
    }
}
