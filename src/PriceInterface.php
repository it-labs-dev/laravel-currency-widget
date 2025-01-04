<?php

namespace ItLabs\Widgets\Currency;

interface PriceInterface
{
    public function getValue(): float;

    public function getCurrency(): string;
}