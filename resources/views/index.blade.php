@php
    /**
     * @var string $currentCurrencyName
     * @var array<array> $currencies
     * @var string[] $classes
     * @var string $itemView
     */
@endphp
<div @class($classes)>
    <span>
        {!! $currentCurrencyName !!}
    </span>
    <ul>
        @foreach($currencies as $currency)
            @include($itemView, $currency)
        @endforeach
    </ul>
</div>
