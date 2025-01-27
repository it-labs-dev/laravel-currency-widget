@php
    /**
     * @var string $sid
     * @var string $name
     * @var string $href
     * @var string $isActive
     */
@endphp
<li @class(['is-active' => $isActive])>
    <a href="{{ $href }}">
        {!! $name !!}
    </a>
</li>