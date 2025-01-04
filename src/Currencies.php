<?php

namespace ItLabs\Widgets\Currency;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Arr;
use Spatie\Url\Url;

class Currencies extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    protected ?CurrencyStatement $currencySt;

    protected ?string $currentCurrency;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->currencySt = app(CurrencyStatement::class);
        $this->currentCurrency = $this->currencySt->getCurrency();

        return view('currencyWidget::index', [
            'currencies' => $this->buildCurrencies(),
            'currentCurrencyName' => $this->buildCurrentName(),
            'classes' => Arr::get($this->config, 'classes', [])
        ]);
    }

    protected function buildName(string $currency): string
    {
        $name = __('currencies.' . $currency);

        if(!$name){
            $name = $currency;
        }

        return $name;
    }

    protected function buildCurrentName(): string
    {
        return $this->buildName($this->currentCurrency);
    }

    protected function buildCurrencies(): array
    {
        $currencies = [];

        $url = Url::fromString(url()->full());

        foreach ($this->currencySt->getAvailableCurrencies() as $currency)
        {
            if($currency === $this->currentCurrency){
                continue;
            }

            $currencies[] = [
                'sid' => $currency,
                'name' => $this->buildName($currency),
                'href' => $url->withQueryParameters(['currency' => $currency])
            ];
        }

        return $currencies;
    }
}
