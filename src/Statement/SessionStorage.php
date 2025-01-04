<?php

namespace ItLabs\Widgets\Currency\Statement;

class SessionStorage implements StorageInterface
{
    public function get()
    {
        return session('currency');
    }

    public function set(string $currency)
    {
        session(['currency' => $currency]);
    }
}