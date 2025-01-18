<?php

namespace ItLabs\Widgets\Currency;
use Arrilot\Widgets\AbstractWidget;
use Spatie\Url\Url;

class Currencies extends AbstractWidget
{
    protected $config = [];

    protected ?CurrencyStatement $currencySt;

    protected ?string $currentCurrency;

    public function __construct(array $config = [])
    {
        $this->addConfigDefaults([
            'view' => 'currencyWidget::index',
            'itemView' => 'currencyWidget::item',
            'classes' => []
        ]);

        parent::__construct($config);
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->currencySt = app(CurrencyStatement::class);
        $this->currentCurrency = $this->currencySt->getCurrency();

        return view($this->config['view'], $this->config, [
            'currencies' => $this->buildCurrencies(),
            'currentCurrency' => $this->currentCurrency,
            'currentCurrencyName' => $this->buildCurrentName()
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
