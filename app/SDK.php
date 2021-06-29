<?php

namespace App;

class SDK
{
    private array $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function __destruct()
    {
        $providers = $this->providers;
        include "view.php";
    }
}
