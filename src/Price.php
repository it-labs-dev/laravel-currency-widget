<?php

namespace ItLabs\Widgets\Currency;

class Price implements PriceInterface
{
    public float $value;

    public string $currency;

    public function __construct(float $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
