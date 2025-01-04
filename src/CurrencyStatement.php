<?php

namespace ItLabs\Widgets\Currency;

use ItLabs\Widgets\Currency\Statement\StorageInterface;

class CurrencyStatement
{
    protected array $localeCurrencies;

    protected array $currencies;

    protected StorageInterface $storage;

    public function __construct(array $localeCurrencies, StorageInterface $storage)
    {
        $this->localeCurrencies = $localeCurrencies;
        $this->currencies = array_values($localeCurrencies);
        $this->storage = $storage;
    }

    public function getCurrency(): string
    {
        $currency = $this->storage->get();

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

        $this->storage->set($currency);
    }

    public function trySetCurrency(string $currency): bool
    {
        if(!in_array($currency, $this->currencies)){
            return false;
        }

        $this->storage->set($currency);

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
