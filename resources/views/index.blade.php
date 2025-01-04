@php
    /**
     * @var string $currentCurrencyName
     * @var array<array> $currencies
     * @var string[] $classes
     */
@endphp
<div @class($classes)>
    <span>
        {{ $currentCurrencyName }}
    </span>
    <div>
        @foreach($currencies as $currency)
            <a href="{{ $currency['href'] }}">
                {{ $currency['name'] }}
            </a>
        @endforeach
    </div>
</div>
