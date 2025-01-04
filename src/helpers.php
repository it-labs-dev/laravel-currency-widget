<?php

use ItLabs\Widgets\Currency\PriceFormatter;
use ItLabs\Widgets\Currency\PriceInterface;

/**
 * @param float|PriceInterface $price
 * @param string|null $currency
 * @return string
 */
function formatPrice($price, ?string $currency = null): string
{
    return app(PriceFormatter::class)->formatPrice($price, $currency);
}

function currencySymbol(string $currency): string
{
    return app(PriceFormatter::class)->getCurrencySymbol($currency);
}
