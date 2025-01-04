<?php

use ItLabs\Widgets\Currency\PriceFormatter;
use ItLabs\Widgets\Currency\PriceInterface;

/**
 * Generate the URL to a named route.
 */
function i18nRoute(string $name, array $parameters = [], $absolute = true): string
{
    $locale = app()->getLocale();
    $defaultLocale = config('app.defaultLocale');

    if ($locale !== $defaultLocale) {
        $parameters['lang'] = $locale;
        $name = 'i18n.' . $name;
    }

    return app('url')->route($name, $parameters, $absolute);
}

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
