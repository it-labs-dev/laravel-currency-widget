<?php

namespace ItLabs\Widgets\Currency;

class PriceFormatter
{
    protected CurrencyStatement $currencyStatement;

    public function __construct(CurrencyStatement $currencyStatement)
    {
        $this->currencyStatement = $currencyStatement;
    }

    /**
     * @param float|PriceInterface $price
     * @param string|null $currency
     * @return string
     */
    public function formatPrice($price, ?string $currency = null): string
    {
        if($price instanceof PriceInterface){
            $currency = $price->getCurrency();
            $price = $price->getValue();
        }

        return sprintf('%s %s', $price, $this->getCurrencySymbol($currency));
    }

    public function getCurrencySymbol(?string $currency = null): string
    {
        if(!$currency){
            $currency = $this->currencyStatement->getCurrency();
        }

        switch (strtoupper($currency)) {
            case 'RUB':
                return '₽';
            case 'EUR':
                return '€';
            case 'USD':
                return '$';
            case 'PLN':
                return 'zł';
            default:
                return $currency;
        }
    }
}
