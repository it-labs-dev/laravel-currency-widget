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
    <ul>
        @foreach($currencies as $currency)
            <li @class(['is-active' => $currency['isActive']])>
                <a href="{{ $currency['href'] }}">
                    {{ $currency['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
