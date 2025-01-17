<?php

namespace ItLabs\Widgets\Currency;
use Arrilot\Widgets\AbstractWidget;
use Closure;
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

    protected ?Closure $nameBuilder = null;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->currencySt = app(CurrencyStatement::class);
        $this->currentCurrency = $this->currencySt->getCurrency();
        $this->nameBuilder = Arr::get($this->config, 'nameBuilder');

        if(!$this->nameBuilder){
            $this->nameBuilder = function(string $currency){
                return $this->defaultBuildName($currency);
            };
        }

        return view('currencyWidget::index', [
            'currencies' => $this->buildCurrencies(),
            'currentCurrencyName' => $this->buildCurrentName(),
            'classes' => Arr::get($this->config, 'classes', [])
        ]);
    }

    protected function defaultBuildName(string $currency): string
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

    protected function buildName(string $currency): string
    {
        $callable = $this->nameBuilder;

        return $callable($currency);
    }

    protected function buildCurrencies(): array
    {
        $currencies = [];

        $url = Url::fromString(url()->full());

        foreach ($this->currencySt->getAvailableCurrencies() as $currency)
        {
            $currencies[] = [
                'sid' => $currency,
                'name' => $this->buildName($currency),
                'href' => $url->withQueryParameters(['currency' => $currency]),
                'isActive' => $currency === $this->currentCurrency
            ];
        }

        return $currencies;
    }
}
