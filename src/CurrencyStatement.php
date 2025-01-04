<?php

namespace ItLabs\Widgets\Currency;

class CurrencyStatement
{
    protected array $localeCurrencies;

    protected array $currencies;

    public function __construct(array $localeCurrencies)
    {
        $this->localeCurrencies = $localeCurrencies;
        $this->currencies = array_values($localeCurrencies);
    }

    public function getCurrency(): string
    {
        $currency = session('currency');

        if($currency){
            return $currency;
        }

        return $this->getLocaleCurrency();
    }

    public function setCurrency(string $currency): void
    {
        if(!in_array($currency, $this->currencies)){
            throw new \InvalidArgumentException(
                sprintf('Currency: [%s] is not supported', $currency)
            );
        }

        session(['currency' => $currency]);
    }

    public function trySetCurrency(string $currency): bool
    {
        if(!in_array($currency, $this->currencies)){
            return false;
        }

        session(['currency' => $currency]);

        return true;
    }


    public function getAvailableCurrencies(): array
    {
        return $this->currencies;
    }

    protected function getLocaleCurrency(): string
    {
        $locale = app()->getLocale();

        return $this->localeCurrencies[$locale] ?? $this->localeCurrencies['default'];
    }
}
