<?php

namespace ItLabs\Widgets\Currency\Statement;

interface StorageInterface
{
    public function get();

    public function set(string $currency);
}